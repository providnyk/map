<?php

namespace Modules\Issue\User;

#use Modules\Issue\Http\Controllers\IssueController as Controller;
use App\Http\Controllers\ControllerUser as Controller;
use App\Design;
use Illuminate\Http\Request;

class IssueController extends Controller
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
				'designs'		=> Design::all()->sortBy('name'),
			]);
		});
		return parent::form($request);
	}
}
