<?php

namespace App\Http\Controllers\Auth;

use App\Country;
use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\ResetRequest;
#use App\Traits\FestivalTrait;
use App\User;
use Carbon\Carbon;
use Cookie;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController	extends BaseController
{
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;
/*
	use FestivalTrait {
		FestivalTrait::__construct as protected __traitConstruct;
	}
*/
	public function __construct(Request $request)
	{
		$this->middleware('guest')->except('logout');
#		$this->__traitConstruct($request);
	}

	protected function redirectTo()
	{
		return route('public.cabinet');
	}

}
