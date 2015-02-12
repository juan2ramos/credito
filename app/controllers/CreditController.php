<?php

use credits\Managers\CreditManager;
use credits\Entities\Location;
use credits\Entities\CreditRequest;
use credits\Entities\User;
use credits\Repositories\ImageRepo;
use credits\Repositories\LogRepo;
use credits\Managers\LocationManager;

class CreditController extends BaseController
{
    //MOSTRAR FORMULARIO CREDIT REQUEST
    public function index()
    {

        $type = ["tipo de documento" => "Tipo de documento"] + [0 => "Cedula"] + [1 => "Cedula de extranjeria"];
        $locations= ['location'=>'Seleccione una region']+Location::all()->lists('name','id');

        return View::make('front.creditRequest', compact('type','locations'));

    }

    //ENVIA LA SOLICITUD DE CREDITO
    public function updateCredit()
    {
        $user=Auth::user();
        $user_name = ["user_name" =>
            Input::get('name') . '.' .
            Input::get('second_name') . '.' .
            Input::get('last_name') . '.' .
            Input::get('second_last_name')
        ];

        $dataCredit = $user_name + Input::all();
        $creditManager = new CreditManager(new CreditRequest(), $dataCredit);
        $creditValidation = $creditManager->isValid();

        if ($creditValidation) {
            return Redirect::route('credit')->withErrors($creditValidation)->withInput();
        }
        $message=$creditManager->saveCredit(Input::get('files'),$user);
        if($message['role']) {
            if ($user) {
                new LogRepo(
                    [
                        'responsible' => $user->user_name,
                        'action' => 'ha solicitado un credito para: ',
                        'affected_entity' => $user_name['user_name'],
                        'method' => 'updateCredit'
                    ]
                );
                $data = Input::all()+["link"=>"solicitud"];
                if(Input::get('email'))
                {
                    Mail::send('emails.verification', $data, function ($message) {
                        $message->to(Input::get('email'), 'creditos lilipink')->subject('su solicitud de credito esta siendo procesada');

                    });
                }
                Mail::send('emails.requestMail', $data, function ($message) {
                    $message->to(Auth::user()->email, 'creditos lilipink')->subject('su solicitud de credito esta siendo procesada');

                });
            } else {
                new LogRepo(
                    [
                        'responsible' => $user_name['user_name'],
                        'action' => 'ha solicitado un credito',
                        'affected_entity' => '',
                        'method' => 'updateCredit'
                    ]
                );
                $data = ["link" => 1];
                if(Input::get('email'))
                {
                    Mail::send('emails.verification', $data, function ($message) {
                        $message->to(Input::get('email'), 'creditos lilipink')->subject('su solicitud de credito esta siendo procesada');

                    });
                }
            }
        }
        $messages=$message['message'];
        return View::make('front.sendCredit',compact('messages'));

    }

    //SALVA LAS IMAGENES CARGADAS DEL FORMULARIO CREDIT REQUEST
    public function saveImage()
    {
        $saveImages = new ImageRepo();
        $message = $saveImages->saveImages($_FILES,'upload/');
        return Response::json(array($message));
    }

    //MUESTRA LA TABLA DONDE SE CONTIENEN TODAS LAS SOLICITUDES PENDIENTES
    public function showRequest()
    {
        $users=User::all();
        $locations= Location::all();
        $showRequest=[];
        $i=0;
        foreach($users as $user)
        {
            $credit=CreditRequest::where('user_id','=',$user->id)->first();
            if($credit)
            {
                $showRequest[$i]=["user"=>$user]+["credit"=>$credit];
                $i++;
            }
        }

        return View::make('front.request',compact('showRequest','locations'));
    }

    //SE VISUALIZAN LOS DATOS Y DOCUMENTOS DEL USUARIO QUE SOLICITO EL CREDITO PARA DAR EL PROCESO DE SU APROBACION
    public function showCreditRequest($id)
    {
        $user=User::find($id);
        $credit=CreditRequest::where('user_id','=',$id)->first();
        $images =explode(",",$credit->files);
        return View::make('back.acceptCredit',compact('user','credit','images'));
    }

    //MUESTRA LA TABLA DONDE ESTAN TODAS LAS REGIONES
    public function showLocations()
    {
        $locations=Location::all();
        return View::make('back.location',compact('locations'));
    }

    //AGREGA NUEVAS REGIONES EN LA TABLA LOCATIONS
    public function addLocations()
    {
        $locationManager=new LocationManager(new Location(),Input::all());
        $locationValidator=$locationManager->isValid();
        if ($locationValidator) {
            return Redirect::route('location')->withErrors($locationValidator)->withInput();
        }

        $message=$locationManager->saveLocation();
        new LogRepo(
            [
                'responsible' => Auth::user()->user_name,
                'action' => 'ha agregado una region ',
                'affected_entity' => 'Regiones',
                'method' => 'saveLocation'
            ]
        );
        return Redirect::route('location')->with(array('message'=>$message));

    }

    //BORRA LAS REGIONES QUE NO ESTAN SIENDO UTILIZADAS POR OTROS USUARIOS
    public function deleteLocation($id)
    {

        $user=User::where('location', '=', $id)->first();
        $credit=CreditRequest::where('location', '=', $id)->first();
        if($user or $credit)
        {
            return Redirect::route('location')->with(array('messages'=>"No se pudo eliminar la region por que esta siendo usada"));
        }
        $location=Location::find($id);
        $location->delete();
        new LogRepo(
            [
                'responsible' => Auth::user()->user_name,
                'action' => 'ha eliminado una region ',
                'affected_entity' => 'Regiones',
                'method' => 'deleteLocation'
            ]
        );
        return Redirect::route('location')->with(array('message'=>"La region ha sido eliminada"));

    }

    public function acceptCredit($id)
    {
        dd(Input::all());exit;
    }

}