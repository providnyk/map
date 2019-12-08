<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class ControllerUser	extends BaseController
{
	/**
	 * Open CRUD form for authenticated user (aka "Admin" previously and now "User")
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

		return view('admin.'.$this->_env->s_plr.'.form', [
			$this->_env->s_sgl		=> $fn_find($request->id),
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
        return view('admin.'.$this->_env->s_plr.'.list', [
            'dates'             => $this->_env->s_model::getTimestampDates(),
        ]);
    }
}
