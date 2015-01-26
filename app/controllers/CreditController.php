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
        $files = explode(",", Input::get('files'));
        foreach($files as $file)
        {
            $destino =  "upload/".$file;
           if( move_uploaded_file ( $file , $destino  ))
           {

           }else{
               drawde("no entro" .$file);exit;
           }

        }

        $creditManager = new CreditManager(new CreditRequest(), Input::all());
        $creditValidation = $creditManager->isValid();

        $creditManager->saveImages(Input::file('file'));
        if ($creditValidation)
        {
            return Redirect::to('credito')->withErrors($creditValidation)->withInput();
        }

            $creditManager->saveCredit(Input::get('files'));
            return Redirect::to('credito')->with(array('mensaje' => 'El usuario ha sido creado correctamente.'));




    }



}