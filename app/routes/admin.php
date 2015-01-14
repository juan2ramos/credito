<?php

Route::get('/', function () {});


Route::get('permisos', ['before' => 'permissions:getPermission', 'as' => 'permissions',
    function () {
        ddj(ACL::getPermissions(3));
    }]);