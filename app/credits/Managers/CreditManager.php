<?php namespace credits\Managers;

class CreditManager extends BaseManager
{

    public function getRules()
    {
        $rules=[
            'cedula'                => 'required',
            'ciudad_residencia'     => 'required',
            'fecha_expedicion'      => 'required',
            'fecha_nacimiento'      => 'required',
            'celular'               => 'required',
            'telefono'              => 'required',
            'direccion'             => 'required',
            'direccion_oficina'     => 'required',
            'archivo'               => 'required',
            'tipo_documento'        => 'required',
            'referencia'            => 'required',
            'valor_mensual'         => 'required',
        ];
        return  $rules;
    }
}