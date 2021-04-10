<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Search
//Route::get('/', 'App\Http\Controllers\SearchController@index');
Route::get('/', ['uses' => 'SearchController@index']);
//Route::get('search', 'App\Http\Controllers\SearchController@search');
Route::get('search', ['uses' => 'SearchController@search']);
Route::get('search/{listing}', ['middleware' => 'auth','uses' => 'SearchController@show']);
Route::get('login', ['middleware' => 'auth','uses' => 'Auth\LoginController@login']);

// Profiles
//Route::get('profile', [ProfileController::class, 'index']);
Route::get('profile', 'ProfileController@index')->name('profile.index');
/*Route::get('profile', [App\Http\Controllers\ProfileController::class, 'index']);
Route::get('profile/update', [App\Http\Controllers\ProfileController::class, 'update']);
Route::post('profile/store', [App\Http\Controllers\ProfileController::class, 'store']);
Route::get('profile/create', [App\Http\Controllers\ProfileController::class,'create']);*/
//Route::get('profile', ['middleware' => 'auth','uses' => 'ProfileController@index']);
Route::get('profile/update', ['middleware' => 'auth','uses' =>'ProfileController@update']);
Route::post('profile/store', ['middleware' => 'auth','uses' =>'ProfileController@store']);
Route::get('profile/create', ['middleware' => 'auth','uses' =>'ProfileController@create']);

Route::get('/logout', function(){
   Auth::logout();
   return Redirect::to('/');
});

//google login
Route::get('auth/login', 'Auth\AuthController@getSocialLogin');
Route::get('auth/callback/{provider}', 'Auth\AuthController@handleSocialResponse');

//Listing
Route::get('listing', 'ListingController@index');
Route::get('listing/update', ['middleware' => 'auth','uses' =>'ListingController@update']);
Route::post('listing/store', ['middleware' => 'auth','uses' =>'ListingController@store']);
Route::get('listing/create', ['middleware' => 'auth','uses' =>'ListingController@create']);
Route::get('listing/verify-location', ['middleware' => 'auth','uses' =>'ListingController@verifyLocation']);
Route::post('listing/verify-location', ['middleware' => 'auth','uses' =>'ListingController@postVerifyLocation']);


//Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getSocialLogin']);
//Route::get('auth/social-login', ['uses' => 'Auth\AuthController@getSocialLogin']);

//Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);
//Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);
// Listings
/*Route::get('listing', 'ListingController@index');

// Authentication
// For resource route.
/*Route::resource('products', PostController::class);
// if you want call any single method of controller
Route::get('products', [PostController::class, 'index'])->name('products.index');*/

/*Route::get('auth/social-login', 'Auth\AuthController@getSocialLogin');
Route::get('handle-authentication-response', 'Auth\AuthController@handleSocialResponse');
Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
Route::get('auth/extend-session', ['as' => 'extend-session', 'uses' => 'Auth\AuthController@extendSession']);

// Registration routes...
Route::get('auth/register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::controllers([
    'password' => 'Auth\PasswordController',
]);*/

require __DIR__.'/auth.php';
