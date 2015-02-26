<?php

use credits\Managers\CreditManager;
use credits\Entities\Location;
use credits\Entities\CreditRequest;
use credits\Entities\User;
use credits\Entities\Accept_credit;
use credits\Entities\General_variables;
use credits\Repositories\ImageRepo;
use credits\Repositories\LogRepo;
use credits\Managers\LocationManager;
use credits\Managers\VariableManager;
use credits\Managers\AcceptCreditManager;

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
        $locations=Location::where('id', '=', $credit->location)->first();
        $images =explode(",",$credit->files);
        return View::make('back.acceptCredit',compact('user','credit','images','locations'));
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


    //se decide si se acepta el credito
    public function acceptCredit($id)
    {
        $acceptCredit=new AcceptCreditManager(new Accept_credit(),Input::all());
        $acceptCreditValidator=$acceptCredit->isValid();


        if($acceptCreditValidator)
        {
            return Redirect::to('showCreditRequest/'.$id)->withErrors($acceptCreditValidator);
        }
        $probabilityCredit=$acceptCredit->verificatorCredit($id);
        if(isset($probabilityCredit['return'])==true)
        {
            $mailCredit=$acceptCredit->saveCredit($id);
            ;
            if($mailCredit['return'])
            {
                $data=$mailCredit;
                Mail::send('emails.accept', $data, function ($message) use($mailCredit){
                    $message->to($mailCredit['mail'], 'creditos lilipink')->subject('su solicitud de credito fue aprobada');

                });
            }

            return Redirect::to('solicitud')->with(array('message'=>"La solicitud de credito fue aprobada"));
        }
        return Redirect::to('showCreditRequest/'.$id)->withErrors($probabilityCredit)->withInput();

    }

    //VARIABLES GENERALES
    public function showVariables()
    {
        $variables=General_variables::all();
        return View::make('back.generalVariables',compact('variables'));
    }


    //ACTUALIZAR LOS CAMBIOS DE LAS VARIABLES GENERALES DATA CREDITO Y OTROS
    public function saveVariables($id)
    {

        $variableManager=new VariableManager(new General_variables(),Input::all());
        $variableValidator=$variableManager->isValid();
        if($variableValidator)
        {
            return Redirect::to('variables')->withErrors($variableValidator) ;
        }
        $variableManager->saveVariables($id);
        return Redirect::to('variables')->with(array('message'=>"Se actualizo correctamente"));
    }


    //reprobar credito
    public function reprobateCredit($id)
    {
        $user=User::find($id);
        $credit=CreditRequest::where('user_id', '=', $id)->first();
        $credit->state=2;
        $credit->save();
        if($user->email)
        {
            $data=["link"=>1];
            Mail::send('emails.rejected', $data, function ($message) use($user){
                $message->to($user->email, 'creditos lilipink')->subject('su solicitud de credito no fue aprobada');

            });
        }
        return Redirect::to('solicitud')->with(array('message'=>"el credito no fue aprobado"));
    }
    public static function notify()
    {
        if(Auth::user()->roles_id == 2){
            $user = Auth::user();
            $credits = CreditRequest::whereRaw('notify = 0 and location = ' . $user->location);
            return $credits->count();
        }
    }
}