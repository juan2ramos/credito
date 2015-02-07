<?php namespace credits\Components\ACL;


class Permission extends \Eloquent{

    protected $fillable = array('name');
    public function permissionRole()
    {
        return $this->hasMany('juan2ramos\Entities\PermissionsRole')->withTimestamps();
    }
    public function roles()
    {
        return $this->belongsTo('juan2ramos\Entities\Role')->withTimestamps();
    }
}

