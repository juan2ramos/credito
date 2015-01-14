<?php
Route::group(['before' => 'auth'], function () {
	Route::group(['prefix' => 'admin'], function()
	{
		require (__DIR__ . '/routes/admin.php');
	});
});
Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);
Route::get('sign-up', ['as' => 'sign-up', 'uses' => 'UserController@signUp']);
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

