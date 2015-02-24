<?php

use credits\Repositories\UserRepo;
use credits\Entities\Location;
use credits\Entities\User;
use credits\Components\ACL\Role;

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
        return View::make('back.user', compact('user', 'credits'));
    }

    public function newUser()
    {
        $location = Location::all()->lists('name');
        $roles = Role::all()->lists('name','id');
        return View::make('back.userNew',compact('roles','location'));
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
}