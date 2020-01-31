<?php

namespace App\Http\Controllers;

use                 App\Http\Controllers\Controller as BaseController;

class ControllerAPI		extends BaseController
{
	protected $o_item = [];
	/**
	 * Prepare data for listing all of items
	 * this is also used by dynamic dropdowns
	 * @param Request	$request		Data from request
	 * @param Filters	$filters		Whatever filters applied
	 *
	 * @return Response	json instance of
	 */
	public function indexAPI($request, $filters) : \Illuminate\Http\Response
	{
		$this->setEnv();
		$o_items = $this->_env->s_model::filter($filters);
		return response([
			'draw'				=> $request->draw,
			'data'				=> $o_items->get(),
			'recordsTotal'		=> $this->_env->s_model::count(),
			'recordsFiltered'	=> $filters->getFilteredCount(),
		], 200);
	}

	/**
	 * Create a new item
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function storeAPI($request) : \Illuminate\Http\Response
	{
		$this->setEnv();
		$this->_env->s_model::_addBoolsValuesFromForm($request);

		$this->o_item = $this->_env->s_model::create($request->only($this->a_fields));
#        $design->processImages($request, 'image');

		return response(['id' => $this->o_item->id,], 200);
	}

	/**
	 * Updated item that is being edited
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function updateAPI($request, $item) : \Illuminate\Http\Response
	{
		$this->setEnv();
		$this->_env->s_model::_addBoolsValuesFromForm($request);
		$item->update($request->only($this->a_fields));
#        $design->update($request->only('enabled', 'uk', 'ru', 'en', 'de'));
#        $design->processImages($request, 'image');

		return response(['id' => $item->id,], 200);
	}

	/**
	 * Deleted selected item(s)
	 * @param Request	$request		Data from request
	 *
	 * @return Response	json instance of
	 */
	public function destroyAPI($request) : \Illuminate\Http\Response
	{
		$this->setEnv();
		$this->_env->s_model::destroy($request->ids);

		$number = count($request->ids);

		return response([
			'message' => trans('common/messages.designs_deleted', ['number' => $number], $number)
		], 200);
	}
}