<?php namespace credits\Entities;


class Location extends \Eloquent
{
    protected $fillable = ['id','name'];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
