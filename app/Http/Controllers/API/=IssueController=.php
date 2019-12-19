<?php

namespace App\Http\Controllers\API;

use App\Issue;
use App\Filters\IssueFilters;
use App\Http\Requests\IssueRequest;
use App\Http\Requests\DeleteRequest;
use App\Http\Controllers\ControllerAPI as Controller;
use App\Http\Requests\IssueApiRequest;

class IssueController_1 extends Controller
{
	/**
	 * Prepare data for listing all of items
	 * @param Request	$request		Data from request
	 * @param Filters	$filters		Whatever filters applied
	 *
	 * @return Response	json instance of
	 */
	public function index(IssueApiRequest $request, IssueFilters $filters) : \Illuminate\Http\Response
	{
		return $this->indexAPI($request, $filters);
	}

	/**
	 * Create a new item
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function store(IssueRequest $request) : \Illuminate\Http\Response
	{
		return $this->storeAPI($request);
	}

	/**
	 * Updated item that is being edited
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function update(IssueRequest $request, Issue $item) : \Illuminate\Http\Response
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