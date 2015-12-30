<?php

Route::get('/', function () { return Redirect::route('home');});
Route::get('usuarios', ['before' => 'permissions:users', 'as' => 'users','uses' => 'UserController@showAll' ]);
Route::get('eliminar-usuario/{id}', ['before' => 'permissions:users', 'as' => 'userDelete','uses' => 'UserController@userDelete' ]);
Route::get('nuevo-usuario', ['before' => 'permissions:users', 'as' => 'userNew','uses' => 'UserController@newUser' ]);
Route::post('nuevo-usuario', ['before' => 'permissions:users', 'as' => 'userNew','uses' => 'UserController@createUser' ]);
Route::post('usuarios', ['before' => 'permissions:users', 'as' => 'searchUsers','uses' => 'UserController@searchUsers' ]);
Route::get('usuariosTarjeta', ['before' => 'permissions:users', 'as' => 'searchUsersCard','uses' => 'UserController@searchUsersCard' ]);
Route::get('usuarios/{id}', ['before' => 'permissions:users', 'as' => 'userShow','uses' => 'UserController@userShow' ]);
Route::get('usersExcel', ['before' => 'permissions:users', 'as' => 'usersExcel','uses' => 'UserController@usersExcel' ]);
Route::get('usersPdf', ['before' => 'permissions:users', 'as' => 'usersPdf','uses' => 'UserController@usersPdf' ]);

Route::get('roles', ['before' => 'permissions:roles', 'as' => 'roles','uses' => 'RolesController@showAll' ]);
Route::get('rol/{id}', ['before' => 'permissions:roles', 'as' => 'rol','uses' => 'RolesController@show' ]);
Route::get('eliminar-rol/{id}', ['before' => 'permissions:roles', 'as' => 'deleteRol','uses' => 'RolesController@deleteRol' ]);
Route::post('rol/{id}', ['before' => 'permissions:roles', 'as' => 'updateRol','uses' => 'RolesController@updateRol' ]);
Route::post('roles', ['before' => 'permissions:roles', 'as' => 'newRol','uses' => 'RolesController@newRol' ]);

Route::post('uploadUser/{id}','UserController@updateUser');
Route::post('updateValueCredit/{id}','CreditController@updateValueCredit');

Route::get('administradores', ['before' => 'permissions:users', 'as' => 'usersAdmin','uses' => 'UserController@showAllAdmin' ]);