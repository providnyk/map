<?php


#namespace App\Http\Controllers\API;
namespace Modules\Opinion\API;

#use App\Opinion;
use Modules\Opinion\API\Opinion;
use Modules\Opinion\Database\Opinion as DBOpinion;

#use App\Filters\OpinionFilters;
use Modules\Opinion\Filters\OpinionFilters;

#use App\Http\Requests\OpinionRequest;
#use Modules\Opinion\Requests\OpinionRequest;

use App\Http\Requests\DeleteRequest;

use App\Http\Controllers\ControllerAPI as Controller;

#use App\Http\Requests\OpinionApiRequest;
use Modules\Opinion\Http\OpinionRequest;
use Modules\Opinion\API\SaveRequest;

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
		return $this->indexAPI($request, $filters);
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
	public function update(SaveRequest $request, DBOpinion $item) : \Illuminate\Http\Response
	{
		$a_res = $this->updateAPI($request, $item);
		return $a_res;
	}
}
