<?php

namespace Modules\Opinion\API;

use                 Modules\Opinion\Database\Opinion as Model;
use                     Modules\Building\API\Building;
use                      Modules\Element\API\Element;
use                        Modules\Place\API\Place;
use                    Modules\Place\Filters\PlaceFilters;
use                          Illuminate\Http\Response;
use                          Illuminate\Http\Request;
use                        Modules\Style\API\Style;

class Opinion extends Model
{
	public $translationModel = '\Modules\Opinion\Database\OpinionTranslation';

	/**
	 * Create/modify opinion http://pr.max/admin/opinion/form
	 * API URL http://pr.max/api/opinion/place/32
	 * Select Place from dropdown
	 * Provides with list of Elements specific to selected Place
	 * the Elements are then dynamically shown via tmpl
	 * so it is possible to evaluate them and select specific Mark for each Element
	 * @param Request	$request		Data from request
	 * @param Integer	$id				point id
	 *
	 * @return Response	json instance of data for select2 expected format
	 */
	#  -> select a palce from dropdown

	public static function getSpecificLists($request, $pid) : String
	{
		$i_building_id			= Place::findOrFail($pid)->building_id;
		$i_style_id				= Building::findOrFail($i_building_id)->style_id;
		$a_element_ids			= Style::findOrFail($i_style_id)->element()->get()->pluck('id')->toArray();

		$a_items				= self::getIdTitle($request, NULL, 'Element', NULL, $a_element_ids, [], TRUE, FALSE);#, TRUE);

/*
		$a_items				= Element::whereIn('id', $a_element_ids);
#		$a_issue_ids = Design::findOrFail($i_design_id)->issue()->get()->pluck('id')->toArray();
#		$a_issues = Issue::whereIn('id', $a_issue_ids);

		if (!is_null($request->search))
			 $a_items = $a_items->whereTranslationLike('title', '%' . $request->search .'%', app()->getLocale());

		$a_items = $a_items->get()->map( function($o_element) {
			return ['id'=> $o_element->id, 'title' => $o_element->title];
		});
#dd($request, $id, $i_building_id, $i_style_id, $a_element_ids, $a_items);
*/
		return json_encode(['results' => $a_items]);
	}


	/**
	 * Create/modify opinion http://pr.max/admin/opinion/form
	 * API URL http://pr.max/api/opinion/13/unvoted
	 * Click Place Dropdown
	 * A list of Places is shown
	 * List will be filled with Places that current user never voted for
	 * List will include the Place that is already associated with editing existing Opinion
	 *
	 * @param Request	$request		Data from request
	 * @param Filters	$filters		Whatever filters applied
	 *
	 * @return Response	json instance of data for select2 expected format
	 */
	public static function getUnvotedPlaces(Request $request, PlaceFilters $filters) : String
	{
		$a_voted				= Opinion::select('place_id')
									# keep place for current opinion
									->where('id', '<>', $request->id)
									# exclude places where already voted
									->whereUserId(\Auth::user()->id)
									->get()
									->pluck('place_id')
									->toArray()
									;

		$a_items				= self::getIdTitle($request, $filters, 'Place', NULL, [], $a_voted, TRUE, FALSE);#, FALSE);

		return json_encode(['data' => $a_items]);
	}

	/**
	 * Check if any votes for the given place by given user
	 *
	 * @param Integer	$place_id		place id
	 * @param Integer	$i_user_id		user id
	 *
	 * @return Integer					qty of votes casted
	 */
	public static function checkVotesQty(Int $place_id, Int $i_user_id) : Int
	{
		return self::select('id')->wherePlaceId($place_id)->whereUserId($i_user_id)->count();
	}

	/**
	 * Check if any votes for the given place by given user
	 *
	 * @param Object		$o_env			environment variables
	 * @param Array			$a_votes		place id
	 *
	 * @return Array						json ready data
	 */
	public static function checkMarksCasted(Object $o_env, Array $a_votes) : Array
	{
		$a_response['error']	= FALSE;
		/**
		 *	have to built validation rules on-the-fly
		 *	as number and list of elements is dynamically built
		 *	and can be modified via power panel (a.k.a. admin area)
		 *	required_without_all: might be an option
		 *	as suggested here https://stackoverflow.com/questions/23401365/laravel-at-least-one-field-required-validation
		 *
		 *	however we don't know what elements are available
		 *	so do it straightforward KISS way
		 *	a default drop-down id = 0
		 *	sum up all elements' id
		 *	if the total is greater than 1
		 *	it means at least 1 non-defult value was chosen
		 *	value = mark
		 */

		$i_summ					= 0;
		foreach ($a_votes AS $s_key => $a_vote)
		{
			$i_summ				+= $a_vote['mark_id'];
		}

		/**
		 *	https://en.wikipedia.org/wiki/List_of_HTTP_status_codes
		 *	Retry With
		 *	The server cannot honour the request because the user has not provided the required information.
		 */
		if ($i_summ < 1)
		{
			$a_response = [
					'error'		=> TRUE,
					'code'		=> 449,
					'title'		=> trans( $o_env->s_sgl . '::crud.messages.missing_title'),
					'message'	=> trans( $o_env->s_sgl . '::crud.messages.missing_text'),
					'url'		=> '',
					'btn'		=> trans('user/messages.button.ok'),
			];
		}
		return $a_response;
	}

	/**
	 * Prepare error info if there is already vote for specified place
	 *
	 * @param Object		$o_env			environment variables
	 * @param Integer		$i_code			exception code
	 *
	 * @return Array						json ready data
	 */
	public static function storeVoteErr(Object $o_env, Int $i_code) : Array
	{
		/**
		 *	https://en.wikipedia.org/wiki/List_of_HTTP_status_codes
		 *	Conflict
		 *	Indicates that the request could not be processed because of conflict in the current state of the resource, such as an edit conflict between multiple simultaneous updates.
		 */
		$a_response = [
				'error'		=> ($i_code == 23000),
				'code'		=> 409,
				'title'		=> trans( $o_env->s_sgl . '::crud.messages.no_dup_title'),
				'message'	=> trans( $o_env->s_sgl . '::crud.messages.no_dup_text'),
		];
		return $a_response;
	}

	/**
	 * Prepare error info if marks for specified vote can't be saved
	 * and clean those vote and its marks that were if any were saved
	 *
	 * @param Integer		$i_code			exception code
	 * @param Integer		$i_id			item id
	 *
	 * @return Array						json ready data
	 */
	public static function storeMarkErr(Int $i_code, Int $i_id) : Array
	{
		self::destroy($i_id);
		/**
		 *	https://en.wikipedia.org/wiki/List_of_HTTP_status_codes
		 *	Failed Dependency
		 *	The request failed because it depended on another request and that request failed
		 */
		$a_response = [
				'error'		=> ($i_code == 23000),
				'code'		=> 424,
		];
		return $a_response;
	}

}
