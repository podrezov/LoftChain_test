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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'social', 'as' => 'social.'], function () {
    Route::get('redirect/google', 'SocialAuthController@redirect')->name('redirect');
    Route::get('callback/google', 'SocialAuthController@callback')->name('callback');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => 'auth'], function () {
   Route::get('/', 'ProfileController@index')->name('index');
   Route::post('password/{user}/update', 'ProfileController@passwordUpdate')->name('password.update');
   Route::post('image/{user}/upload', 'ProfileController@imageUpload')->name('image.upload');
});

