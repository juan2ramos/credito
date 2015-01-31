<?php

use credits\Managers\CreditManager;
use credits\Managers\UserManager;
use credits\Entities\CreditRequest;
use credits\Entities\User;
use credits\Repositories\ImageRepo;
use credits\Repositories\LogRepo;

class SliderController extends BaseController
{
    public function index()
    {

        return View::make('front.slider');

    }

    public function updateSlider()
    {

    }

    public function saveImage()
    {
        $saveImages = new ImageRepo();
        $message = $saveImages->saveImages($_FILES,"sliders/");
        return Response::json(array($message));
    }

}