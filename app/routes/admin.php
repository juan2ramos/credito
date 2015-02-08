<?php

Route::get('/', function () { return Redirect::route('home');});
Route::get('usuarios', ['before' => 'permissions:users', 'as' => 'users','uses' => 'UserController@showAll' ]);
Route::post('usuarios', ['before' => 'permissions:users', 'as' => 'searchUsers','uses' => 'UserController@searchUsers' ]);
Route::get('roles', ['before' => 'permissions:roles', 'as' => 'roles','uses' => 'RolesController@showAll' ]);
Route::get('rol/{id}', ['before' => 'permissions:roles', 'as' => 'rol','uses' => 'RolesController@show' ]);
Route::get('eliminar-rol/{id}', ['before' => 'permissions:roles', 'as' => 'deleteRol','uses' => 'RolesController@deleteRol' ]);
Route::post('rol/{id}', ['before' => 'permissions:roles', 'as' => 'updateRol','uses' => 'RolesController@updateRol' ]);
Route::post('roles', ['before' => 'permissions:roles', 'as' => 'newRol','uses' => 'RolesController@newRol' ]);