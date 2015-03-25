<?php
use credits\Entities\Slider;
use credits\Entities\ExcelDaily;
class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		$sliders= Slider::all();
		$slidersArrays=$this->getOrder($sliders,0);
		$slidersName=$this->getOrder($sliders,1);
		$diario='';
		if(Auth::user())
		{
			$diario=ExcelDaily::where('cedula','=',Auth::user()->identification_card)->first();
		}
		return View::make('front/home',compact('slidersArrays','slidersName','diario'));
	}

	private function getOrder($sliders,$number)
	{
		$slidersArrays=[];
		$slidersName=[];
		$i=0;
		if(count($sliders))
		{
			foreach($sliders as $slider)
			{
				if($slider->number_slider>0)
				{
					$slidersArrays=$slidersArrays+[$i=>$slider->number_slider];
					$slidersName=$slidersName+[$i=>$slider->files];
					$i++;
				}
			}
		}
		$slidersArrays=$this->order($slidersArrays,$slidersName,0);
		$slidersName=$this->order($slidersArrays,$slidersName,1);
		if($number==0)
		{
			return $slidersArrays;
		}
			return $slidersName;
	}

	private function order($slidersArrays,$slidersName,$number)
	{
		for($i=0;$i<count($slidersArrays);$i++)
		{
			for($j=0;$j<count($slidersArrays);$j++)
			{
				if($slidersArrays[$i]<$slidersArrays[$j])
				{
					$aux=$slidersArrays[$i];
					$slidersArrays[$i]=$slidersArrays[$j];
					$slidersArrays[$j]=$aux;

					$aux1=$slidersName[$i];
					$slidersName[$i]=$slidersName[$j];
					$slidersName[$j]=$aux1;
				}
			}
		}

		if($number==0)
		{
			return $slidersArrays;
		}
		return $slidersName;
	}

	public function email()
	{
		$data = ["link" => 1];
		$emails=array(array('mail'=>'edwarddiaz92@gmail.com'),array('mail'=>'drawderiah@gmail.com'));
		foreach($emails as $email)
		{
			$correo=$email["mail"];
			Mail::send('emails.auth.reminder', $data, function ($message) use ($correo) {
				$message->to($correo, 'creditos lilipink')->subject('su solicitud de credito esta siendo procesada');
			});
		}


	}

}
