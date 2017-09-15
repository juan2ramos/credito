<?php

Route::group(['before' => 'auth'], function () {
    Route::get('logout', [
        'as' => 'logout',
        'uses' => 'AuthController@logout'
    ]);

    Route::group(['prefix' => 'admin'], function () {
        require(__DIR__ . '/routes/admin.php');
    });
});

Route::group(['before' => 'guest'], function () {

    Route::post('login', [
        'as' => 'login',
        'uses' => 'AuthController@login'
    ]);

    Route::get('sign-up', [
        'as' => 'sign-up',
        'uses' => 'AuthController@register'
    ]);
});

/************ Routes Front *************/

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

Route::get('preguntas-frecuentes', [
    'uses' => 'HomeController@faq',
    'as' => 'faq'
]);

Route::post('contact', [
    'uses' => 'HomeController@contact',
    'as' => 'contact'
]);

Route::post('passwordRestart', [
    'as' => 'passwordRestart',
    'uses' => 'AuthController@password']);

//solicitud de credito

Route::get('credito', [
    'as' => 'credit',
    'uses' => 'CreditController@index'
]);

Route::post('credito', [
    'as' => 'credit',
    'uses' => 'CreditController@updateCredit'
]);

Route::post('submit', [
    'as' => 'submit',
    'uses' => 'CreditController@saveImage'
]);

//restaurar contraseña

Route::get('restaurar/{id}', [
    'as' => 'restore',
    'uses' => 'AuthController@restorePassword'
]);

Route::post('restaurar/{id}', [
    'as' => 'restore',
    'uses' => 'AuthController@changePassword'
]);

Route::get('info', function () {
    Event::listen('generic.event', function ($client_data) {
        print_r($client_data);
        return BrainSocket::message('generic.event', array('user_id' => 100, 'message' => 'A message from a generic event fired in Laravel!'));
    });
});

Route::get('drawde', function () {
    return View::make('emails.accept');
});

Route::get('refresh/{pass}', function () {
    Mail::send('emails.test', ['message' => 'jajajaja'], function ($message) {
        $message->to('juan2ramos@gmail.com', 'creditos lilipink')->subject('prueba');
    });
});
Route::get('emprendedoras/', ['as' => 'enterprising', 'uses' => 'EnterprisingController@index']);
Route::get('se_emprendedora/', ['as' => 'isEnterprising', 'uses' => 'EnterprisingController@isEnterprising']);
Route::get('donde_comprar/', ['as' => 'buy', 'uses' => 'EnterprisingController@buy']);
Route::get('como_pagar/', ['as' => 'pay', 'uses' => 'EnterprisingController@pay']);
Route::get('magazine/', ['as' => 'magazine', 'uses' => 'EnterprisingController@magazine']);
Route::get('formulario-emprendedoras', ['as' => 'enterprisingRegister', 'uses' => 'EnterprisingController@getRegister']);
Route::post('formulario-emprendedoras', ['as' => 'enterprisingRegister', 'uses' => 'EnterprisingController@postRegister']);
//Route::post('formulario-emprendedoras/credit', ['as' => 'enterprisingCredit', 'uses' => 'EnterprisingController@creditRegister']);
Route::get('referidos/', ['as' => 'referred', 'uses' => 'EnterprisingController@referred']);
Route::get('mailing',function (){

    \Illuminate\Support\Facades\Mail::send('emails.sendMailing', ['email' => 'email'], function ($message)  {
        $message->from('no-reply@creditoslilipink.com', 'Créditos Lilipink');

        $message->to('david@lilipink.com', 'Créditos Lilipink')->subject('💸¿Quieres ganar $30,000 por recomendar nuestro crédito?💸 Dale clic aquí👈');
    });
});