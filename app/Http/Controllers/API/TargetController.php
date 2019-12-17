<?php

namespace App\Http\Controllers\API;

use App\Target;
use App\Filters\TargetFilters;
use App\Http\Requests\TargetRequest;
use App\Http\Requests\DeleteRequest;
use App\Http\Controllers\ControllerAPI as Controller;
use App\Http\Requests\TargetApiRequest;

class TargetController extends Controller
{
	/**
	 * Prepare data for listing all of items
	 * @param Request	$request		Data from request
	 * @param Filters	$filters		Whatever filters applied
	 *
	 * @return Response	json instance of
	 */
	public function index(TargetApiRequest $request, TargetFilters $filters) : \Illuminate\Http\Response
	{
		return $this->indexAPI($request, $filters);
	}

	/**
	 * Create a new item
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function store(TargetRequest $request) : \Illuminate\Http\Response
	{
#		dd($request->all());
/*
$request->validate([
    'annotation' => 'nullable',
    'uk.annotation' => 'nullable',
    'de.annotation' => 'nullable',
    'en.annotation' => 'nullable',
]);
*/
		return $this->storeAPI($request);
	}

	/**
	 * Updated item that is being edited
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function update(TargetRequest $request, Target $item) : \Illuminate\Http\Response
	{
		return $this->updateAPI($request, $item);
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