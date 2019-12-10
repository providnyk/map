<?php

namespace App\Http\Controllers\Admin;

use App\Design;
use App\Group;
use App\Http\Controllers\ControllerUser as Controller;
use Illuminate\Http\Request;

class PointController extends Controller
{
	/**
	 * Open CRUD form for authenticated user (aka "Admin" previously and now "User")
	 * @param Request	$request		Data from request
	 *
	 * @return View		instance of
	 */
	public function form(Request $request) : \Illuminate\View\View
	{
        \View::composer('admin.*', function ($view) {
            $view->with([
                'designs'	=> Design::all()->sortBy('name'),
                'groups'	=> Group::all()->sortBy('name'),
            ]);
        });
		return parent::form($request);
	}
}