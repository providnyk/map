<?php

namespace Modules\Report\User;

use App\Http\Controllers\ControllerUser as Controller;
use App\Point;
use Illuminate\Http\Request;

class ReportController extends Controller
{
	/**
	 * Open CRUD form for authenticated user (aka "Admin" previously and now "User")
	 * @param Request	$request		Data from request
	 *
	 * @return View		instance of
	 */
	public function form(Request $request) : \Illuminate\View\View
	{
		\View::composer('user.*', function ($view) {
			$view->with([
				'points'		=> Point::all()->sortBy('name'),
			]);
		});
		return parent::form($request);
	}
}
