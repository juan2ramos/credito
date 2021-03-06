<?php

use credits\Managers\CreditManager;
use credits\Entities\Location;
use credits\Entities\Point;
use credits\Entities\CreditRequest;
use credits\Entities\User;
use credits\Entities\Accept_credit;
use credits\Entities\General_variables;
use credits\Repositories\ImageRepo;
use credits\Repositories\LogRepo;
use credits\Managers\LocationManager;
use credits\Managers\VariableManager;
use credits\Managers\AcceptCreditManager;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use credits\Managers\quotaCreditUploadManager;


class CreditController extends BaseController
{
    //MOSTRAR FORMULARIO CREDIT REQUEST
    public function index()
    {
        $points = Point::orderBy('name')->whereRaw('isCreditShop = 1 and state > 0')->get();
        $type = ["tipo de documento" => "Tipo de documento"] + [0 => "Cedula"] + [1 => "Cedula de extranjeria"];
        $locations = ['' => 'seleccione una region'] + Location::orderBy('name')->lists('name', 'id');

        return View::make('front.creditRequest', compact('type', 'locations', 'points'));
    }

    public function updateValueCredit($id)
    {
        $creditManager = new quotaCreditUploadManager(new CreditRequest(), Input::only('creditValue'));
        $creditValidation = $creditManager->isValid();
        if ($creditValidation)
            return Redirect::route('userShow', [$id])->withErrors($creditValidation)->withInput();

        $user = Auth::user();
        if ($creditManager->saveCredit($id)) {
            new LogRepo(
                [
                    'responsible' => $user->user_name,
                    'action' => 'Actualizo valor del credito',
                    'affected_entity' => 'Credito - user - ' . $id,
                    'method' => 'updateValueCredit'
                ]
            );
        }
        return Redirect::route('userShow', [$id]);
    }

    //ENVIA LA SOLICITUD DE CREDITO
    public function updateCredit()
    {
        $user = Auth::user();
        $user_name = ["user_name" =>
            Input::get('name') . '.' .
            Input::get('second_name') . '.' .
            Input::get('last_name') . '.' .
            Input::get('second_last_name')
        ];
        $dataCredit = $user_name + Input::all();
        $fingerprint = Input::file('finger');
        $creditManager = new CreditManager(new CreditRequest(), $dataCredit);
        $creditValidation = $creditManager->isValid();
        if ($creditValidation) {
            return Redirect::route('credit')->withErrors($creditValidation)->withInput();
        }
        $message = $creditManager->saveCredit(Input::get('files'), $user);
        if ($message['role']) {
            if ($user) {
                new LogRepo(
                    [
                        'responsible' => $user->user_name,
                        'action' => 'ha solicitado un credito para: ',
                        'affected_entity' => $user_name['user_name'],
                        'method' => 'updateCredit'
                    ]
                );
                $data = Input::all() + ["link" => "solicitud"];
                if (Input::get('email')) {
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
                if (Input::get('email')) {
                   Mail::send('emails.verification', $data, function ($message) {
                        $message->to(Input::get('email'), 'creditos lilipink')->subject('su solicitud de credito esta siendo procesada');

                    });
                }
            }
        }

        $messages = $message['message'];
       // $user = User::all()->last();
       // $user->hasCredit = 1;
        //if ($fingerprint) {
          //  $user->fingerprint = sha1(time()) . $fingerprint->getClientOriginalName();
            //$fingerprint->move("users", sha1(time()) . $fingerprint->getClientOriginalName());
        //}
        //$user->save();
        return View::make('front.sendCredit', compact('messages'));
    }

    //SALVA LAS IMAGENES CARGADAS DEL FORMULARIO CREDIT REQUEST
    public function saveImage()
    {
        $saveImages = new ImageRepo();
        $message = $saveImages->saveImages($_FILES, 'upload/');
        return Response::json(array($message));
    }

    //MUESTRA LA TABLA DONDE SE CONTIENEN TODAS LAS SOLICITUDES PENDIENTES
    public function showRequest()
    {
        if (Auth::user()->roles_id == 4)
            return Redirect::to('/');

        $locations = Location::all();
        if (Auth::user()->roles_id == 3)
            $showRequest = DB::table('creditRequest')->select('*', 'points.name as pointname')
                ->join('points', 'points.id', '=', 'creditRequest.point')
                ->join('users', 'users.id', '=', 'creditRequest.user_id')
                ->whereRaw("`creditRequest`.`created_at` >= '2015-11-15 00:00:00' and `creditRequest`.`state`='' and users.location = " . Auth::user()->location)
                ->get();
        else
            $showRequest = DB::table('creditRequest')->select('*', 'points.name as pointname')
                ->join('points', 'points.id', '=', 'creditRequest.point')
                ->join('users', 'users.id', '=', 'creditRequest.user_id')
                ->whereRaw("`creditRequest`.`created_at` >= '2015-11-15 00:00:00' and `creditRequest`.`state`=''")
                ->get();


        foreach ($showRequest as $user) {
            if (isset($user->CreditRequest)) {
                $date = $this->date($user->CreditRequest["created_at"]);
                if ($date) {
                    $user->CreditRequest["priority"] = "1";
                }
            }
        }

        $simpleEnterpricings = User::whereRaw('roles_id = 5 and hasCredit = 0 and user_state is null')->get();
        return View::make('front.request', compact('showRequest', 'locations', 'simpleEnterpricings'));
    }

    //SE VISUALIZAN LOS DATOS Y DOCUMENTOS DEL USUARIO QUE SOLICITO EL CREDITO PARA DAR EL PROCESO DE SU APROBACION
    public function showCreditRequest($id)
    {
        $user = User::find($id);
        $locations = Location::where('id', $user->CreditRequest->location)->first();
        $point = Point::where('id', $user->CreditRequest->point)->first();
        $images = explode(",", $user->CreditRequest->files);
        $priority = $user->CreditRequest->priority;
        return View::make('back.acceptCredit', compact('user', 'credit', 'images', 'locations', 'point', 'priority'));
    }

    //MUESTRA LA TABLA DONDE ESTAN TODAS LAS REGIONES
    public function showLocations()
    {
        $locations = Location::orderBy('name')->get();
        return View::make('back.location', compact('locations'));
    }

    //AGREGA NUEVAS REGIONES EN LA TABLA LOCATIONS
    public function addLocations()
    {
        $locationManager = new LocationManager(new Location(), Input::all());
        $locationValidator = $locationManager->isValid();
        if ($locationValidator)
            return Redirect::route('location')->withErrors($locationValidator)->withInput();

        $message = $locationManager->saveLocation();
        new LogRepo(
            [
                'responsible' => Auth::user()->user_name,
                'action' => 'ha agregado una region ',
                'affected_entity' => 'Regiones',
                'method' => 'saveLocation'
            ]
        );
        return Redirect::route('location')->with(array('message' => $message));
    }



    public function editLocation($id)
    {
        $location = Location::find($id);
        return View::make('back.locationUpdate', compact('location'));
    }

    public function editLocationUpdate()
    {
        $point = Location::find(Input::get('id'));
        $point->update(['name' => Input::get('name')]);
        return Redirect::route('locationUpdate', Input::get('id'))->with('message', 'Nombre actualizado');

    }
    //BORRA LAS REGIONES QUE NO ESTAN SIENDO UTILIZADAS POR OTROS USUARIOS
    public function deleteLocation($id)
    {
        $user = User::where('location', $id)->first();
        $credit = CreditRequest::where('location', $id)->first();
        if ($user or $credit) {
            return Redirect::route('location')->with(array('messages' => "No se pudo eliminar la region por que esta siendo usada"));
        }
        $location = Location::find($id);
        $location->delete();
        new LogRepo(
            [
                'responsible' => Auth::user()->user_name,
                'action' => 'ha eliminado una region ',
                'affected_entity' => 'Regiones',
                'method' => 'deleteLocation'
            ]
        );
        return Redirect::route('location')->with(array('message' => "La region ha sido eliminada"));
    }


    //se decide si se acepta el credito
    public function acceptCredit($id)
    {
        $acceptCredit = new AcceptCreditManager(new Accept_credit(), Input::all());
        $acceptCreditValidator = $acceptCredit->isValid();

        if ($acceptCreditValidator) {
            return Redirect::route('showCreditRequest', ['id' => $id])->withErrors($acceptCreditValidator);
        }

        $probabilityCredit = $acceptCredit->verificatorCredit($id);

        if (isset($probabilityCredit['return']) == true) {
            $mailCredit = $acceptCredit->saveCredit($id, Auth::user()->id);
            new LogRepo(
                [
                    'responsible' => Auth::user()->user_name,
                    'action' => 'ha aprobado un credito ',
                    'affected_entity' => '',
                    'method' => 'acceptCredit'
                ]
            );
            if ($mailCredit['mail']) {
                $data = $mailCredit;
                $user = User::find($id);
                $role = $user->roles_id == 4 ? ['credito_personal'] : ['emprendedora_credito'];
                $userName = strtolower($user->name . '.' . $user->last_name);
                $service = \credits\Components\Services\SendRequest::create();
                $response = null;
                $user->update(['user_state' => 1, 'user_name' => $userName, 'password' => $userName . '123', 'page_id' => '']);
                $service->getAction($role, $user, $userName . '123');
/*
                try {
                    $response = $service->postRequest('http://lilipink.com/wp-json/wp/v2/users', [
                        'roles' => $role,
                        "username" => $user->email,
                        "password" => $userName . "123",
                        "email" => $user->email
                    ]);

                    if ($response) {
                        $user->update(['user_state' => 1, 'user_name' => $userName, 'password' => $userName . '123', 'page_id' => json_decode($response)->id]);
                        $service->getAction($role, $user, $userName . '123');
                    }

                } catch (Exception $e) {
                    $service->getError($e->getCode());
                }*/
            }

            return Redirect::route('request')->with(array('message' => "La solicitud de credito fue aprobada"));
        }
        return Redirect::route('showCreditRequest', $id)->with('message', $probabilityCredit)->withErrors($probabilityCredit)->withInput();

    }

    //VARIABLES GENERALES
    public function showVariables()
    {
        $variables = General_variables::all();
        return View::make('back.generalVariables', compact('variables'));
    }


    //ACTUALIZAR LOS CAMBIOS DE LAS VARIABLES GENERALES DATA CREDITO Y OTROS
    public function saveVariables($id)
    {
        $variableManager = new VariableManager(new General_variables(), Input::all());
        $variableValidator = $variableManager->isValid();
        if ($variableValidator) {
            return Redirect::route('variables')->withErrors($variableValidator);
        }
        $variableManager->saveVariables($id);
        return Redirect::route('variables')->with(array('message' => "Se actualizo correctamente"));
    }


    //reprobar credito
    public function reprobateCredit($id)
    {
        $user = User::find($id);
        $credit = CreditRequest::where('user_id', '=', $id)->first();
        $credit->state = 2;
        $credit->save();
        $user->user_state = 2;
        $user->save();
        if ($user->email) {
            $data = ["link" => 1];
            if ($user->roles_id == 4)
               Mail::send('emails.rejected', $data, function ($message) use ($user) {
                    $message->to($user->email, 'creditos lilipink')->subject('su solicitud de credito no fue aprobada');
                });
            else
                Mail::send('emails.ECreditDelivery', ['email' => 'email'], function ($m) use ($user) {
                    $m->to($user->email, 'Creditos Lilipink')->subject('Credito emprendedora rechazado');
                });
        }
        return Redirect::route('request')->with(array('message' => "el credito no fue aprobado"));
    }

    public static function notify()
    {
        if (Auth::user()->roles_id == 3) {
            $user = Auth::user();
            $credits = CreditRequest::whereRaw('notify = 0 and state = "" and location = ' . $user->location);
            return $credits->count();
        }
    }


    public function date($date)
    {
        $created = new Carbon($date);
        $now = Carbon::now();
        $difference = ($created->diff($now)->days < 1)
            ? 'today'
            : $created->diffForHumans($now);
        $dates = explode(" ", $difference);
        if (count($dates) == 1) {
            return false;
        }
        return true;
    }
}
