<?php namespace credits\Components\Menu;

use Illuminate\Support\Facades\Facade;

class Menus extends facade
{
    protected static function getFacadeAccessor()
    {
        return 'Menus';
    }
}