<?php

Route::get('/', function() {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/dashboard', 'DashboardController@index');

Route::get('/profile', 'UserController@index');
Route::get('/profile/{user}', 'UserController@show');
Route::get('/profile/{user}/edit', 'UserController@edit');
Route::put('/profile/update', 'UserController@update');
Route::delete('/profile/{user}', 'UserController@destroy');
Route::post('/picture', 'UserController@store');

Route::group(['prefix' => 'game'], function() {
    Route::post('{id}/captured', 'GameController@capture');
    Route::post('{id}/decline', 'GameController@decline');
    Route::post('{id}/join', 'GameController@join');
    Route::post('{id}/leave', 'GameController@leave');
	Route::post('{id}/start', 'GameController@start');
	Route::get('{id}/target', 'GameController@target');
});
Route::resource('game', 'GameController');

Route::resource('invitation', 'InvitationController', ['except' => ['update']]);
Route::get('invitation/update/{token}', 'InvitationController@update');

Route::get('login/{provider}', 'AuthController@redirectToProvider');
Route::get('login/{provider}/callback', 'AuthController@handleProviderCallback');


