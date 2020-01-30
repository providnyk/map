<?php

namespace Modules\Place\Guest;

                                 use Auth;
       use Modules\Building\Database\Building;
            use App\Http\Controllers\ControllerGuest as Controller;
#                                 use Hash;
          use Modules\Place\Database\Place;
                 use Illuminate\Http\Request;
#                             use App\Subscriber;
#                             use App\User;
#                                 use Validator;


class PlaceController extends Controller
{
	public function form(Request $request)
	{
		$this->setEnv();

		$user = Auth::user();

		return view($this->_env->s_view . 'form',
					[
						'b_admin'		=> $user->checkAdmin(),
						'building'		=> Building::all()->sortBy('name'),
						'place'			=> Place::findOrNew($request->id),
						'user'			=> $user,
					]);
	}

}
