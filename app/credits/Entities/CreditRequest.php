<?php

namespace credits\Entities;

class CreditRequest extends \Eloquent
{
    protected $table = 'creditRequest';
    protected $fillable = ['date_expedition','instead_expedition','office_address','monthly_income','monthly_expenses','name_reference','phone_reference','name_reference2','phone_reference2','location','priority','responsible','value','point'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
