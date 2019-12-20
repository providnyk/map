<?php


#namespace App\Http\Controllers\API;
namespace Modules\Issue\API;

#use App\Issue;
use Modules\Issue\API\Issue;

#use App\Filters\IssueFilters;
use Modules\Issue\Filters\IssueFilters;

#use App\Http\Requests\IssueRequest;
#use Modules\Issue\Requests\IssueRequest;

use App\Http\Requests\DeleteRequest;

use App\Http\Controllers\ControllerAPI as Controller;

#use App\Http\Requests\IssueApiRequest;
use Modules\Issue\Http\IssueRequest;
use Modules\Issue\API\SaveRequest;

#use Modules\Issue\Http\Controllers\IssueController as Controller;

class IssueController extends Controller
{
	/**
	 * Prepare data for listing all of items
	 * @param Request	$request		Data from request
	 * @param Filters	$filters		Whatever filters applied
	 *
	 * @return Response	json instance of
	 */
#	public function index(IssueApiRequest $request, IssueFilters $filters) : \Illuminate\Http\Response
	public function index(IssueRequest $request, IssueFilters $filters) : \Illuminate\Http\Response
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
		return $this->storeAPI($request);
	}

	/**
	 * Updated item that is being edited
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function update(SaveRequest $request, Issue $item) : \Illuminate\Http\Response
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