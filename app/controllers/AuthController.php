<?php
use credits\Repositories\UserRepo;

class AuthController extends BaseController
{

    public function login()
    {

        $data = Input::only('email', 'password', 'remember');
        $credentials = ['email' => $data['email'], 'password' => $data['password']];

        if (Auth::attempt($credentials, $data['remember'])) {
            return Redirect::back();
        }

        return Redirect::back()->with('login_error', 1);
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::route('home');
    }

    public function password()
    {
        $userRepo = new UserRepo();
        $success = $userRepo->passwordRestart(Input::get('email'));
        return Response::json(['success' => $success]);

    }
}