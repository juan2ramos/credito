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
        if( ! $user::where('email', '=', $email)->first())
            return false;

        $password = str_random(30);
        $data = ['password' => $password];
        $user->fill(['password' => $password]);
        $user->save();
        /*
         * Send Mail uncomment in debug
        \Mail::send('emails.password', $data, function ($message) {
            $message->subject('Restart password');
            $message->to(\Input::get('email'));
        });*/
        return true;


    }
}