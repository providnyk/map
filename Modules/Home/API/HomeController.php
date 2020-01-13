<?php

namespace Modules\Home\API;

use Modules\Home\API\Home;
use Modules\Home\Database\Home as DBHome;
use Modules\Home\Filters\HomeFilters;
use App\Http\Controllers\ControllerAPI as Controller;
use App\Http\Requests\DeleteRequest;
use Modules\Home\API\SaveRequest;
use Modules\Home\Http\HomeRequest;

class HomeController extends Controller
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
	public function index(HomeRequest $request, HomeFilters $filters) : \Illuminate\Http\Response
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
		$this->o_item->processImages($request);
		return $a_res;
	}

	/**
	 * Updated item that is being edited
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function update(SaveRequest $request, DBHome $item) : \Illuminate\Http\Response
	{
		$a_res = $this->updateAPI($request, $item);
		$item->processImages($request);
		return $a_res;
	}

}
