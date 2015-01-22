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
            'phone_reference2'      => 'required',
            'files'                 => 'required',

            'name'                  => 'required',
            'second_name'           => 'required',
            'last_name'             => 'required',
            'second_last_name'      => 'required',
            'address'               => 'required',
            'residency_city'        => 'required',
            'birth_city'            => 'required',
            'mobile_phone'          => 'required|numeric',
            'phone'                 => 'required|numeric',
            'document_type'         => 'required|numeric',
            'identification_card'   => 'required|numeric|unique:users',
            'date_birth'            => 'required',

        ];




        return  $rules;
    }



    public function saveCredit($files)
    {
       /* $file = $this->data->file('files');

        if(empty ($file)){
            return Redirect::to('credito')->with([''])->withInput();
        }*/


        $data=$this->prepareData($this->data);
        $user = new User($data);
        $user->save();
        $this->entity->files=$files;
        $this->entity->fill($this->prepareData($this->data));
        $user->CreditRequest()->save($this->entity);

    }

    public function saveImages($images)
    {

        foreach ($images as $image) {
            if($image)
            {
                $imagename= $image->getClientOriginalName();

                //upload
                $uploadflag=$image->move('imgs',$imagename);//dest,name

                if($uploadflag)
                {
                    $uploadedimages[]=$imagename;
                }
            }

        }
    }
}