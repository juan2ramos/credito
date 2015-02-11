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
    public function index()
    {

        $type = ["tipo de documento" => "Tipo de documento"] + [0 => "Cedula"] + [1 => "Cedula de extranjeria"];
        $locations= ['location'=>'Seleccione una region']+Location::all()->lists('name','id');

        return View::make('front.creditRequest', compact('type','locations'));

    }

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
                Mail::send('emails.verification', $data, function ($message) {
                    $message->to(Input::get('email'), 'creditos lilipink')->subject('su solicitud de credito esta siendo procesada');

                });
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
                Mail::send('emails.verification', $data, function ($message) {
                    $message->to(Input::get('email'), 'creditos lilipink')->subject('su solicitud de credito esta siendo procesada');

                });
            }
        }
        $messages=$message['message'];
        return View::make('front.sendCredit',compact('messages'));

    }


    public function saveImage()
    {
        $saveImages = new ImageRepo();
        $message = $saveImages->saveImages($_FILES,'upload/');
        return Response::json(array($message));
    }

    public function showRequest()
    {
        $users=User::all();
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

        return View::make('front.request',compact('showRequest'));
    }

    public function showLocations()
    {
        $locations=Location::all();
        return View::make('back.location',compact('locations'));
    }

    public function addLocations()
    {
        $locationManager=new LocationManager(new Location(),Input::all());
        $locationValidator=$locationManager->isValid();
        if ($locationValidator) {
            return Redirect::route('location')->withErrors($locationValidator)->withInput();
        }

        $message=$locationManager->saveLocation();
        return Redirect::route('location')->with(array('message'=>$message));
    }


    public function deleteLocation($id)
    {
        $location=Location::find($id);
        if($location->delete())
        {
            return Redirect::route('location')->with(array('message'=>"La region ha sido eliminada"));
        }
        return Redirect::route('location')->with(array('message'=>"No se pudo eliminar la region"));
    }

}