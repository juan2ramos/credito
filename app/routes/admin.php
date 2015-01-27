<?php

Route::get('/', function () { return Redirect::route('home');});
Route::get('usuarios', ['before' => 'permissions:users', 'as' => 'users','uses' => 'UserController@showAll' ]);
Route::get('roles', ['before' => 'permissions:roles', 'as' => 'roles','uses' => 'RolesController@showAll' ]);
Route::get('rol/{id}', ['before' => 'permissions:roles', 'as' => 'rol','uses' => 'RolesController@show' ]);