<?php namespace credits\Entities;


class Log extends \Eloquent
{


    protected $fillable = array('responsible','action','affected_entity','method');
}
