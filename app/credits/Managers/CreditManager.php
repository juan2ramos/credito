<?php namespace credits\Managers;
use credits\Entities\User;
class CreditManager extends BaseManager
{

    public function getRules()
    {
        $rules=[

            'date_expedition'       => 'required',
            'instead_expedition'    => 'required',
            'office_address'        => 'required',
            'monthly_income'        => 'required',
            'monthly_expenses'      => 'required',
            'name_reference'        => 'required',
            'phone_reference'       => 'required|numeric',
            'name_reference2'       => 'required',
            'phone_reference2'      => 'required|numeric',
            'files'                 => 'required',

            'name'                  => 'required',
            'second_name'           => 'required',
            'last_name'             => 'required',
            'second_last_name'      => 'required',
            'address'               => 'required',
            'residency_city'        => 'required',
            'birth_city'            => 'required',
            'mobile_phone'          => 'numeric',
            'phone'                 => 'numeric',
            'document_type'         => 'required|numeric',
            'identification_card'   => 'required|numeric|unique:users',
            'date_birth'            => 'required',

        ];





        return  $rules;
    }




    public function getMessage()
    {
        $messages = [
            'required'      => 'El campo :attribute es obligatorio.',
            'min'           => 'El campo :attribute no puede tener menos de :min carácteres.',
            'max'           => 'El campo :attribute no puede tener más de :max carácteres.',
            'email'         => 'El correo esta mal escrito',
            'same'          => 'Las contraseñas deben ser iguales',
            'unique'        => 'El :attribute ya se encuentra registrado',
            'numeric'       => 'El :attribute va en numeros'
        ];
        return $messages;
    }
    public function saveCredit($files)
    {



        $data=$this->prepareData($this->data);
        $user = new User($data);
        $user->save();
        $this->entity->files=$files;
        $this->entity->fill($this->prepareData($this->data));
        $user->CreditRequest()->save($this->entity);

    }

}