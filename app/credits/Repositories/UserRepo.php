<?php

namespace credits\Repositories;


use credits\Entities\User;

class UserRepo extends BaseRepo
{

    protected function getModel()
    {
        return new User();
    }

    public function passwordRestart($email)
    {
        $user = $this->model;
        $user = $user::where('email', '=', $email)->first();
        if (!$user)
            return $data = ['link' => "restorePassword/"]
                + ['return' => false]
                + ['username' => ''];

        $restore_password = str_random(30);
        $user->restore_password = $restore_password;
        $user->save();
        return $data = ['link' => 'restaurar/' . $restore_password]
            + ['return' => true]
            + ['username' => $user->user_name];
    }

    public function validatorUser($restore_password)
    {
        $user = $this->model;
        $user = $user::where('restore_password', '=', $restore_password)->first();
        return $user;
    }

    public function searchUsers()
    {
        $search = \Input::get('search');

        //$users = $this->model->where('name', 'like', '%' . $search . '%')->paginate(15);
        $users = $this->model->where(function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('email', '=', '%' . $search . '%')
                ->orWhere('second_name', 'like', '%' . $search . '%')
                ->orWhere('second_last_name', 'like', '%' . $search . '%')
                ->orWhere('identification_card', 'like', '%' . $search . '%');
        })->paginate(10);

        return $users;

    }
}