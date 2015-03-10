<?php
Route::group(['before' => 'auth'], function () {
	Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
	Route::group(['prefix' => 'admin'], function()
	{
		require (__DIR__ . '/routes/admin.php');
	});
	//mostrar solicitudes de credito

	Route::get('solicitud',['as' => 'request','uses'=>'CreditController@showRequest']);
	Route::get('showCreditRequest/{id}','CreditController@showCreditRequest');
	Route::post('showCreditRequest/{id}','CreditController@acceptCredit');


	//Variables generales

	Route::get('variables',['as' => 'variables','uses'=>'CreditController@showVariables']);
	Route::post('variables/{id}',['as' => 'variables/{id}','uses'=>'CreditController@saveVariables']);

	//regiones

	Route::get('Regiones',['as' => 'location','uses'=>'CreditController@showLocations']);
	Route::post('Regiones',['as' => 'location','uses'=>'CreditController@addLocations']);

	Route::get('deleteLocation/{id}','CreditController@deleteLocation');
	Route::post('deleteLocation/{id}','CreditController@deleteLocation');

	//actualizar usuario

	Route::post('Actualizar/{id}', ['as' => 'update', 'uses' => 'UserController@updateClient' ]);
	Route::get('Actualizar/{id}', ['as' => 'update', 'uses' => 'UserController@userShow' ]);

	//slider

	Route::get('slider', ['as' => 'slider', 'uses' => 'SliderController@showSlider']);
	Route::post('slider', ['as' => 'slider', 'uses' => 'SliderController@saveSlider']);
	Route::post('administrar', ['as' => 'administratorSlider', 'uses' => 'SliderController@uploadSlider']);


	Route::get('administratorSlider/{id}','SliderController@deleteSlider');
	Route::post('administratorSlider/{id}','SliderController@deleteSlider');

	Route::get('showCreditRequest/reprobate/{id}','CreditController@reprobateCredit');
	//Route::post('showCreditRequest/reprobate//{id}','CreditController@reprobateCredit');


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

//Subida excel
Route::get('subidaExcel', ['as' => 'excel', 'uses' => 'UserController@showExcel']);
Route::post('subidaExcel', ['as' => 'excel', 'uses' => 'UserController@uploadExcel']);


//restaurar contraseña

Route::get('restaurar/{id}', ['as' => 'restore', 'uses' => 'AuthController@restorePassword']);
Route::post('restaurar/{id}', ['as' => 'restore', 'uses' => 'AuthController@changePassword']);
Route::get('info', function () {
    Event::listen('generic.event',function($client_data){
        print_r($client_data);
        return BrainSocket::message('generic.event',array('user_id'=>100,'message'=>'A message from a generic event fired in Laravel!'));
    });

});

Route::get('drawde', function()
{
	return View::make('emails.accept');
});


Route::get('refresh/{pass}',function(){

    Mail::send('emails.test', ['message' => 'jajajaja'], function ($message) {
        $message->to('juan2ramos@gmail.com', 'creditos lilipink')->subject('prueba');

    });
});
/**
 * php-cli composer.phar update
 */