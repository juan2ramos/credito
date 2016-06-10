<?php namespace credits\Entities;

class Log extends \Eloquent
{
    protected $fillable = ['responsible','action','affected_entity','method'];
}
