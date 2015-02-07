<?php

namespace credits\Repositories;


use credits\Entities\User;

class UserRepo extends BaseRepo{

    protected function getModel()
    {
        return new User();
    }
    public function passwordRestart($email){
        $user = $this->model;
        $user = $user::where('email', '=', $email)->first();
        if( ! $user)
            return $data=['link'=>"restorePassword/"]
                +['return'=>false]
                +['username'=>''];

        $restore_password = str_random(30);
        $user->restore_password = $restore_password;
        $user->save();
        return $data=['link'=> 'restaurar/'.$restore_password ]
            +['return'=>true]
            +['username'=>$user->user_name];
    }

    public function validatorUser($restore_password)
    {
        $user = $this->model;
        $user = $user::where('restore_password', '=', $restore_password)->first();
        return $user;
    }

}