<?php

namespace App\Http\Controllers\Admin;

use App\Design;
use App\Http\Controllers\ControllerUser as Controller;
use Illuminate\Http\Request;

class DesignController extends Controller
{
public function form(Request $request) : \Illuminate\View\View
	{
dd($request->id,
#	$this->_env->s_model,
	Design::with('images')->findOrNew($request->id)->images->count(),
	Design::with('images')->findOrNew($request->id),
#	Report::with('image')->findOrNew($request->id)->image,
#	$fn_with('image')->findOrNew($request->id)
	''
);

		\View::composer('user.*', function ($view) {
			$view->with([
				'issue'			=> Issue::all()->sortBy('title'),
				'point'			=> Point::all()->sortBy('title'),
			]);
		});
		return parent::form($request);
	}
}
