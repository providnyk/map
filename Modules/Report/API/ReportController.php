<?php

namespace Modules\Report\API;

use Modules\Report\API\Report;
use Modules\Report\Filters\ReportFilters;
use App\Http\Controllers\ControllerAPI as Controller;
use App\Http\Requests\DeleteRequest;
use Modules\Report\API\SaveRequest;
use Modules\Report\Http\ReportRequest;

class ReportController extends Controller
{
	/**
	 * Prepare data for listing all of items
	 * @param Request	$request		Data from request
	 * @param Filters	$filters		Whatever filters applied
	 *
	 * @return Response	json instance of
	 */
	public function index(ReportRequest $request, ReportFilters $filters) : \Illuminate\Http\Response
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
		return $this->storeAPI($request);
	}

	/**
	 * Updated item that is being edited
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function update(SaveRequest $request, Report $item) : \Illuminate\Http\Response
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
