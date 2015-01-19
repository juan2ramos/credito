<?php

use credits\Repositories\UserRepo;
class UserController extends BaseController{

    private $userRepo;

    public function __construct(UserRepo $userRepo){
        $this->userRepo = $userRepo;
    }

    public function signUp()
    {
        return View::make('front/sign-up');
    }
    public function showAll(){
        $users = $this->userRepo->all(5);
        return View::make('back.users',compact('users'));

    }
}