<?php namespace credits\Entities;


class Accept_credit extends \Eloquent
{
    protected $table= 'accept_credit';
    protected $fillable = array('data_monthly','value_monthly','data_credit','reference1','reference2','files','fenalco','credit_id');

    public function user()
    {

        return $this->hasOne('credits\Entities\User');
    }
}
