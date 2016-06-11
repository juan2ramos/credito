<?php
use credits\Entities\Slider;
use credits\Entities\ExcelDaily;
class HomeController extends BaseController
{
	public function index()
	{
		$sliders = Slider::where('number_slider', '<>', '0')->orderBy('number_slider', 'ASC')->get();
		if (Auth::user())
			$diario = ExcelDaily::where('cedula', Auth::user()->identification_card)->first();
		return View::make('front.home', compact('sliders', 'diario'));
	}

	public function contact()
	{
		$data = Input::all();
		Mail::send('emails.contact', $data, function ($message) {
			$message->to('carterainnova@innova-quality.com.co', 'creditos lilipink')->subject('Mensaje desde formulario de contacto de creditos lilipink');
		});
		return Redirect::back();
	}

	public function faq()
	{
		return View::make('front.faq');
	}
}