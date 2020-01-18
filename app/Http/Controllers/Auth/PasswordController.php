<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\LoginController as Controller;
use App\PasswordResets;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ResetRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

	function change($token = NULL, Request $request)
	{
		if (!is_null($request->post('token')))
			$token = $request->post('token');

		$user = $this->_checkToken($token);

		if( ! $user){
			return response([
				'message' => trans('messages.validation.fail'),
				'errors' => [
					'token' => 'Token is not valid'
				]
			], 422);
		}

		$validator = Validator::make(request()->post(), [
			'password' => 'required|string|confirmed|min:6|max:20',
			'password_confirmation' => 'required|string'
		]);

		if($validator->fails())
		{
			return response([
				'message' => trans('messages.validation.fail'),
				'errors' => $validator->errors()
			], 422);
		}

		$user->password = bcrypt($request->post('password'));
		$user->save();

		Auth::login($user);

		return response([
			'message' => trans('user/form.text.reset_done'),
			'url'		=> route('public.cabinet'),
		], 200);

	}

	function form()
	{
		$this->setEnv();

#		return view('public.profile.password-reset');
		return view($this->_env->s_view . 'password',
					[
						'tab'			=> request()->segment(2),
					]);
	}

	function new($token = NULL)
	{
/*
		$user = $this->_checkToken($token);

		if( ! $user){
			return response([
				'message' => trans('messages.validation.fail'),
				'errors' => [
					'token' => 'Token is not valid'
				]
			], 422);
		}
*/
		$this->setEnv();

		return view($this->_env->s_view . 'password',
					[
						'tab'			=> request()->segment(1),
						'token'			=> $token,
					]);
/*
		return view('public.profile.password-change', [
			'token' => $token
		]);
*/
	}

	function send(ResetRequest $request)
	{
		$data = $request->post();
		$validator = Validator::make($data, []);

		if($validator->fails())
		{
			return response([
				'message' => trans('messages.validation.fail'),
				'errors' => $validator->errors()
			], 422);
		}

		$hash = sha1(Str::random(60));

		Mail::send('emails.password-reset', ['hash' => $hash], function($message) use ($request) {
			$message->to($request->post('email'))->subject(trans('user/form.text.reset_subj'));
		});

		$data = [
			'email' => $request->post('email'),
			'token' => $hash,
			'created_at' => now()
		];

		$reset_password = DB::table('password_resets')->where('email', $request->post('email'));

		$reset_password->count() ? $reset_password->update($data) : $reset_password->insert($data);

		return response([
			'message'	=> trans('user/form.text.reset_sent'),
			'url'		=> route('password_change', ['token' => NULL]),
		], 200);

	}


	private function _checkToken($token)
	{
		$reset_password = PasswordResets::where('token', $token)->where('created_at', '>', Carbon::now()->subHour())->first();

		return $reset_password ? $reset_password->user : false;
	}

}
