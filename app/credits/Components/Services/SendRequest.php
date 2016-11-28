<?php

namespace credits\Components\Services;
use GuzzleHttp\Client;

class SendRequest {

    private $client;

    public function __construct(){
        $this->client = new Client();
    }

    /** Retorna la instancia de zona pagos **/

    public static function create(){
        return new SendRequest();
    }

    /** Retorna los datos y estado del pago **/

    public function postRequest($url, array $body){
        $data = [
            'headers' => [
                'Authorization' => 'Basic dXNlcl9jcmVhdG9yOk9wS1I4RnhxMmxvbGlPV1VGZFRvVA==',
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($body)
        ];
        $response = $this->client->post($url, $data);
        return $response->getBody()->getContents();
    }

    public function getAction($role, $user){

        if($role == 'credito_personal'){

            return 'sendMail1';

        } elseif($role == 'emprendedora_contado'){

            Mail::send('emails.ESimpleAccept', ['email' => 'email'], function ($m) use($user){
                $m->to($user->email, 'Creditos Lilipink')->subject('Eres una emprendedora Lilipink');
            });

        } elseif($role == 'emprendedora_credito'){

            return 'sendMail3';
        }
    }

    public function getError($code){
        if($code === 500){
            //El usuario ya existe
        }
    }
}