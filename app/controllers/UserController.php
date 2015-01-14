<?php

class UserController extends BaseController{


    public function signUp()
    {
        return View::make('front/sign-up');
    }
}