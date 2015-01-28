<?php

use credits\Managers\CreditManager;
use credits\Managers\UserManager;
use credits\Entities\CreditRequest;
use credits\Entities\User;
use credits\Repositories\ImageRepo;

class CreditController extends BaseController
{
    public function index()
    {

        $type = ["tipo de documento" => "Tipo de documento"] + [0 => "Cedula"] + [1 => "Cedula de extranjeria"];
        return View::make('front.creditRequest', compact('type'));

    }

    public function updateCredit()
    {
        $creditManager = new CreditManager(new CreditRequest(), Input::all());
        $creditValidation = $creditManager->isValid();

        if ($creditValidation)
        {
            return Redirect::to('credito')->withErrors($creditValidation)->withInput();
        }

            $creditManager->saveCredit(Input::get('files'));
            return Redirect::to('credito')->with(array('mensaje' => 'El usuario ha sido creado correctamente.'));

    }

    public function saveImage()
    {
        $saveImages= new ImageRepo();
        $message=$saveImages->saveImages($_FILES);
        return Response::json(array($message));
    }



}