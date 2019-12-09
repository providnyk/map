<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;

class ControllerAPI		extends BaseController
{
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
		$o_items = $this->_env->s_model::orderBy('title')->filter($filters);
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
/*
		$m = new Design;
		dump($m->translatedAttributes);
		$t = new DesignTranslation;
		$m->translatedAttributes = $t->getFillable();
#	    $this->translatedAttributes = array_merge($this->translatedAttributes, $m->getFillable());
		dd($m->translatedAttributes);
*/
#        $design = Design::create($request->only($m->translatedAttributes));
#		dd(config('translatable.locales'));
#		dump($this->a_fields);
		$item = $this->_env->s_model::create($request->only($this->a_fields));
#        $design->processImages($request, 'image');

		return response([], 200);
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

		return response([], 200);
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