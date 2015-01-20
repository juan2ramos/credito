<?php namespace credits\Entities;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class CreditRequest extends \Eloquent
{

    public function user(){
        return $this->hasOne('credits\entities\user');
    }

    protected $table = 'creditRequest';
    protected $fillable = array('date_expedition','instead_expedition','office_address','monthly_income','monthly_expenses','name_reference','phone_reference','name_reference2','phone_reference2');



}
