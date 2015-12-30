<?php namespace credits\Managers;

use credits\Entities\CreditRequest;


class quotaCreditUploadManager extends BaseManager
{

    public function getRules()
    {
        $rules = [
            'creditValue' => 'required|numeric'
        ];
        return $rules;
    }

    public function getMessage()
    {
        $messages = [
            'required' => 'El campo  es obligatorio.',
            'numeric' => 'El campo va en numeros'
        ];
        return $messages;
    }

    public function saveCredit($id)
    {
        $data = $this->prepareData($this->data);
        $credit = CreditRequest::where('user_id','=',$id);
        $data = ["value" => $data["creditValue"]];
        $credit->update($data);
        return true;

    }
}