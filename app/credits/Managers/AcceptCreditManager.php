<?php namespace credits\Managers;
use credits\Entities\General_variables;
use credits\Entities\CreditRequest;
use credits\Entities\User;
class AcceptCreditManager extends BaseManager
{

    public function getRules()
    {
        $rules=[
            'data_monthly'          => 'numeric|required',
            'value_monthly'         => 'numeric|required',
            'data_credit'           => 'numeric|required',
            'reference1'            => 'numeric',
            'reference2'            => 'numeric',
            'files'                 => 'numeric',
            'fenalco'               => 'numeric'

        ];

        return  $rules;
    }

    public function getMessage()
    {
        $messages = [
            'required'      => 'El campo :attribute es obligatorio.',
            'numeric'       => 'El campo :attribute debe se numerico'
        ];
        return $messages;
    }

    public function saveCredit($id)
    {

        $credit=CreditRequest::where('user_id', '=', $id)->first();
        $data = $this->prepareData($this->data);
        $this->entity->fill($data);
        $this->entity->credit_id=$credit->id;
        $this->save();
        $credit->state=1;
        $credit->save();
        $user=User::find($id);
        return ['return'=>true]+['mail'=>$user->email];
    }

    public function verificatorCredit()
    {
        $variables=General_variables::all();
        $data = $this->prepareData($this->data);
        $message=[];
        $countCredit=0;
        if($variables[0]->value<$data['data_credit'])
        {
            $countCredit++;
        }else{

            $message=$message+['data_credit'=>'no superado datacredito'];
        }
        if($variables[1]->value<$data['data_monthly'])
        {
            $countCredit++;
        }else{

            $message=$message+['data_monthly'=>'no superado datos mensuales'];
        }
        if($variables[2]->value<$data['value_monthly'])
        {
            $countCredit++;
        }else{

            $message=$message+['value_monthly'=>'no superado datos mensuales'];
        }
        if($variables[2]->value<$data['value_monthly'])
        {
            $countCredit++;
        }else{

            $message=$message+['value_monthly'=>'no superado datos mensuales'];
        }
        if(isset($data['reference1']) or isset($data['reference2']))
        {
            $countCredit++;
        }else{
            $message=$message+['reference'=>'no tienen ninguna referencia confirmada'];
        }
        if(isset($data['files']))
        {
            $countCredit++;
        }else{
            $message=$message+['files'=>'Los archivos no estan correctos'];
        }

        if(isset($data['show']))
        {
            if($data['fenalco']>0)
            {
                $countCredit++;
            }else{
                $message=$message+['fenalco'=>'Fenalco no fue superado'];
            }
            if($countCredit==7)
            {
                return ['return'=>true];
            }else{
                return $message;
            }
        }else{
            if($countCredit==6)
            {
                return ['return'=>true];
            }else{
                return $message;
            }
        }

    }

}