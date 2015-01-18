<?php namespace credits\Entities;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class CreditRequest extends \Eloquent
{

    protected $table = 'creditRequest';


}