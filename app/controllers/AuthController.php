<?php
class AuthController extends BaseController {

    public function login(){

        $data = Input::only('email','password','remember');
        $credentials = ['email' => $data['email'], 'password' => $data['password']];

        if(Auth::attempt($credentials,$data['remember'])){
            return Redirect::back();
        }

        return Redirect::back()->with('login_error',1);
    }

    public function logout(){
        Auth::logout();
        return Redirect::route('home');
    }
    public function password()
    {
        dd(str_random(30));
        if ($user = User::where('email', '=', Input::get('email'))->first()) {
            $pass = '';
            $a_z = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+*[]{}";
            for ($i = 0; $i < 20; $i++) {
                $int = rand(0, 51);
                $pass .= $a_z[$int];
            }
            $data = ['pass' => $pass];
            $user->fill(['password' => $pass]);
            $user->save();
            Mail::send('emails.password', $data, function ($message) {
                $message->subject('Restart password');
                $message->to(Input::get('email'));
            });
            return Response::json(['success' => 1]);
        } else {
            return Response::json(['success' => 0]);
        }
    }
}