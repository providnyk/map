<?php

namespace App\Http\Controllers;

use                     App\Http\Controllers\Controller     as BaseController;

class ControllerAPI		extends BaseController
{
	protected $o_item = [];
	/**
	 * Prepare data for listing all of items
	 * this is also used by dynamic dropdowns
	 * @param Request	$request		Data from request
	 * @param Filters	$filters		Whatever filters applied
	 * @param Array		$a_with			what related models to be included
	 *
	 * @return Response	json instance of
	 */
	public function indexAPI($request, $filters, Array $a_with = []) : \Illuminate\Http\Response
	{
		$this->setEnv();
		$o_items	= $this->_env->s_model::filter($filters);
		$i_tmp		= count($a_with);
		for ($i = 0; $i < count($a_with); $i++)
			$o_items->with($a_with[$i]);
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

		$s_tmp						= $this->_env->s_model;
		if (class_exists($s_tmp))
		{
			$m						= new $s_tmp;
#			$a_fill_main			= $m->getFillable();
			$a_form_main			= $m->getFields();
		}

		foreach ($a_form_main AS $s_field_name => $s_field_params)
		{
			if (isset($s_field_params['default']) && is_null($request->$s_field_name))
				$request->$s_field_name = $s_field_params['default'];
		}

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