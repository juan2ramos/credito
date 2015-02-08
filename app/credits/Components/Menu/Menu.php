<?php namespace credits\Components\Menu;

class Menu extends \Eloquent{
    protected $fillable = array('nameMenu','nameLink','route','permission','parent','orderMenu');
}