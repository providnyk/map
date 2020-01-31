<?php

namespace Modules\Opinion\User;

#use Modules\Opinion\Http\Controllers\OpinionController as Controller;
use                 App\Http\Controllers\ControllerUser as Controller;
use             Modules\Element\Database\Element;
use                Modules\Mark\Database\Mark;
use               Modules\Place\Database\Place;
use                      Illuminate\Http\Request;

class OpinionController extends Controller
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
				'element'		=> Element::all()->sortBy('title'),
				'mark'			=> Mark::all()->sortBy('title'),
				'place'			=> Place::all()->sortBy('title'),
			]);
		});
		return parent::form($request);
	}
}
