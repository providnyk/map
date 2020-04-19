<?php


#namespace App\Http\Controllers\API;
namespace Modules\Place\API;

#use App\Place;
use                        Modules\Place\API\Place;
use                   Modules\Place\Database\Place as DBPlace;

#use App\Filters\PlaceFilters;
use                    Modules\Place\Filters\PlaceFilters;

#use App\Http\Requests\PlaceRequest;
#use Modules\Place\Requests\PlaceRequest;

use                        App\Http\Requests\DeleteRequest;

use                     App\Http\Controllers\ControllerAPI as Controller;
use                   \Modules\Mark\Database\Mark;
use                \Modules\Element\Database\Element;
#use App\Http\Requests\PlaceApiRequest;
use                       Modules\Place\Http\PlaceRequest;
use                        Modules\Place\API\SaveRequest;

#use Modules\Place\Http\Controllers\PlaceController as Controller;

class PlaceController extends Controller
{
	/**
	 * Deleted selected item(s)
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function destroy(DeleteRequest $request) : \Illuminate\Http\Response
	{
		return $this->destroyAPI($request);
	}

	/**
	 * Prepare data for listing all of items
	 * @param Request	$request		Data from request
	 * @param Filters	$filters		Whatever filters applied
	 *
	 * @return Response	json instance of
	 */
#	public function index(PlaceApiRequest $request, PlaceFilters $filters) : \Illuminate\Http\Response
	public function index(PlaceRequest $request, PlaceFilters $filters) : \Illuminate\Http\Response
	{
		$o_res		= $this->indexAPI($request, $filters, ['opinion', 'vote']);
		$a_marks	= Mark::wherePublished(1)->get()->pluck('qty', 'id')->toArray();
		$i_mark_max = max($a_marks);
		$a_elements	= Element::get()->pluck('title', 'id')->toArray();
		$a_content = json_decode($o_res->getContent(), TRUE);
		for ($i = 0; $i < count($a_content['data']); $i++)
		{
			$a_places = $a_content['data'][$i];
			if (isset($a_places['opinion'][0]))
				$a_places['latest_opinion'] = $a_places['opinion'][0]['title'];
			$a_rating = [];
			$a_rating = self::_sumAllVotes($a_places['vote'], $a_marks);
			if (isset($a_rating['elements']))
				$a_rating = self::_setAverageTotal($a_rating, $a_elements, $i_mark_max);
			$a_places['rating'] = $a_rating;
			unset($a_places['opinion']);
			unset($a_places['vote']);
			$a_content['data'][$i] = $a_places;
		}
		$o_res->setContent(json_encode($a_content));
		return $o_res;
	}

	/**
	 * Unify marks description for all elements
	 *
	 * @param Array		$a_format_val	values (aka marks) to be formatted
	 * @param Integer	$i_mark_max		Maximum posible value for a single mark
	 *
	 * @return Array					mark as key and qty as value
	 */
	private static function _setMarkDescription($a_format_val, $i_mark_max) : String
	{
		$s_format_set		= '%s: %d%% (оценка %1s на основании %d отзывов)';
		return vsprintf($s_format_set, $a_format_val);
	}

	/**
	 * Go through all marks and calculate average points
	 * for each element and for the place in general
	 *
	 * @param Array		$a_rating		All votes organised per element and per place
	 * @param Array		$a_elements		All elements that can be voted for
	 * @param Integer	$i_mark_max		Maximum posible value for a single mark
	 *
	 * @return Array					mark as key and qty as value
	 */
	private static function _setAverageTotal($a_rating, $a_elements, $i_mark_max) : Array
	{
		$a_res				= [];
		$a_res[]			= '';
		$i_total_value		= 0;
		$i_total_elements	= 0;
		foreach ($a_rating['elements'] AS $i_element_id => $a_marks)
		{
			foreach ($a_marks AS $i_mark_value => $i_mark_qty)
			{
				$i_sum_value = 0;
				$i_sum_votes = 0;
				if ($i_mark_value > 0)
				{
					$i_sum_value += $i_mark_value;
					$i_sum_votes += $i_mark_qty;

				}
				if ($i_sum_votes > 0 && $i_mark_max > 0)
				{
					$i_tmp = $i_sum_value / $i_sum_votes;
					$a_res[] = self::_setMarkDescription(
								[
								$a_elements[$i_element_id],
								Place::formatNumber($i_tmp / $i_mark_max * 100),
								Place::formatNumber($i_tmp, 1),
								Place::formatNumber($i_sum_votes),
								],
								$i_mark_max
							);
					$i_total_value += $i_tmp;
					$i_total_elements++;
				}
			}
		}

		/**
		 * Total rating for the place
		 * is based on the rating of all elements' rating
		 */
		if ($i_total_elements > 0 && $i_mark_max > 0)
		{
			$i_tmp = $i_total_value / $i_total_elements;
			$a_res[0] = self::_setMarkDescription(
						[
						'Общая оценка',
						Place::formatNumber($i_tmp / $i_mark_max * 100),
						Place::formatNumber($i_tmp, 1),
						Place::formatNumber($i_total_elements),
						],
						$i_mark_max
					);
		}
		return $a_res;
	}

	/**
	 * Take each vote value (aka mark)
	 * calculate qty of each mark
	 * the same value marks that are considered as kind "the same" mark
	 * so they are summarized together
	 *
	 * @param Array		$a_votes		All votes casted for this place
	 * @param Array		$a_marks		Weight of each mark in points
	 *
	 * @return Array					mark as key and qty as value
	 */
	private static function _sumAllVotes($a_votes, $a_marks) : Array
	{
		$a_rating = [];
		for ($i = 0; $i < count($a_votes); $i++)
		{
			$a_vote			= $a_votes[$i];
			$i_mark_id		= $a_vote['mark_id'];
			$i_element_id	= $a_vote['element_id'];
			$i_mark_value	= $a_marks[$i_mark_id];

			if (!isset($a_rating['total'][$i_mark_value]))
				$a_rating['total'][$i_mark_value] = 0;
			if (!isset($a_rating['elements'][$i_element_id][$i_mark_value]))
				$a_rating['elements'][$i_element_id][$i_mark_value] = 0;

			$a_rating['total'][$i_mark_value]++;
			$a_rating['elements'][$i_element_id][$i_mark_value]++;
		}
		return $a_rating;
	}

	/**
	 * Create a new item
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function store(SaveRequest $request) : \Illuminate\Http\Response
	{
		$request->merge([
			'user_id' => \Auth::user()->id,
		]);
		$a_res = $this->storeAPI($request);
		return $a_res;
	}

	/**
	 * Updated item that is being edited
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function update(SaveRequest $request, DBPlace $item) : \Illuminate\Http\Response
	{
		$a_res = $this->updateAPI($request, $item);
		return $a_res;
	}
}
