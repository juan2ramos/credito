<?php namespace credits\Entities;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Eloquent implements UserInterface, RemindableInterface
{


    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $fillable = ['roles_id','name','email','password','last_name','second_name','second_last_name','user_name','address','residency_city','birth_city','mobile_phone','phone','document_type','identification_card','date_birth','photo','location','card'];

    protected $perPage = 2;
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public function setPasswordAttribute($value)
    {
        if (!empty ($value)) {
            $this->attributes['password'] = \Hash::make($value);

        }
    }

    public function CreditRequest()
    {

        return $this->hasOne('credits\Entities\CreditRequest');
    }

}
