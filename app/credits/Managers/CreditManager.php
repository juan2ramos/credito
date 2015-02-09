<?php namespace credits\Managers;
use credits\Entities\User;
use credits\Entities\Role;
use credits\Entities\CreditRequest;
class CreditManager extends BaseManager
{

    public function getRules()
    {
        $rules=[
            'identification_card'   => 'required|numeric|unique:users',
            'date_expedition'       => 'required',
            'instead_expedition'    => 'required',
            'office_address'        => 'required',
            'monthly_income'        => 'required',
            'monthly_expenses'      => 'required',
            'name_reference'        => 'required',
            'email'                 => 'email|unique:users',
            'phone_reference'       => 'required|numeric',
            'name_reference2'       => 'required',
            'phone_reference2'      => 'required|numeric',
            'files'                 => 'required',
            'user_name'             => 'required|unique:users',
            'name'                  => 'required',
            'second_name'           => 'required',
            'last_name'             => 'required',
            'second_last_name'      => 'required',
            'address'               => 'required',
            'residency_city'        => 'required',
            'birth_city'            => 'required',
            'mobile_phone'          => 'numeric|required_if:phone,null',
            'phone'                 => 'numeric|required_if:mobile_phone,null',
            'document_type'         => 'required|numeric',
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
    public function saveCredit($files,$user)
    {

        if($user)
        {
            $priority=Role::where('id', '=', $user->roles_id)->first();
            $priority=$priority->priority;
            $credit=CreditRequest::where('user_id', '=', $user->id)->first();
            if($credit)
                return ["message"=>"no puedes solicitar mas creditos"]+["role"=>false];

        }else{
            $priority=0;
        }

        $data=$this->prepareData($this->data);
        $user = new User($data);
        $user->roles_id=4;
        $user->save();
        $this->entity->priority=$priority;
        $this->entity->files=$files;
        $this->entity->fill($this->prepareData($this->data));
        $user->CreditRequest()->save($this->entity);
        return ["message"=>"la solicitud de credito fue enviada"]+["role"=>true];
    }

}