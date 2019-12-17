<?php

namespace App\Http\Controllers\API;

use App\Point;
use App\Filters\PointFilters;
use App\Http\Requests\PointRequest;
use App\Http\Requests\DeleteRequest;
use App\Http\Controllers\ControllerAPI as Controller;
use App\Http\Requests\PointApiRequest;

class PointController extends Controller
{
	/**
	 * Prepare data for listing all of items
	 * @param Request	$request		Data from request
	 * @param Filters	$filters		Whatever filters applied
	 *
	 * @return Response	json instance of
	 */
	public function index(PointApiRequest $request, PointFilters $filters) : \Illuminate\Http\Response
	{
		return $this->indexAPI($request, $filters);
	}

	/**
	 * Create a new item
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function store(PointRequest $request) : \Illuminate\Http\Response
	{
		$request->merge([
			'user_id' => \Auth::user()->id,
		]);
		return $this->storeAPI($request);
	}

	/**
	 * Updated item that is being edited
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function update(PointRequest $request, Point $item) : \Illuminate\Http\Response
	{
		$item->groups()->sync($request->group_ids);
		$a_res = $this->updateAPI($request, $item);
		return $a_res;
	}

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
}