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

$a_items = [
		'points'		=> 'Point',
		'groups'		=> 'Group',
		'designs'		=> 'Design',
		'users'			=> 'User',
];

Route::group([
    'middleware' => ['language']
], function() {
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => '', 'uses' => 'Auth\LoginController@login']);
    Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

    // Registration Routes...
    Route::get('register/{token}', ['as' => 'confirm-registration', 'uses' => 'Auth\LoginController@confirmRegistration']);
    Route::post('register', ['as' => 'register', 'uses' => 'Auth\LoginController@register']);

    // Password Reset Routes...
    Route::get('password/reset', ['as' => 'password.reset-form', 'uses' => 'Auth\LoginController@resetPasswordForm']);
    Route::post('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\LoginController@resetPassword']);
    Route::get('password/change/{token}', ['as' => 'password.change-form', 'uses' => 'Auth\LoginController@changePasswordForm']);
    Route::post('password/change/{token}', ['as' => 'password.change', 'uses' => 'Auth\LoginController@changePassword']);
});

//Route::get('password/reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
//Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
//Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
//Route::post('password/reset', ['as' => '', 'uses' => 'Auth\ResetPasswordController@reset']);

// Change language Route
Route::get('lang/{language}', ['as' => 'change-lang', 'uses' => 'LanguageController@changeLanguage']);

// API Routes
Route::group([
    'as' => 'api.',
    'prefix' => 'api',
    'namespace' => 'API',
    'middleware' => ['language']
], function() use ($a_items) {

	foreach ($a_items AS $s_table => $s_model)
	{
	    Route::get($s_table, ['as' => $s_table . '.index', 'uses' => $s_model . 'Controller@index']);
	    Route::post($s_table, ['as' => $s_table . '.store', 'uses' => $s_model . 'Controller@store']);
	    Route::put($s_table . '/{item}/edit', ['as' => $s_table . '.update', 'uses' => $s_model . 'Controller@update']);
	    Route::post($s_table . '/delete', ['as' => $s_table . '.delete', 'uses' => $s_model . 'Controller@destroy']);
	}

/*
    // Static Texts API Routes
    Route::get('texts', ['as' => 'texts.index', 'uses' => 'TextController@index']);
    Route::post('texts', ['as' => 'texts.store', 'uses' => 'TextController@store']);
    Route::post('texts/{text}/edit', ['as' => 'texts.update', 'uses' => 'TextController@update']);
    Route::post('texts/delete', ['as' => 'texts.delete', 'uses' => 'TextController@destroy']);

    // Settings API Routes
    Route::get('settings', ['as' => 'settings.index', 'uses' => 'SettingController@index']);
    Route::post('settings', ['as' => 'settings.store', 'uses' => 'SettingController@store']);
    Route::post('settings/{setting}/edit', ['as' => 'settings.update', 'uses' => 'SettingController@update']);
    Route::post('settings/delete', ['as' => 'settings.delete', 'uses' => 'SettingController@destroy']);

    // Artist API Routes
    Route::get('artists', ['as' => 'artists.index', 'uses' => 'ArtistController@index']);
    Route::post('artists', ['as' => 'artists.store', 'uses' => 'ArtistController@store']);
    Route::post('artists/{artist}/edit', ['as' => 'artists.update', 'uses' => 'ArtistController@update']);
    Route::post('artists/delete', ['as' => 'artists.delete', 'uses' => 'ArtistController@destroy']);

    // Vocations API Routes
    Route::get('vocations', ['as' => 'vocations.index', 'uses' => 'VocationController@index']);
    Route::post('vocations', ['as' => 'vocations.store', 'uses' => 'VocationController@store']);
    Route::post('vocations/{vocation}/edit', ['as' => 'vocations.update', 'uses' => 'VocationController@update']);
    Route::post('vocations/delete', ['as' => 'vocations.delete', 'uses' => 'VocationController@destroy']);

    // Professions API Routes
    Route::get('professions', ['as' => 'professions.index', 'uses' => 'ProfessionController@index']);
    Route::post('professions', ['as' => 'professions.store', 'uses' => 'ProfessionController@store']);
    Route::post('professions/{profession}/edit', ['as' => 'professions.update', 'uses' => 'ProfessionController@update']);
    Route::post('professions/delete', ['as' => 'professions.delete', 'uses' => 'ProfessionController@destroy']);

    // Designs API Routes
    Route::get('books', ['as' => 'books.index', 'uses' => 'BookController@index']);
    Route::post('books', ['as' => 'books.store', 'uses' => 'BookController@store']);
    Route::post('books/{book}/edit', ['as' => 'books.update', 'uses' => 'BookController@update']);
    Route::post('books/delete', ['as' => 'books.delete', 'uses' => 'BookController@destroy']);

    // Pages API Routes
    Route::get('pages', ['as' => 'pages.index', 'uses' => 'PageController@index']);
    Route::post('pages', ['as' => 'pages.store', 'uses' => 'PageController@store']);
    Route::post('pages/{page}/edit', ['as' => 'pages.update', 'uses' => 'PageController@update']);
    Route::post('pages/delete', ['as' => 'pages.delete', 'uses' => 'PageController@destroy']);

    // Categories API Routes
    Route::get('categories', ['as' => 'categories.index', 'uses' => 'CategoryController@index']);
    Route::post('categories', ['as' => 'categories.store', 'uses' => 'CategoryController@store']);
    Route::post('categories/{category}/edit', ['as' => 'categories.update', 'uses' => 'CategoryController@update']);
    Route::post('categories/delete', ['as' => 'categories.delete', 'uses' => 'CategoryController@destroy']);

    // Cities API Routes
    Route::get('cities', ['as' => 'cities.index', 'uses' => 'CityController@index']);
    Route::post('cities', ['as' => 'cities.store', 'uses' => 'CityController@store']);
    Route::post('cities/{city}/edit', ['as' => 'cities.update', 'uses' => 'CityController@update']);
    Route::post('cities/delete', ['as' => 'cities.delete', 'uses' => 'CityController@destroy']);

    // Events API Routes
    Route::get('events', ['as' => 'events.index', 'uses' => 'EventController@index']);

    Route::post('events', ['as' => 'events.store', 'uses' => 'EventController@store']);
    Route::post('events/{event}/edit', ['as' => 'events.update', 'uses' => 'EventController@update']);
    Route::post('events/delete', ['as' => 'events.delete', 'uses' => 'EventController@destroy']);

    Route::get('galleries', ['as' => 'galleries.index', 'uses' => 'GalleryController@index']);
    Route::post('galleries', ['as' => 'galleries.store', 'uses' => 'GalleryController@store']);
    Route::post('galleries/{gallery}/edit', [
        'as' => 'galleries.update', 'uses' => 'GalleryController@update'
    ]);
    Route::post('galleries/delete', ['as' => 'galleries.delete', 'uses' => 'GalleryController@destroy']);

    // News API Routes
    Route::get('news', ['as' => 'posts.index', 'uses' => 'NewsController@index']);
    Route::post('news', ['as' => 'posts.store', 'uses' => 'NewsController@store']);
    Route::post('news/{post}/edit', ['as' => 'news.update', 'uses' => 'NewsController@update']);
    Route::post('news/delete', ['as' => 'news.delete', 'uses' => 'NewsController@destroy']);

    // Media API Routes
    Route::get('media', ['as' => 'media.index', 'uses' => 'MediaController@index']);
    Route::post('media', ['as' => 'media.store', 'uses' => 'MediaController@store']);
    Route::post('media/{media}/edit', ['as' => 'media.update', 'uses' => 'MediaController@update']);
    Route::post('media/delete', ['as' => 'media.delete', 'uses' => 'MediaController@destroy']);

    // Festivals API Routes
    Route::get('festivals', ['as' => 'festivals.index', 'uses' => 'FestivalController@index']);
    Route::post('festivals', ['as' => 'festivals.store', 'uses' => 'FestivalController@store']);
    Route::post('festivals/{festival}/edit', [
        'as' => 'festivals.update',
        'uses' => 'FestivalController@update'
    ]);

    Route::post('festivals/delete', ['as' => 'festivals.delete', 'uses' => 'FestivalController@destroy']);

    // Partners API Routes
    Route::get('partners', ['as' => 'partners.index', 'uses' => 'PartnerController@index']);
    Route::post('partners', ['as' => 'partners.store', 'uses' => 'PartnerController@store']);
    Route::post('partners/{partner}/edit', [
        'as' => 'partners.update',
        'uses' => 'PartnerController@update'
    ]);

    Route::post('partners/delete', ['as' => 'partners.delete', 'uses' => 'PartnerController@destroy']);

    // Places API Routes
    Route::get('places', ['as' => 'places.index', 'uses' => 'PlaceController@index']);
    Route::post('places', ['as' => 'places.store', 'uses' => 'PlaceController@store']);
    Route::post('places/{place}/edit', ['as' => 'places.update', 'uses' => 'PlaceController@update']);
    Route::post('places/delete', ['as' => 'places.delete', 'uses' => 'PlaceController@destroy']);

    // Presses API Routes
    Route::get('press', ['as' => 'presses.index', 'uses' => 'PressController@index']);
    Route::post('press', ['as' => 'presses.store', 'uses' => 'PressController@store']);
    Route::post('press/{press}/edit', ['as' => 'presses.update', 'uses' => 'PressController@update']);
    Route::post('press/delete', ['as' => 'presses.delete', 'uses' => 'PressController@destroy']);


    // Slides API Routes
    Route::get('slides', ['as' => 'slides.index', 'uses' => 'SlideController@index']);
    Route::post('slides', ['as' => 'slides.store', 'uses' => 'SlideController@store']);
    Route::post('slides/{slide}/edit', ['as' => 'slides.update', 'uses' => 'SlideController@update']);
    Route::post('slides/delete', ['as' => 'slides.delete', 'uses' => 'SlideController@destroy']);

    // Sliders API Routes
    Route::get('sliders', ['as' => 'sliders.index', 'uses' => 'SliderController@index']);
    Route::post('sliders', ['as' => 'sliders.store', 'uses' => 'SliderController@store']);
    Route::post('sliders/{slider}/edit', ['as' => 'sliders.update', 'uses' => 'SliderController@update']);
    Route::post('sliders/delete', ['as' => 'sliders.delete', 'uses' => 'SliderController@destroy']);

    // Users API Routes
    Route::get('users', ['as' => 'users.index', 'uses' => 'UserController@index']);
    Route::post('users', ['as' => 'users.store', 'uses' => 'UserController@store']);
    Route::post('users/{user}/update', ['as' => 'users.update', 'uses' => 'UserController@update']);
    Route::post('users/delete', ['as' => 'users.delete', 'uses' => 'UserController@destroy']);
*/
    Route::post('users/{id}/password-change', ['as' => 'users.password-change', 'uses' => 'UserController@passwordChange']);
/*
    Route::post('file', ['as' => 'upload.file', 'uses' => 'UploadController@file']);
    Route::post('image', ['as' => 'upload.image', 'uses' => 'UploadController@image']);

    Route::get('events/program', ['as' => 'events.program', 'uses' => 'EventController@program']);
    Route::get('events/favorited-events', ['as' => 'events.favorited-events', 'uses' => 'EventController@favoritedEvents']);
    Route::post('subscribe', ['as' => 'subscribe', 'uses' => 'SubscribeController@store']);
    Route::post('subscribe/delete', ['as' => 'subscribe.delete', 'uses' => 'SubscribeController@delete']);

    Route::post('settings/update', ['as' => 'settings.update', 'uses' => 'SettingsController@update']);
*/
});

//Admin Routes
Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['language', 'auth', 'role:admin']
], function() use ($a_items) {
    Route::get('', ['as' => 'home', 'uses' => 'DashboardController@index']);

	foreach ($a_items AS $s_table => $s_model)
	{
	    Route::get($s_table, ['as' => $s_table, 'uses' => $s_model . 'Controller@index']);
	    Route::get($s_table . '/form/{id?}', ['as' => $s_table . '.form', 'uses' => $s_model . 'Controller@form']);
	}





/*
    // Static Texts administration routes
    Route::get('texts', ['as' => 'texts', 'uses' => 'TextController@index']);
    Route::get('texts/form/{id?}', ['as' => 'texts.form', 'uses' => 'TextController@form']);

    // Settings administration routes
    Route::get('settings', ['as' => 'settings', 'uses' => 'SettingController@index']);
    Route::get('settings/form/{id?}', ['as' => 'settings.form', 'uses' => 'SettingController@form']);

    // Users administration routes
    Route::get('artists', ['as' => 'artists', 'uses' => 'ArtistController@index']);
    Route::get('artists/form/{id?}', ['as' => 'artists.form', 'uses' => 'ArtistController@form']);

    // Vocations administration routes
    Route::get('vocations', ['as' => 'vocations', 'uses' => 'VocationController@index']);
    Route::get('vocations/form/{id?}', ['as' => 'vocations.form', 'uses' => 'VocationController@form']);

    // Vocations administration routes
    Route::get('professions', ['as' => 'professions', 'uses' => 'ProfessionController@index']);
    Route::get('professions/form/{id?}', ['as' => 'professions.form', 'uses' => 'ProfessionController@form']);

    // Designs administration routes
    Route::get('books', ['as' => 'books', 'uses' => 'BookController@index']);
    Route::get('books/form/{id?}', ['as' => 'books.form', 'uses' => 'BookController@form']);

    // pages administration routes
    Route::get('pages', ['as' => 'pages', 'uses' => 'PageController@index']);
    Route::get('pages/form/{id?}', ['as' => 'pages.form', 'uses' => 'PageController@form']);

    // Events administration routes
    Route::get('events', ['as' => 'events', 'uses' => 'EventController@index']);
    Route::get('events/form/{id?}', ['as' => 'events.form', 'uses' => 'EventController@form']);
    Route::get('events/duplicate/{id?}', ['as' => 'events.duplicate', 'uses' => 'EventController@duplicate']);

    Route::get('galleries', ['as' => 'galleries', 'uses' => 'GalleryController@index']);
    Route::get('galleries/form/{id?}', ['as' => 'galleries.form', 'uses' => 'GalleryController@form']);

    Route::get('news', ['as' => 'news', 'uses' => 'NewsController@index']);
    Route::get('news/form/{id?}', ['as' => 'news.form', 'uses' => 'NewsController@form']);

    // Categories administration routes
    Route::get('categories', ['as' => 'categories', 'uses' => 'CategoryController@index']);
    Route::get('categories/form/{id?}', [
        'as' => 'categories.form',
        'uses' => 'CategoryController@form'
    ]);

    // Partners administration routes
    Route::get('partners', ['as' => 'partners', 'uses' => 'PartnerController@index']);
    Route::get('partners/form/{id?}', ['as' => 'partners.form', 'uses' => 'PartnerController@form']);

    // Places administration routes
    Route::get('places', ['as' => 'places', 'uses' => 'PlaceController@index']);
    Route::get('places/form/{id?}', ['as' => 'places.form', 'uses' => 'PlaceController@form']);

    // Users administration routes
    Route::get('users', ['as' => 'users', 'uses' => 'UserController@index']);
    Route::get('users/form/{id?}', ['as' => 'users.form', 'uses' => 'UserController@form']);

    // Festivals administration routes
    Route::get('festivals', ['as' => 'festivals', 'uses' => 'FestivalController@index']);
    Route::get('festivals/form/{id?}', ['as' => 'festivals.form', 'uses' => 'FestivalController@form']);

    Route::get('cities', ['as' => 'cities', 'uses' => 'CityController@index']);
    Route::get('cities/form/{id?}', ['as' => 'cities.form', 'uses' => 'CityController@form']);

    Route::get('sliders', ['as' => 'sliders', 'uses' => 'SliderController@index']);
    Route::get('sliders/form/{id?}', ['as' => 'sliders.form', 'uses' => 'SliderController@form']);

    Route::get('media', ['as' => 'media', 'uses' => 'MediaController@index']);
    Route::get('media/form/{id?}', ['as' => 'media.form', 'uses' => 'MediaController@form']);

    Route::get('press', ['as' => 'presses', 'uses' => 'PressController@index']);
    Route::get('press/form/{id?}', ['as' => 'presses.form', 'uses' => 'PressController@form']);

    Route::get('settings', ['as' => 'settings', 'uses' => 'SettingsController@index']);
*/
});


//Public routes
Route::group([
    'as' => 'public.',
    'namespace' => 'Frontend',
    'middleware' => ['language']
], function() {
/*
#    Route::get('', ['as' => 'home', 'uses' => 'GeneralController@index']);
    Route::get('{festival_slug}/search', ['as' => 'search', 'uses' => 'SearchController@index']);
    Route::post('contact-us', ['as' => 'contact-us', 'uses' => 'GeneralController@contactUs']);
*/
    Route::group(['middleware' => 'auth'], function() {
        Route::get('miy-pr', ['as' => 'cabinet', 'uses' => 'ProfileController@cabinet']);
        Route::post('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@updateProfile']);
/*
        Route::post('event/{event}/favorite', ['as' => 'event.favorite', 'uses' => 'ProgramController@favorite']);
        Route::post('event/{event}/unfavorite', ['as' => 'event.unfavorite', 'uses' => 'ProgramController@unfavorite']);
*/
    });
/*
#    Route::get('book/{book}', ['as' => 'books', 'uses' => 'BookController@index']);
    Route::get('about-us', ['as' => 'page.about-us', 'uses' => 'PageController@aboutUs']);
#    Route::get('about-website', ['as' => 'page.about-website', 'uses' => 'PageController@aboutWebsite']);

    Route::get('news/{category_slug?}', ['as' => 'news', 'uses' => 'PostController@news']);
    Route::get('post/{slug}', ['as' => 'post', 'uses' => 'PostController@post']);

    Route::get('program/{category_slug?}', ['as' => 'program', 'uses' => 'ProgramController@program']);
#    Route::get('event/{slug}', ['as' => 'event', 'uses' => 'ProgramController@event']);


#    Route::get('artist/{artist_slug}', ['as' => 'artist', 'uses' => 'ArtistController@index']);
    Route::get('book/{book_slug}', ['as' => 'book', 'uses' => 'BookController@index']);
    Route::get('event/{event_slug}', ['as' => 'event', 'uses' => 'EventController@index']);
    Route::get('gallery/{gallery_slug}', ['as' => 'gallery', 'uses' => 'GalleryController@index']);
    Route::get('media/{media_slug}', ['as' => 'media', 'uses' => 'MediaController@index']);
    Route::get('partner/{partner_slug}', ['as' => 'partner', 'uses' => 'PartnerController@index']);
    Route::get('place/{place_slug}', ['as' => 'place', 'uses' => 'PlaceController@index']);
    Route::get('press/{press_slug}', ['as' => 'press', 'uses' => 'PressController@index']);

    Route::get('{festival_slug}/artist/{artist_slug}', ['as' => 'festival.artist', 'uses' => 'FestivalController@artists']);
#    Route::get('{festival_slug}/book/{book_slug}', ['as' => 'festival.book', 'uses' => 'FestivalController@books']);
    Route::get('{festival_slug}/event/{event_slug}', ['as' => 'festival.event', 'uses' => 'FestivalController@events']);
    Route::get('{festival_slug}/gallery/{gallery_slug}', ['as' => 'festival.gallery', 'uses' => 'FestivalController@galleries']);
    Route::get('{festival_slug}/media/{media_slug}', ['as' => 'festival.media', 'uses' => 'FestivalController@medias']);
    Route::get('{festival_slug}/place/{place_slug}', ['as' => 'festival.place', 'uses' => 'FestivalController@places']);
    Route::get('{festival_slug}/press/{press_slug}', ['as' => 'festival.press', 'uses' => 'FestivalController@presses']);

#    Route::get('press', ['as' => 'presses', 'uses' => 'PressController@index']);
    Route::get('press/gallery/{gallery_slug}', ['as' => 'presses.gallery', 'uses' => 'PressController@gallery']);

    //Archived festivals
    Route::get('archive/{festival_slug}', ['as' => 'archive', 'uses' => 'ArchiveController@index']);
    Route::get('archive/{festival_slug}/book/{book}', ['as' => 'archive.book', 'uses' => 'ArchiveController@book']);

    Route::get('archive/{festival_slug}/news/{category_slug?}', [
        'as' => 'archive.news',
        'uses' => 'ArchiveController@news'
    ]);

    Route::get('archive/{festival_slug}/partners', [
        'as' => 'archive.partners',
        'uses' => 'ArchiveController@partners'
    ]);

    Route::get('archive/{festival_slug}/post/{slug}',
        ['as' => 'archive.post', 'uses' => 'ArchiveController@post']
    );

    Route::get('archive/{festival_slug}/program/{category_slug?}', [
        'as' => 'archive.program',
        'uses' => 'ArchiveController@program'
    ]);

    Route::get('archive/{festival_slug}/event/{event_slug}', [
        'as' => 'archive.event',
        'uses' => 'ArchiveController@event'
    ]);

    Route::get('archive/{festival_slug}/about-us', [
        'as' => 'archive.page.about-us',
        'uses' => 'ArchiveController@aboutUs'
    ]);

    Route::get('archive/{festival_slug}/press', [
        'as' => 'archive.presses',
        'uses' => 'ArchiveController@presses'
    ]);


    Route::get('archive/{festival_slug}/press/gallery/{gallery_slug}', [
        'as' => 'archive.presses.gallery',
        'uses' => 'ArchiveController@gallery'
    ]);



    Route::get('info/{page_slug}', [
        'as' => 'page',
        'uses' => 'PageController@showStaticPage']
    );
*/
    //Eugene Buchinsky
    Route::get('', [
        'as' => 'home',
        'uses' => 'FestivalController@index']
    );

/*
    Route::get('{festival_slug}', [
        'as' => 'festival.index',
        'uses' => 'FestivalController@index'
    ]);

    Route::get('{festival_slug}/program', [
        'as' => 'festival.program',
        'uses' => 'FestivalController@program'
    ]);

    Route::get('{festival_slug}/program/{event_slug}', [
        'as' => 'festival.event',
        'uses' => 'FestivalController@event'
    ]);

    Route::get('{festival_slug}/news', [
        'as' => 'festival.posts',
        'uses' => 'FestivalController@news'
    ]);

    Route::get('{festival_slug}/news/{post_slug}', [
        'as' => 'festival.post',
        'uses' => 'FestivalController@post'
    ]);

    Route::get('{festival_slug}/books', [
        'as' => 'festival.books',
        'uses' => 'FestivalController@books'
    ]);

    Route::get('{festival_slug}/books/{book_slug}', [
        'as' => 'festival.book',
        'uses' => 'FestivalController@books'
    ]);

    Route::get('{festival_slug}/partners/{partner_slug}', [
        'as' => 'festival.partner',
        'uses' => 'FestivalController@partners'
    ]);
    Route::get('{festival_slug}/partners', [
        'as' => 'festival.partners',
        'uses' => 'FestivalController@partners'
    ]);

    Route::get('{festival_slug}/about', [
        'as' => 'festival.about',
        'uses' => 'FestivalController@about'
    ]);

    Route::get('{festival_slug}/press', [
        'as' => 'festival.presses',
        'uses' => 'FestivalController@press'
    ]);

    Route::get('{festival_slug}/gallery/{gallery_slug}', [
        'as' => 'festival.gallery',
        'uses' => 'FestivalController@gallery'
    ]);

    Route::get('cabinet/favorite-events', [
        'as' => 'cabinet.favorite-events',
        'uses' => 'ProfileController@favoriteEvents'
    ]);
/ *
	Route::get('image/{image_id}/{show_marker}', [
		'as' => 'image.download',
		'uses' => 'GeneralController@downloadImage'
	]);
* /
	Route::get('image/{image_id}/{show_marker?}/{image_size?}', [
		'as' => 'image.show',
		'uses' => 'GeneralController@showImage'
	]);
*/
});

//Route::get('admin/clean', function(){
//
//    $empty_files = File::whereNull('filable_id')->get();
//
//    foreach($empty_files as $file){
//        Storage::delete($file->path);
//
//        if($file->medium_image_path){
//            Storage::delete($file->medium_image_path);
//        }
//
//        if($file->small_image_path){
//            Storage::delete($file->small_image_path);
//        }
//
//        $file->delete();
//    }
//
//    $db_files = File::all()->pluck('path')->toArray();
//
//    $storage_files = array_merge(Storage::allFiles('/public/2018'), Storage::allFiles('/public/2019'));
//
//    echo 'Db files - ' . count($db_files) . '<br/>';
//
//    echo 'Storage files - ' . count($storage_files);
//
//    foreach($storage_files as $file){
//        if( ! in_array(str_replace(['-medium', '-small'], '', $file), $db_files)){
//            Storage::delete($file);
//        }
//    }
//
//});

//Route::get('admin/space', function(){
//    $db_files = File::all();
//
//    $db_files_total = 0;
//
//    $empty = 0;
//
//    foreach($db_files as $file){
//
//        $db_files_total += 1;
//
//        if($file->medium_image_path){
//            $db_files_total += 1;
//        }
//
//        if($file->small_image_path){
//            $db_files_total += 1;
//        }
//
//        if( ! Storage::exists($file->path)){
//            echo $file->filable . '<br />';
//            echo $file->path . '<br / >';
//        }
//    }
//
//    $storage_files = array_merge(Storage::allFiles('/public/2018'), Storage::allFiles('/public/2019'));
//
//    dd('Db files total - ' . $db_files_total, 'Storage files total - ' . count($storage_files));
//
//});

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


