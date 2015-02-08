<?php namespace credits\Managers;
use credits\Entities\User;
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
            'email'                 => 'unique:users',
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
        $data=$this->prepareData($this->data);
        if($user)
        {
            $credit = CreditRequest::where('user_id', '=', $user->id)->first();
            if($credit)
            {
                return ['message'=>"solo se puede solicitar un credito"]+['mail'=>false];
            }else{
                $entityUser=User::find($user->id);
                $entityUser->fill($data);
                $entityUser->save();
                $this->entity->priority=1;
                $this->entity->files=$files;
                $this->entity->user_id=$user->id;
                $this->entity->fill($this->prepareData($this->data));
                $this->entity->save();
                return ['message'=>"El usuario ha sido creado correctamente."]+['mail'=>true];
            }
        }else{
            $user = new User($data);
            $user->save();
            $this->entity->priority=0;
            $this->entity->files=$files;
            $this->entity->fill($this->prepareData($this->data));
            $user->CreditRequest()->save($this->entity);
            return ['message'=>"El usuario ha sido creado correctamente."]+['mail'=>false];
        }


    }

}