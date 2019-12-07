<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\PasswordResets;
use App\Traits\FestivalTrait;
use App\User;
use App\Country;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
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

    use FestivalTrait {
        FestivalTrait::__construct as protected __traitConstruct;
    }

    public function __construct(Request $request)
    {
        $this->middleware('guest')->except('logout');

        $this->__traitConstruct($request);
    }

    public function register(Request $request){

        $data = $request->post();

        $validator = Validator::make($data, [
            'g-recaptcha-response'=>'required|recaptcha',
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response([
                'message' => 'Validation fails',
                'errors' => $validator->errors()
            ], 422);
        }

        $token = sha1(Str::random(60));

        $user = User::create([
            'country_id'        => $data['profile_country'],
            'first_name'        => $data['first_name'],
            'last_name'         => $data['last_name'],
            'email'             => $data['email'],
            'password'          => Hash::make($data['password']),
            'activation_token'  => $token,
        ]);

        Mail::send('emails.registration', [ 'token' => $token, 'email' => $data['email'] ], function($message) use ($request) {
            $message->from(config('services.mail.from'), config('services.mail.name'))
                ->to($request->post('email'))->subject(trans('common/messages.email.subject'));
        });

        return response([
            'message' => trans('common/messages.email.link_sent')
        ], 200);

    }

    public function confirmRegistration($token){

        $user = User::where('activation_token', $token)->first();

        if( ! $user){
            return redirect('home');
        }

        $user->active = 1;
        $user->save();

        Auth::login($user);

        return redirect(route('public.cabinet'));
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1])) {
            return back();
        }
        return redirect(route('public.cabinet'));
    }

    public function showLoginForm()
    {
        return view('public.profile.login',
                    [
                        'countries'    => Country::published()->get()->sortBy('name'),
                    ]);
    }

    function resetPasswordForm()
    {
        return view('public.profile.password-reset');
    }

    function resetPassword(Request $request)
    {
        $validator = Validator::make($request->post(), [
            'email' => ['required', 'exists:users,email']
        ]);

        if($validator->fails())
        {
            return response([
                'message' => trans('messages.validation.fail'),
                'errors' => $validator->errors()
            ], 422);
        }

        $hash = sha1(Str::random(60));

        Mail::send('emails.password-reset', ['hash' => $hash], function($message) use ($request) {
            $message->to($request->post('email'))->subject('Password reset');
        });

        $data = [
            'email' => $request->post('email'),
            'token' => $hash,
            'created_at' => now()
        ];

        $reset_password = DB::table('password_resets')->where('email', $request->post('email'));

        $reset_password->count() ? $reset_password->update($data) : $reset_password->insert($data);

        return response([
            'message' => trans('messages.password-reset.success'),
        ], 200);

    }

    function changePasswordForm($token)
    {
        $user = $this->checkToken($token);

        if( ! $user){
            return response([
                'message' => trans('messages.validation.fail'),
                'errors' => [
                    'token' => 'Token is not valid'
                ]
            ], 422);
        }

        return view('public.profile.password-change', [
            'token' => $token
        ]);
    }

    function changePassword($token, Request $request)
    {
        $user = $this->checkToken($token);

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
            'message' => trans('messages.password-change.success'),
        ], 200);

    }

    private function checkToken($token)
    {
        $reset_password = PasswordResets::where('token', $token)->where('created_at', '>', Carbon::now()->subHour())->first();

        return $reset_password ? $reset_password->user : false;
    }

    protected function redirectTo()
    {
        return route('public.cabinet');
    }

}
