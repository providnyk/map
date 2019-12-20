<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class ControllerUser	extends BaseController
{
	/**
	 * Open CRUD form to authenticated user (aka "Admin" previously and now "User")
	 * for creating/editing the specified resource.
	 * @param Request	$request		Data from request
	 *
	 * @return View		instance of
	 */
	public function form(Request $request) : \Illuminate\View\View
	{
		$this->setEnv();
		$fn_find = $this->_env->fn_find;

		$this->validate($request, [
			'id' => 'integer'
		]);

		return view($this->_env->s_view . 'form', [
			$this->_env->s_plr		=> $fn_find($request->id),
		]);
	}

	/**
	 * Show list of items for authenticated user (aka "Admin" previously and now "User")
	 *
	 * @param void
	 *
	 * @return View		instance of
	 */
	public function index() : \Illuminate\View\View
	{
		$this->setEnv();
		return view($this->_env->s_view . 'list', [
			'dates'					=> $this->_env->s_model::getTimestampDates(),
		]);
	}
}
