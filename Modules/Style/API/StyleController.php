<?php


#namespace App\Http\Controllers\API;
namespace Modules\Style\API;

#use App\Style;
use                    Modules\Style\API\Style;
use               Modules\Style\Database\Style          as DBStyle;

#use App\Filters\StyleFilters;
use                Modules\Style\Filters\StyleFilters;

#use App\Http\Requests\StyleRequest;
#use Modules\Style\Requests\StyleRequest;

use                    App\Http\Requests\DeleteRequest;

use                 App\Http\Controllers\ControllerAPI  as Controller;

#use App\Http\Requests\StyleApiRequest;
use                   Modules\Style\Http\StyleRequest;
use                    Modules\Style\API\SaveRequest;

#use Modules\Style\Http\Controllers\StyleController as Controller;

class StyleController extends Controller
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
#	public function index(StyleApiRequest $request, StyleFilters $filters) : \Illuminate\Http\Response
	public function index(StyleRequest $request, StyleFilters $filters) : \Illuminate\Http\Response
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
		$a_res = $this->storeAPI($request);
		$this->o_item->building()->sync($request->building_ids);
		$this->o_item->element()->sync($request->element_ids);
		return $a_res;
	}

	/**
	 * Updated item that is being edited
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function update(SaveRequest $request, DBStyle $item) : \Illuminate\Http\Response
	{
		$item->element()->sync($request->element_ids);
		$a_res = $this->updateAPI($request, $item);
		return $a_res;
	}
}
