<?php

namespace Modules\Place\User;

#use Modules\Place\Http\Controllers\PlaceController as Controller;
use App\Http\Controllers\ControllerUser as Controller;
use Modules\Building\Database\Building;
use                          Illuminate\Http\Request;
use                       Modules\Place\User\Place;

class PlaceController extends Controller
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
				'building'		=> Building::all()->sortBy('title'),
			]);
		});
		return parent::form($request);
	}
	public function download(Request $request, $format)
	{
		$this->setEnv();
		$s = str_replace('Database', 'User', $this->_env->s_model);
		$m = new $s;
		return $m::download();
	}
}
