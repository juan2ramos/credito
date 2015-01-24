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

Route::post('submit',function()
{
	$file = $_FILES;
	$prefijo = sha1(time());
	$archivo = ($file['file']['name']);
	$destino =  "upload/".$prefijo.$archivo;
	if(move_uploaded_file($_FILES['file']['tmp_name'], $destino))
	{
		return Response::json(array($prefijo.$archivo));
	}else{
		return Response::json(array("error"."no envio nada"));
	}
	return Redirect::to('credito')->with(array('mensaje' => 'El usuario ha sido creado correctamente.'));
});


