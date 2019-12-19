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
/*
Route::prefix('issue')->group(function() {
    Route::get('/', 'IssueController@index');
});
*/
/*
$a_items = [
		'buildings'		=> 'Building',
		'designs'		=> 'Design',
#		'issues'		=> 'Issue',
		'ownerships'	=> 'Ownership',
		'points'		=> 'Point',
		'targets'		=> 'Target',
		'users'			=> 'User',
];

$a_modules = [
#		'companies'		=> 'Company',
		'issues'		=> 'Issue',
];

// API Routes
Route::group([
    'as' => 'api.',
#    'prefix' => 'api',
#    'namespace' => 'Modules',
    'middleware' => []#'language']
], function() use ($a_items, $a_modules) {
	foreach ($a_modules AS $s_table => $s_model)
	{
#	$s_ctrl = '\\Modules\\' . $s_model . '\\Object\\' . $s_model . 'API';
#	$s_ctrl = '\\Modules\\' . $s_model . '\\Http\\Controllers\\' . $s_model . 'API';
	$s_ctrl = $s_model . 'API';
	Route::get($s_table, ['as' => $s_table . '.index', 'uses' => $s_ctrl . '@index']);
	Route::post($s_table, ['as' => $s_table . '.store', 'uses' => $s_ctrl . '@store']);
	Route::post($s_table . '/{item}/edit', ['as' => $s_table . '.update', 'uses' => $s_ctrl . '@update']);
	Route::post($s_table . '/delete', ['as' => $s_table . '.delete', 'uses' => $s_ctrl . '@destroy']);
	}
});
*/