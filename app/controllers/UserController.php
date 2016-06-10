<?php

use credits\Repositories\UserRepo;
use credits\Entities\Location;
use credits\Entities\User;
use credits\Entities\Point;
use credits\Entities\CreditRequest;
use credits\Components\ACL\Role;
use credits\Managers\UploadUserManager;
use credits\Managers\CardUserManager;
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
        $users = $this->userRepo->userClients();
        return View::make('back.users', compact('users'));

    }
    public function showAllAdmin()
    {
        $users = $this->userRepo->userAdmin();
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
        $points=Point::all();
        if($location)
            $location=$location->name;
        else
            $location="No asignada";

        $extracts = Extract::all();
        $vencidos = 0 ;
        $debe = 0;
        foreach($extracts as $extract)
        {
            if($extract->nit==$user->identification_card)
            {
                if($extract->dias_vencidos>0)
                {
                    $vencidos=$vencidos+$extract->dias_vencidos;
                    $debe=$debe+$extract->saldo_credito_diferido;
                }
            }
        }

       $disabled = (Auth::user()->roles_id == 3)?'disabled':'';

        return View::make('back.user', compact('user', 'credits','location','locations','extracts','vencidos','debe','points','disabled'));
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
            return Redirect::to('admin/nuevo-usuario')->withErrors($userValidator)->withInput();

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
        $data= User::where('roles_id','=','4')->select('card as Tarjeta','identification_card as Cedula','name as Nombre 1', 'second_name as Nombre 2','last_name as Apellido 1','second_last_name as Apellido 2','email as Email','mobile_phone as Celular','location as Ciudad','created_at as Fecha de creación')->get();
        $locations=Location::all();

        foreach($data as $user)
        {
            foreach($locations as $location)
            {
                if($user->location==$location->id)
                    $user->location=$location->name;
            }
        }
        Excel::create('usuarios', function($excel) use($data){

            $excel->sheet('Excel sheet', function($sheet) use($data){

                $sheet->cells('A1:H1', function($cells) {
                    $cells->setFontWeight('bold');
                    $cells->setBackground('#e80e8a');
                    $cells->setFontColor('#ffffff');
                    $cells->setAlignment('center');
                    $cells->setValignment('middle');
                });
                $sheet->setHeight(1,20);
                $sheet->setAutoSize(true);
                $sheet->fromArray($data);
                $sheet->setOrientation('landscape');
            });

        })->export('xls');
    }
    public function usersPdf()
    {
        $data= User::where('roles_id','=','4')->select('identification_card','name', 'second_name','last_name','second_last_name','email','mobile_phone','location','created_at')->get();
        $locations=Location::all();
        foreach($data as $user)
        {
            foreach($locations as $location)
            {
                if($user->location==$location->id)
                    $user->location=$location->name;
            }

        }
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

        $user=new cardUserManager(new User(),Input::only('card'));
        $userValidator=$user->isValid();
        if($userValidator)
            return Redirect::to('Actualizar/'.$id)->withErrors($userValidator)->withInput();

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
        $this->insertExcel($file, 'extracts');
        shell_exec("cd /usr/share/nginx/html/credito/; php artisan insert:excel extracts");

        return Redirect::route('excel')->with('mensaje','Los extractos se están guardando en la base de datos');
    }

    public function uploadExcelDaily()
    {
        DB::table('excelDaily')->truncate();
        $file = Input::file('file');
        $this->insertExcel($file, 'daily');
        shell_exec("cd /usr/share/nginx/html/credito/; php artisan insert:excel daily");

        return Redirect::route('diario')->with('mensaje','El diario se está guardando en la base de datos');
    }

    public function showState()
    {
        $users = User::all();
        $credit = CreditRequest::where('user_id','=',Auth::user()->id)->first();
        $extracts = Extract::where('nit','=',Auth::user()->identification_card)->get();
        $vencidos = 0 ;
        $debe = 0;
        foreach($extracts as $extract)
        {
            if($extract->dias_vencidos>0)
            {
                $vencidos = $vencidos + $extract->dias_vencidos;
                $debe = $debe + $extract->saldo_credito_diferido;
            }

        }
        return View::make('front.state',compact('extracts','vencidos','debe','users','credit'));
    }

    public function searchUsersCard()
    {
        $users  = User::where('card','=',0)->get();
        $points = Point::all();
        return View::make('back.userCard', compact('users','points'));
    }

    private function insertExcel($file, $name){
        $folder = $_SERVER['DOCUMENT_ROOT'] . "/toUpload";
        if(!is_dir($folder)) mkdir($folder, 0777, true);

        $fileName = $name . "." .  $file->getClientOriginalExtension();
        $file->move($folder, $fileName);
    }
}