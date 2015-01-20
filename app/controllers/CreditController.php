<?php

use credits\Managers\CreditManager;
use credits\Managers\UserManager;
use credits\Entities\CreditRequest;
use credits\Entities\User;

class CreditController extends BaseController
{
    public function index()
    {

        $type= [ "tipo de documento" => "Tipo de documento"]+[ 0 => "Cedula"]+[ 1 => "Cedula de extranjeria"];
        return View::make('front.creditRequest',compact('type'));


    }

    public function updateCredit(){
        $type= [ "tipo de documento" => "Tipo de documento"]+[ 0 => "Cedula"]+[ 1 => "Cedula de extranjeria"];

        if(Input::file('files')){
            $file=Input::file('files');
            $fileName=$file->getClientOriginalName();
        }else{
            $file="";
            $fileName="";
        }


        $userManager= new UserManager(new User(),Input::all());
        $user=$userManager->isValid();

        $creditManager = new CreditManager(new CreditRequest(),Input::all());
        $Credit = $creditManager->isValid();



        if(Input::get()){
            if($Credit===true || $user===true){



                $creditManager->saveCredit($file,$fileName);
                $userManager->saveUser();

                return Redirect::to('credito')->with(array('mensaje' => 'El usuario ha sido creado correctamente.'));
            }else{
                return Redirect::to('credito')->withErrors($Credit)->withInput();
            }
        }else{
            return View::make('front.creditRequest',compact('type'));
        }
    }



   /* private function validateForms($inputs = array())
    {
        $rules=[
            'cedula'
            'ciudad_residencia'
            'fecha_expedicion'
            'fecha_nacimiento'
            'celular'
            'telefono'
            'direccion'
            'direccion_oficina'
            'archivo'
            'tipo_documento'
            'referencia'
            'valor_mensual'
        ]
    }*/


}