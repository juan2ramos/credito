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
    protected $fillable = ['roles_id','name','email','password','last_name','second_name','second_last_name','user_name','address','residency_city','birth_city','mobile_phone','phone','document_type','identification_card','date_birth','photo','location','card','fingerprint', 'user_state', 'referred_document', 'referred_name', 'isWorking', 'whereIsWorking', 'page_id'];

    protected $perPage = 2;
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function setPasswordAttribute($value)
    {
        if (!empty ($value)) {
            $this->attributes['password'] = \Hash::make($value);
        }
    }

    public function CreditRequest()
    {
        return $this->hasOne(CreditRequest::class);
    }

    public function location(){
        return $this->hasOne(Location::class);
    }

    public function extracts(){
        return Extract::where('extracts.nit', $this->identification_card)->get();
    }

}
