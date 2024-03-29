<?php

namespace Modules\Track\User;

#use Modules\Track\Http\Controllers\TrackController as Controller;
use                     App\Http\Controllers\ControllerUser as Controller;
use                          Illuminate\Http\Request;
use                       Modules\Track\User\Track;

class TrackController extends Controller
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
