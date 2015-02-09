<?php
Route::group(['before' => 'auth'], function () {
	Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
	Route::group(['prefix' => 'admin'], function()
	{
		require (__DIR__ . '/routes/admin.php');
	});
});
Route::group(['before' => 'guest'], function () {
	Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);
	Route::get('sign-up', ['as' => 'sign-up', 'uses' => 'UserController@signUp']);

});
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::post('passwordRestart', ['as' => 'passwordRestart', 'uses' => 'AuthController@password']);


//solicitud de credito
Route::get('credito', ['as' => 'credit', 'uses' => 'CreditController@index']);
Route::post('credito', ['as' => 'credit', 'uses' => 'CreditController@updateCredit']);
Route::post('submit', ['as' => 'submit', 'uses' => 'CreditController@saveImage']);

//slider

Route::get('slider', ['as' => 'slider', 'uses' => 'SliderController@showSlider']);
Route::post('slider', ['as' => 'slider', 'uses' => 'SliderController@saveSlider']);
Route::post('administrar', ['as' => 'administratorSlider', 'uses' => 'SliderController@uploadSlider']);


Route::get('administratorSlider/{id}','SliderController@deleteSlider');
Route::post('administratorSlider/{id}','SliderController@deleteSlider');

//restaurar contraseña

Route::get('restaurar/{id}',['restore','uses'=>'AuthController@restorePassword']);
Route::post('restaurar/{id}',['restore','uses'=>'AuthController@changePassword']);

//mostrar solicitudes de credito

Route::get('solicitud',['request','uses'=>'CreditController@showRequest ']);