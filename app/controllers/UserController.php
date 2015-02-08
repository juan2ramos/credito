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
        $users = $this->userRepo->allPaginate(20);
        return View::make('back.users',compact('users'));

    }
    public function searchUsers(){
        $users = $this->userRepo->searchUsers();
        return View::make('back.users',compact('users'));
    }
    public function userShow($id){
        $user = $this->userRepo->find($id);
        $credits = $user->CreditRequest()->get();
        return View::make('back.user',compact('user','credits'));
    }
}