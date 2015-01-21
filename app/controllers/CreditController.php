<?php

use credits\Managers\CreditManager;
use credits\Managers\UserManager;
use credits\Entities\CreditRequest;
use credits\Entities\User;

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
        $valid = !$creditManager->isValid();
        $validFile = !$creditManager->isValidFile();
        if ($valid  && $validFile)
            return Redirect::to('credito')->withErrors($creditManager->getErrors())->withInput();

        $creditManager->saveCredit();
        return Redirect::to('credito')->with(array('mensaje' => 'El usuario ha sido creado correctamente.'));


    }


}