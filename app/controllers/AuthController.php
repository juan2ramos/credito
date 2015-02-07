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
        //$success = $userRepo->passwordRestart(Input::get('email'));
        $data=['password'=>'3424234'];
        Mail::send('back.home', $data, function ($message) {
            $message->to('edwarddiaz92@gmail.com', 'drawde')->subject('bien!');
        });
        return Response::json(['success' => $success]);

    }
}