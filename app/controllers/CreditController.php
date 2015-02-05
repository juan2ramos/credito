<?php

use credits\Managers\CreditManager;
use credits\Managers\UserManager;
use credits\Entities\CreditRequest;
use credits\Entities\User;
use credits\Repositories\ImageRepo;
use credits\Repositories\LogRepo;

class CreditController extends BaseController
{
    public function index()
    {

        $type = ["tipo de documento" => "Tipo de documento"] + [0 => "Cedula"] + [1 => "Cedula de extranjeria"];
        return View::make('front.creditRequest', compact('type'));

    }

    public function updateCredit()
    {
        $user_name = ["user_name" =>
            Input::get('name') . '.' .
            Input::get('second_name') . '.' .
            Input::get('last_name') . '.' .
            Input::get('second_last_name')
        ];

        $dataCredit = $user_name + Input::all();
        $creditManager = new CreditManager(new CreditRequest(), $dataCredit);
        $creditValidation = $creditManager->isValid();

        if ($creditValidation) {
            return Redirect::route('credit')->withErrors($creditValidation)->withInput();
        }
        $creditManager->saveCredit(Input::get('files'));

        $log = new LogRepo(
            [
                'responsible'=> $user_name['user_name'],
                'action' => 'ha solicitado un credito',
                'affected_entity' => '',
                'method' => 'updateCredit'
            ]
        );

        return Redirect::route('credit')->with(array('mensaje' => 'El usuario ha sido creado correctamente.'));

    }


    public function saveImage()
    {
        $saveImages = new ImageRepo();
        $message = $saveImages->saveImages($_FILES,'upload/');
        return Response::json(array($message));
    }

}