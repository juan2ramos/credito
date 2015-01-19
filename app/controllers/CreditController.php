<?php

use credits\Managers\CreditManager;
use credits\Entities\CreditRequest;

class CreditController extends BaseController
{
    public function index()
    {
        $creditManager = new CreditManager(new CreditRequest(),Input::all());
        $user = $creditManager->isValid();
        $tipo= [ "tipo de documento" => "Tipo de documento"]+[ 0 => "Cedula"]+[ 1 => "Cedula de extranjeria"];

        return View::make('front.creditRequest',compact('tipo'));
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