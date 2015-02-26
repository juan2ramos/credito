<?php
use credits\Repositories\UserRepo;
use credits\Repositories\LogRepo;
use credits\Managers\UserManager;
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
        $data=['link'=>$validator['link']];
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
        $dataUser =  Input::all();
        $userManager= new UserManager(new User(),$dataUser);
        $userValidation = $userManager->isValid();

        if ($userValidation) {
            return Redirect::to('restaurar/'.$restore_password)->withErrors($userValidation)->withInput();
        }

        $userName=$userManager->savePassword($restore_password);

        new LogRepo(
            [
                'responsible'=> $userName,
                'action' => 'restauro la contraseña',
                'affected_entity' => '',
                'method' => 'savePassword'
            ]
        );

        return Redirect::route('sign-up')->with(array('mensaje' => 'El usuario ha sido creado correctamente.'));
    }

}