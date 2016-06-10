<?php namespace credits\Entities;


class General_variables extends \Eloquent
{
    protected $table = 'general_variables';
    protected $fillable = ['name','value','porcentage'];
}
