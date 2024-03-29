<?php


#namespace App\Http\Controllers\API;
namespace Modules\Opinion\API;

#use App\Opinion;

#use App\Filters\OpinionFilters;

#use App\Http\Requests\OpinionRequest;
#use Modules\Opinion\Requests\OpinionRequest;

use                        App\Http\Requests\DeleteRequest;

use                     App\Http\Controllers\ControllerAPI as Controller;
use                                          Exception;

#use App\Http\Requests\OpinionApiRequest;
use                      Modules\Opinion\API\Opinion;
use                 Modules\Opinion\Database\Opinion as DBOpinion;
use                  Modules\Opinion\Filters\OpinionFilters;
use                     Modules\Opinion\Http\OpinionRequest;
use                 Modules\Opinion\Database\OpinionVote;
use                    Modules\Place\Filters\PlaceFilters;
use                          Illuminate\Http\Response;
use                          Illuminate\Http\Request;
use                      Modules\Opinion\API\SaveRequest;
#use Modules\Opinion\Http\Controllers\OpinionController as Controller;

class OpinionController extends Controller
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
#	public function index(OpinionApiRequest $request, OpinionFilters $filters) : \Illuminate\Http\Response
	public function index(OpinionRequest $request, OpinionFilters $filters) : \Illuminate\Http\Response
	{
		return $this->indexAPI($request, $filters, ['place']);
	}

	/**
	 * Get list of related elements, marks specific to this place
	 * @param Request	$request		Data from request
	 * @param Integer	$pid				place id
	 *
	 * @return Response	json instance of
	 */
	protected function place(Request $request, $pid) : String
	{
		return Opinion::getSpecificLists($request, $pid);
	}

	/**
	 * Create a new item
	 * @param SaveRequest	$request		Data from Model save request
	 *
	 * @return Response						json instance of
	 */
	public function store(SaveRequest $request) : Response
	{
		$this->setEnv();
		$a_response['error']		= FALSE;
		$a_response['code']			= 200;
		$i_user_id					= \Auth::user()->id;
		$request->merge([
			'user_id' => $i_user_id,
		]);

		$i_qty		= Opinion::checkVotesQty($request->place_id, $i_user_id);

		/**
		 *	if user voted more than once for this place already
		 *	then let's skip the "empty" marks error check
		 *	so there would be less bothering
		 */
		if ($i_qty == 0)
		{
			$a_response				= Opinion::checkMarksCasted($this->_env, $request->vote);
		}

		if (!$a_response['error'])
		{
			try
			{
				$a_response			= $this->storeAPI($request);
			}
			catch(Exception $exception)
			{
				$a_response			= Opinion::storeVoteErr($this->_env, $exception->getCode());
			}
		}

		/**
		 *	datafor vote were saved successfully
		 *	so we may now save elements' mark for this vote
		 */
		if (is_object($a_response))
		{
			try
			{
				$this->saveVote($request, $this->o_item);
			}
			catch(Exception $exception)
			{
				$a_response			= Opinion::storeMarkErr($exception->getCode(), $this->o_item->id);
			}
		}

		/**
		 *	happens if errors were return
		 *	so turn errors into compliance Response object
		 */
		if (!is_object($a_response))
		{
			$a_response				= Opinion::makeResponse($a_response);
		}
		return $a_response;
	}

	/**
	 * Save votes for this opinion
	 * @param SaveRequest	$request		Data from Model save request
	 * @param Object		$o_item			opinion being created/updated
	 *
	 * @return void
	 */
	public function saveVote(SaveRequest $request, Object $o_item) : void
	{
		$a_votes = [];
		foreach ($request->vote AS $s_key => $a_vote)
		{
			$a_vote['user_id'] = \Auth::user()->id;
			if ($a_vote['mark_id'] != 0)
				$a_votes[] = $a_vote;
		}
		$o_item->vote()->saveMany(array_map(function($vote) {
				return new OpinionVote($vote);
			}, $a_votes)
		);
	}

	/**
	 * Updated item that is being edited
	 * @param SaveRequest	$request		Data from Model save request
	 *
	 * @return Response	json instance of
	 */
	public function update(SaveRequest $request, DBOpinion $item) : Response
	{
		$a_res = $this->updateAPI($request, $item);
		$item->vote()->delete();
		$this->saveVote($request, $item);
		return $a_res;
	}

	/**
	 * Get list of places that user did not vote for yet
	 * @param Request	$request		Data from request
	 * @param Filters	$filters		Whatever filters applied
	 *
	 * @return Response	json instance of
	 */
	protected function unvoted(Request $request, PlaceFilters $filters) : String
	{
		return Opinion::getUnvotedPlaces($request, $filters);
	}
}
