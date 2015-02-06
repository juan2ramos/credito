<?php namespace credits\Components\ACL;


class Role extends \Eloquent{
    public function permissionsRole()
    {
        return $this->belongsToMany('credits\Components\ACL\Permission')->withTimestamps();
    }
}