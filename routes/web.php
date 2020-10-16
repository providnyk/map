<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Api\EventApi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Factory;
use Spatie\Permission\Models\Role;

$a_list = config('fragment.list');
$a_modules = config('fragment.modules');

Route::group([
	'middleware' => []
], function() {

	Route::get('login',
		[
			'as'		=> 'login',
			'uses'		=>
							function(){
	    					return redirect(route('signin_page'));
							},
		]
	);

	Route::get('signin',			['as' => 'signin_page',			'uses' => 'Auth\SigninController@form']);
	Route::post('signin',			['as' => 'signin_page',			'uses' => 'Auth\SigninController@core']);
	Route::post('signout',			['as' => 'signout_user',		'uses' => 'Auth\LoginController@logout']);

	// Registration Routes...
	Route::get('signup',			['as' => 'signup_page',			'uses' => 'Auth\SignupController@form']);
	Route::post('signup',			['as' => 'signup_user',			'uses' => 'Auth\SignupController@core']);
	Route::get('signup/{token}',	['as' => 'signup_confirm',		'uses' => 'Auth\SignupController@confirm']);

	// Password Reset Routes...
	Route::get('reset',				['as' => 'password_reset',		'uses' => 'Auth\PasswordController@form']);
	Route::post('reset',			['as' => 'password_token',		'uses' => 'Auth\PasswordController@send']);
	Route::get('change/{token?}',	['as' => 'password_change',		'uses' => 'Auth\PasswordController@new']);
	Route::post('change/{token?}',	['as' => 'password_change',		'uses' => 'Auth\PasswordController@change']);
});

// Change language Route
Route::get('lang/{language}', ['as' => 'change-lang', 'uses' => 'LanguageController@changeLanguage']);

//Power routes
Route::group([
	'as' => 'user.',
	'namespace' => 'User',
	'middleware' => []
], function() {
	Route::group(['middleware' => 'auth'], function() {
		$s_model	= 'Track';
		$s_path		= strtolower($s_model);
		$s_ctrl		= '\Modules\\' . $s_model . '\User\\' . $s_model ;
		$s_ctrl		.='Controller';

		$s_method	= 'download';
		Route::get($s_path . '/download/{format}',	['as' => $s_path . '.' . $s_method,	'uses' => $s_ctrl . '@' . $s_method]);
	});
});

//Public routes
Route::group([
	'as' => 'guest.',
	'namespace' => 'Guest',
	'middleware' => []
], function() {
	$s_model	= 'Welcome';
	$s_path		= strtolower($s_model);
	$s_ctrl		= '\Modules\\' . $s_model . '\Guest\\' . $s_model ;
	$s_ctrl		.='Controller';
	$s_method	= 'index';
	Route::get('',									['as' => $s_path . '.' . $s_method,	'uses' => $s_ctrl . '@' . $s_method]);

	Route::get('info/{page_slug}', [
		'as' => 'page',
		'uses' => 'PageController@showStaticPage']
	);

	Route::group(['middleware' => 'auth'], function() {
		$s_model	= 'Personal';
		$s_path		= strtolower($s_model);
		$s_ctrl		= '\Modules\\' . $s_model . '\Guest\\' . $s_model ;
		$s_ctrl		.='Controller';

		$s_method	= 'profile';
		Route::get('my/profile',					['as' => $s_path . '.' . $s_method,	'uses' => $s_ctrl . '@' . $s_method]);
		$s_method	= 'update';
		Route::post('my/profile',					['as' => $s_path . '.' . $s_method,	'uses' => $s_ctrl . '@' . $s_method]);
		$s_method	= 'activity';
		Route::get('my/activity',					['as' => $s_path . '.' . $s_method,	'uses' => $s_ctrl . '@' . $s_method]);

		$s_model	= 'Place';
		$s_path		= strtolower($s_model);
		$s_ctrl		= '\Modules\\' . $s_model . '\Guest\\' . $s_model ;
		$s_ctrl		.='Controller';

		$s_method	= 'form';
		Route::get($s_path . '/add',				['as' => $s_path . '.' . $s_method,	'uses' => $s_ctrl . '@' . $s_method]);
		$s_method	= 'list';
		Route::get($s_path . '/all/{type?}/{tid?}',	['as' => $s_path . '.' . $s_method,	'uses' => $s_ctrl . '@' . $s_method]);
		$s_method	= 'save';
		Route::post($s_path . '/done',				['as' => $s_path . '.' . $s_method,	'uses' => $s_ctrl . '@' . $s_method]);
		$s_method	= 'view';
		Route::get($s_path . '/look/{id}',			['as' => $s_path . '.' . $s_method,	'uses' => $s_ctrl . '@' . $s_method]);

		$s_model	= 'Opinion';
		$s_path		= strtolower($s_model);
		$s_ctrl		= '\Modules\\' . $s_model . '\Guest\\' . $s_model ;
		$s_ctrl		.='Controller';

		$s_method	= 'form';
		Route::get($s_path . '/add',				['as' => $s_path . '.' . $s_method,	'uses' => $s_ctrl . '@' . $s_method]);
		Route::get($s_path . '/add/{type?}/{tid?}',	['as' => $s_path . '.' . $s_method,	'uses' => $s_ctrl . '@' . $s_method]);
		$s_method	= 'save';
		Route::post($s_path . '/done',				['as' => $s_path . '.' . $s_method,	'uses' => $s_ctrl . '@' . $s_method]);
		$s_method	= 'list';
		Route::get($s_path . '/all/{type?}/{tid?}',	['as' => $s_path . '.' . $s_method,	'uses' => $s_ctrl . '@' . $s_method]);
		$s_method	= 'view';
		Route::get($s_path . '/look/{id}',			['as' => $s_path . '.' . $s_method,	'uses' => $s_ctrl . '@' . $s_method]);
	});
});

//API Routes
Route::group([
	'as' => 'api.',
	'prefix' => 'api',
	'namespace' => 'API',
	'middleware' => [],
], function() use ($a_list, $a_modules) {

	$s_model	= 'Opinion';
	$s_path		= strtolower($s_model);
	$s_ctrl		= '\Modules\\' . $s_model . '\API\\' . $s_model ;
	$s_ctrl		= $s_ctrl . 'Controller';
	$s_method	= 'place';
	Route::get($s_path.'/'.$s_method.'/{pid}',		['as' => $s_path . '.' . $s_method,	'uses' => $s_ctrl . '@' . $s_method]);
	$s_method	= 'unvoted';
	Route::get($s_path.'/{id}/'.$s_method,			['as' => $s_path . '.' . $s_method,	'uses' => $s_ctrl . '@' . $s_method]);

	for ($i = 0; $i < count($a_list); $i++)
	{
		$s_ctrl = '';
		$s_model = $a_list[$i];
		if (in_array($s_model, $a_modules))
			$s_ctrl = '\Modules\\' . $s_model . '\API\\' . $s_model ;
		else
			$s_ctrl = $s_model;
		$s_path = strtolower($s_model);
		if (!empty($s_ctrl))
		{
			$s_ctrl .= 'Controller';
			Route::get($s_path . '/list',			['as' => $s_path . '.index',	'uses' => $s_ctrl . '@index']);
			Route::post($s_path,					['as' => $s_path . '.store',	'uses' => $s_ctrl . '@store']);
			Route::post($s_path . '/{item}/edit',	['as' => $s_path . '.update',	'uses' => $s_ctrl . '@update']);
			Route::post($s_path . '/delete',		['as' => $s_path . '.destroy',	'uses' => $s_ctrl . '@destroy']);
		}
	}
});

// API Routes
Route::group([
	'as' => 'api.',
	'prefix' => 'api',
	'namespace' => 'API',
	'middleware' => []#'language']
], function() {

	Route::post('users/{id}/password-change', ['as' => 'user.password-change', 'uses' => 'UserController@passwordChange']);

	Route::post('file', ['as' => 'upload.file', 'uses' => 'UploadController@file']);
	Route::post('image', ['as' => 'upload.image', 'uses' => 'UploadController@image']);

});

//Admin Routes
Route::group([
	'as' => 'admin.',
	'prefix' => 'admin',
	'namespace' => 'Admin',
	'middleware' => ['auth', 'role:admin']
], function() use ($a_list, $a_modules) {
	Route::get('dashboard', ['as' => 'home', 'uses' => 'DashboardController@index']);
	Route::get('session', ['as' => 'session', 'uses' => 'DashboardController@session']);

	for ($i = 0; $i < count($a_list); $i++)
	{
		$s_ctrl = '';
		$s_model = $a_list[$i];
		if (in_array($s_model, $a_modules))
			$s_ctrl = '\Modules\\' . $s_model . '\User\\' . $s_model ;
		else
			$s_ctrl = $s_model;
		$s_path = strtolower($s_model);
		if (!empty($s_ctrl))
		{
			$s_ctrl .= 'Controller';
			Route::get($s_path . '/list',		['as' => $s_path . '.index',	'uses' => $s_ctrl . '@index']);
			Route::get($s_path . '/form/{id?}',	['as' => $s_path . '.form',		'uses' => $s_ctrl . '@form']);
		}
	}

	$s_model	= 'Opinion';
	$s_path		= strtolower($s_model);
	$s_ctrl		= '\Modules\\' . $s_model . '\User\\' . $s_model ;
	$s_ctrl		.='Controller';

	$s_method	= 'place';
	Route::get($s_path . '/place/{id?}',		['as' => $s_path . '.' . $s_method,	'uses' => $s_ctrl . '@' . $s_method]);

});

//Public routes
Route::group([
	'as' => 'public.',
	'namespace' => 'Frontend',
	'middleware' => []#'language']
], function() {
	Route::group(['middleware' => 'auth'], function() {
	});
});

Route::post('upload-image',
	[
		'as' => 'upload-image',
		'uses' =>  function(Request $request, Factory $validator) {
			$v = $validator->make($request->all(), [
				'upload' => 'required',
			]);

			$funcNum = $request->input('CKEditorFuncNum');

			if ($v->fails()) {
				return response([
					'message' => 'something went wrong'
				]);
			}

			$image = $request->file('upload');
			$image->store('public/uploads');
			$url = asset('storage/uploads/'.$image->hashName());

			return response()->json([
				'uploaded' => 1,
				'fileName' => $image->hashName(),
				'url' => $url
			]);
		}
	]
);

Route::get('test/role', function(){
	$user = User::where('id', 17)->with('roles')->first();

	dd($user->toArray(), $user->hasRole('admin'));
});

Route::get('refresh-csrf',
	[
		'as'		=> 'get-csrf',
		'uses'		=>
						function(){
    					return csrf_token();
						},
	]
);