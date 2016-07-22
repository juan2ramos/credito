<?php
use credits\Repositories\UserRepo;
use credits\Repositories\LogRepo;
use credits\Managers\NewUserManager;
use credits\Entities\User;

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
        $validator = $userRepo->passwordRestart(Input::get('email'));
        $data = ['link' => $validator['link']];
        if($validator['return'])
        {
            Mail::send('emails.password', $data, function ($message) {
                $message->to(Input::get('email'), 'creditos lilipink')->subject('correo de restauracion de su password');
            });
        }
        new LogRepo(
            [
                'responsible'=> $validator['username'],
                'action' => 'ha solicitado restaurar la contraseña',
                'affected_entity' => '',
                'method' => 'password'
            ]
        );

        return Response::json(['success' => $validator['return']]);
    }

    public function restorePassword($restore_password)
    {
        $userRepo = new UserRepo();
        $validator = $userRepo->validatorUser($restore_password);
        if($validator)
        {
            $user=['id'=>$restore_password];
            return View::make('front.restorePassword',compact('user'));
        }
        return Redirect::route('home');
    }

    public function changePassword($restore_password)
    {
        $data =  Input::all();
        $user = User::where('restore_password', $restore_password)->first();

        if($data["confirmar_password"] ==  $data["password"]){
            $user->password = $data["password"];
            $user->save();
        }
        else{
            return Redirect::to('restaurar/'.$restore_password)->withErrors(['password' => 'La confirmación de la contraseña no coincide'])->withInput();
        }

        new LogRepo(
            [
                'responsible'=> $user->name,
                'action' => 'restauro la contraseña',
                'affected_entity' => '',
                'method' => 'savePassword'
            ]
        );

        return Redirect::route('home')->with(array('mensaje' => 'La contaseña ha sido cambiada.'));
    }

}