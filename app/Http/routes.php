<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Search
Route::get('/', 'SearchController@index');
Route::get('search', 'SearchController@search');

// Move to CounsellorController or somewhere more appropriate
Route::get('search/{listing}', 'SearchController@show');

// Listings
Route::get('listing', 'ListingController@index');
Route::get('listing/update', 'ListingController@update');
Route::post('listing/store', 'ListingController@store');
Route::get('listing/create', 'ListingController@create');
Route::get('listing/verify-location', 'ListingController@verifyLocation');
Route::post('listing/verify-location', 'ListingController@postVerifyLocation');

// Profiles
Route::get('profile', 'ProfileController@index');
Route::get('profile/update', 'ProfileController@update');
Route::post('profile/store', 'ProfileController@store');
Route::get('profile/create', 'ProfileController@create');

// Authentication
// Route::get('auth/social-login', 'Auth\AuthController@getSocialLogin');
// Route::get('handle-authentication-response', 'Auth\AuthController@handleSocialResponse');
// Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
// Route::post('auth/login', 'Auth\AuthController@postLogin');
// Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
// Route::get('auth/extend-session', ['as' => 'extend-session', 'uses' => 'Auth\AuthController@extendSession']);

// Registration routes...
// Route::get('auth/register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
// Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::controllers([
    'password' => 'Auth\PasswordController',
]);