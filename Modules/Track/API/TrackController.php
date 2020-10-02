<?php


#namespace App\Http\Controllers\API;
namespace Modules\Track\API;

#use App\Track;
use               Modules\Complaint\Database\Complaint;
use                        Modules\Track\API\Track;
use                   Modules\Track\Database\Track as DBTrack;

#use App\Filters\TrackFilters;
use                    Modules\Track\Filters\TrackFilters;

#use App\Http\Requests\TrackRequest;
#use Modules\Track\Requests\TrackRequest;

use                        App\Http\Requests\DeleteRequest;

use                     App\Http\Controllers\ControllerAPI as Controller;
#use App\Http\Requests\TrackApiRequest;
use                       Modules\Track\Http\TrackRequest;
use                        Modules\Track\API\SaveRequest;

#use Modules\Track\Http\Controllers\TrackController as Controller;

class TrackController extends Controller
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
	public function index(TrackRequest $request, TrackFilters $filters) : \Illuminate\Http\Response
	{
		$i_debug		= 0;
		if ($request->debug && $request->length == 1 && \Auth::user())
		{
			$i_debug	= (int) $request->id;
		}
		return $this->indexAPI($request, $filters, ['user']);
	}

	/**
	 * Create a new item
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function store(SaveRequest $request) : \Illuminate\Http\Response
	{
 		if (\Auth::user())
 		{
			$request->merge([
				'user_id' => is_null(\Auth::user()) ?: \Auth::user()->id,
			]);
 		}
		$a_res = $this->storeAPI($request);
		return $a_res;
	}

	/**
	 * Updated item that is being edited
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function update(SaveRequest $request, DBTrack $item) : \Illuminate\Http\Response
	{
		$a_res = $this->updateAPI($request, $item);
		return $a_res;
	}
}
