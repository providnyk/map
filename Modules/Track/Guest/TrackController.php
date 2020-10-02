<?php

namespace Modules\Track\Guest;

use                                          Auth;
use                     App\Http\Controllers\ControllerGuest as Controller;
use                   Modules\Track\Database\Track;
use                          Illuminate\Http\Request;


class TrackController extends Controller
{
	/**
	 * Open CRUD form to authenticated user (aka "User" previously and now "Guest")
	 * for creating/editing the specified resource.
	 * @param Request	$request		Data from request
	 *
	 * @return View		instance of
	 */
	public function form(Request $request)
	{
		$this->setEnv();

		$user = Auth::user();

		return view($this->_env->s_view . 'form',
					[
						'b_admin'		=> $user->checkAdmin(),
						'track'			=> Track::findOrNew($request->id),
						'user'			=> $user,
					]);
	}
}
