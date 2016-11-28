<?php

namespace credits\Components\Services;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;

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

    public function getAction($role, $user, $password){

        if($role == 'credito_personal'){

            Mail::send('emails.accept', ['email' => $user->email, 'password' => $password], function ($message) use ($user) {
                $message->to($user->email, 'creditos lilipink')->subject('Su solicitud de credito fue aprobada');
            });

        } elseif($role == 'emprendedora_contado'){

            Mail::send('emails.ESimpleAccept', ['email' => $user->email, 'password' => $password], function ($m) use($user){
                $m->to($user->email, 'Creditos Lilipink')->subject('Eres una emprendedora Lilipink');
            });

        } elseif($role == 'emprendedora_credito'){

            Mail::send('emails.ECreditAccept', ['email' => $user->email, 'password' => $password], function ($m) use($user){
                $m->to($user->email, 'Creditos Lilipink')->subject('Credito emprendedora aprobado');
            });
        }
    }

    public function getError($code){
        if($code === 500){
            //El usuario ya existe
        }
    }
}