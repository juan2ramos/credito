<?php

use credits\Repositories\UserRepo;
use credits\Entities\Location;
use credits\Entities\User;
use credits\Entities\CreditRequest;
use credits\Components\ACL\Role;
use credits\Managers\UploadUserManager;
use credits\Managers\NewUserManager;
use credits\Repositories\LogRepo;
use credits\Entities\Extract;
use credits\Entities\ExcelDaily;

class UserController extends BaseController
{

    private $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function signUp()
    {
        return View::make('front/sign-up');
    }

    public function showAll()
    {
        $users = $this->userRepo->allPaginate(20);
        return View::make('back.users', compact('users'));

    }

    public function searchUsers()
    {
        $users = $this->userRepo->searchUsers();
        return View::make('back.users', compact('users'));
    }


    public function userShow($id)
    {
        $user = $this->userRepo->find($id);
        $credits = $user->CreditRequest()->get();
        $locations= ['0'=>'Sin region']+Location::all()->lists('name','id');
        $location=Location::where('id', '=', $user->location)->first();
        if($location)
        {
            $location=$location->name;
        }else{
            $location="No asignada";
        }
        $extracts=Extract::all();
        $vencidos=0 ;
        $debe=0;
        foreach($extracts as $extract)
        {
            if($extract->numero_documento==$user->identification_card)
            {
                if($extract->dias_vencidos>0)
                {
                    $vencidos=$vencidos+$extract->dias_vencidos;
                    $debe=$debe+$extract->saldo_credito_diferido;
                }
            }
        }

        return View::make('back.user', compact('user', 'credits','location','locations','extracts','vencidos','debe'));
    }

    public function newUser()
    {
        $location = ["seleccione una region"=>"seleccione una region"]+Location::all()->lists('name');
        $roles = ["seleccione un role"=>"seleccione un role"]+Role::all()->lists('name','id');
        return View::make('back.userNew',compact('roles','location'));
    }

    public function createUser()
    {
        $UserManager=new NewUserManager(new User(),Input::all());
        $userValidator=$UserManager->isValid();
        if($userValidator)
        {
            return Redirect::to('admin/nuevo-usuario')->withErrors($userValidator)->withInput();
        }
        $UserManager->createUser();
        new LogRepo(
            [
                'responsible' => Auth::user()->user_name,
                'action' => 'ha creado un usuario ',
                'affected_entity' => Input::get('user_name'),
                'method' => 'createUser'
            ]
        );
        return Redirect::to('admin/usuarios')->with('message','el usuario fue creado correctamente');
    }

    public function usersExcel()
    {
        $data = User::all(['id','name','user_name']);
        Excel::create('usuarios', function($excel) use($data){

            $excel->sheet('Excel sheet', function($sheet) use($data){
                $sheet->setAutoSize(true);
                $sheet->fromArray($data);
                $sheet->setOrientation('landscape');

            });

        })->export('xls');
    }
    public function usersPdf()
    {
        $data = User::where('name','like','%juan%')->get();
        Excel::create('usuarios', function($excel) use($data){

            $excel->sheet('Excel sheet', function($sheet) use($data){
                $sheet->setAutoSize(true);
                $sheet->fromArray($data, null, 'A1', true);
                $sheet->setOrientation('landscape');

            });

        })->export('pdf');
    }

    public function updateUser($id)
    {

        $user=new UploadUserManager(new User(),Input::all());
        $userValidator=$user->isValid();

        if($userValidator)
        {
            return Redirect::to('/admin/usuarios/'.$id)->withErrors($userValidator)->withInput();

        }
        $updateUser=$user->uploadUser($id,Auth::user()->roles_id);
        if($updateUser)
        {
            new LogRepo(
                [
                    'responsible' => Auth::user()->user_name,
                    'action' => 'ha actualizado un usuario ',
                    'affected_entity' => Input::get('user_name'),
                    'method' => 'updateUser'
                ]
            );
            return Redirect::to('/admin/usuarios/'.$id)->with(array('message'=>"El usuario se actualizo correctamente"));
        }
        return Redirect::to('/admin/usuarios/'.$id)->with(array('message_error'=>"solo se puede actualizar una vez por mes"));
    }

    public function updateClient($id)
    {

        $user=new UploadUserManager(new User(),Input::all());
        $userValidator=$user->isValid();
        if($userValidator)
        {
            return Redirect::to('Actualizar/'.$id)->withErrors($userValidator)->withInput();

        }
        $updateUser=$user->uploadUser($id,Auth::user()->roles_id);
        if($updateUser)
        {
            new LogRepo(
                [
                    'responsible' => Auth::user()->user_name,
                    'action' => 'ha actualizado un usuario ',
                    'affected_entity' => Input::get('user_name'),
                    'method' => 'updateUser'
                ]
            );
            return Redirect::to('Actualizar/'.$id)->with(array('message'=>"El usuario se actualizo correctamente"));
        }
        return Redirect::to('Actualizar/'.$id)->with(array('message_error'=>"solo se puede actualizar una vez por mes"));
    }

    public function userDelete($id)
    {
        User::destroy($id);
        new LogRepo(
            [
                'responsible' => Auth::user()->user_name,
                'action' => 'ha eliminado un usuario ',
                'affected_entity' => '',
                'method' => 'userDelete'
            ]
        );
        return Redirect::to('admin/usuarios')->with('message','el usuario fue eliminado correctamente');
    }

    public function showExcel()
    {
        return View::make('back.uploadExcel');
    }

    public function showExcelDaily()
    {
        return View::make('back.uploadExcelDiario');
    }

    public function uploadExcel()
    {

        DB::table('extracts')->truncate();
        $file = Input::file('file');

        $data = Excel::load($file, function($reader)  {
            ini_set('max_execution_time', 100000);

                // Getting all results
                $reader->get();
                Extract::insert($reader->toArray()[0]);



        });
        $extracts = Extract::all()->toArray();
        echo('Se registraron ' . Extract::all()->count() . ' <br><br><br>');

        foreach($extracts as $extract){

            print_r(implode("___", $extract));echo('</br>');
        }
    }

    public function uploadExcelDaily()
    {
        $file = Input::file('file');


        DB::table('excelDaily')->truncate();

        $data = Excel::load($file, function($reader)  {

            // Getting all results
            $reader->get();
            ExcelDaily::insert($reader->toArray()[0]);

        });
        if($data)
        {
            return Redirect::route('diario')->with('mensaje','el diario fue guardado correctamente');
        }
        return Redirect::route('diario')->with('mensaje_error','el diario no pudo ser guardado');
    }

    public function showState()
    {
        $users=User::all();
        $extracts=Extract::where('numero_documento','=',Auth::user()->identification_card)->get();
        $vencidos=0 ;
        $debe=0;
        foreach($extracts as $extract)
        {
            if($extract->dias_vencidos>0)
            {
                $vencidos=$vencidos+$extract->dias_vencidos;
                $debe=$debe+$extract->saldo_credito_diferido;
            }

        }
        return View::make('front.state',compact('extracts','vencidos','debe','users'));
    }

}