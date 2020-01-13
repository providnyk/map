<?php

namespace Modules\Home\User;

use App\Http\Controllers\ControllerUser as Controller;
use App\Point;
use Modules\Issue\Database\Issue;
use Modules\Home\Database\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
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
				'issue'			=> Issue::all()->sortBy('title'),
				'point'			=> Point::all()->sortBy('title'),
			]);
		});
		return parent::form($request);
	}
}
