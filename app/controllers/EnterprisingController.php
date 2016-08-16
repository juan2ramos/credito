<?php

use credits\Entities\User;
use credits\Entities\CreditRequest;
use credits\Entities\Point;
use credits\Entities\Location;
use credits\Repositories\ImageRepo;

class EnterprisingController extends Controller {


	protected function index()
	{
		return View::make('front.enterprising');
	}
	protected function isEnterprising()
	{
		return View::make('front.isEnterprising');
	}
	protected function buy()
	{
		return View::make('front.buy');
	}
	protected function pay()
	{
		return View::make('front.pay');
	}
	protected function magazine()
	{
		return View::make('front.magazine');
	}

	protected function getRegister(){
		$locations = ['location' => 'Seleccione una ciudad'] + Location::all()->lists('name', 'id');
		$points =  Point::all()->toArray();
		return View::make('front.enterprisingRegister', compact('locations', 'points'));
	}

	protected function simpleRegister(){
		$input = Input::all();
		$validator = $this->validate($input);
		if($validator->fails()){
			return Redirect::back()->with(['errors' => $validator->messages()])->withInput();
		}

		$user = User::create($input);

		$user->update([
			'user_name' => str_replace(' ', '.', $input['name'] . '.' . $input['last_name']),
			'roles_id' 	=> 5,
			'birth_city' => $input['instead_expedition']
		]);

		return Redirect::route('enterprisingRegister')->with(['mensaje'=>"Te has registrado satisfactoriamente. Espera aprobación"]);
	}

	protected function creditRegister(){

		$input = Input::all();

		$validator = $this->validate($input);
		if($validator->fails()){
			return Redirect::back()->with(['errors' => $validator->messages(), 'isCredit' => true])->withInput();
		}

		$user = User::create($input);
		$user->update([
			'user_name' => str_replace(' ', '.', $input['name'] . '.' . $input['last_name']),
			'roles_id' 	=> 5,
			'birth_city' => $input['instead_expedition']
		]);

		$creditRequest = CreditRequest::create($input);
		$creditRequest->files = $input['files'];
		$creditRequest->user_id = $user['id'];
		$creditRequest->priority = 2;
		$creditRequest->location = $input['location'];
		$creditRequest->point = $input['point'];
		$creditRequest->save();

		return Redirect::route('enterprisingRegister')->with(['message'=>"Te has registrado satisfactoriamente. Espera aprobación"]);
	}

	private function validate($request){
		return Validator::make(
			$request,
			[
				'name' => 'required',
				'last_name' => 'required',
				'email' => 'required',
				'password' => 'required',
				'password_confirm' => 'required',
				'identification_card' => 'required',
				'instead_expedition' => 'required',
				'date_expedition' => 'required',
				'residency_city' => 'required',
				'address' => 'required',
				'mobile_phone' => 'required',
				'phone' => 'required',
				'monthly_income' => 'required',
				'monthly_expenses' => 'required',
				'location' => 'required',
				'point' => 'required',
				'name_reference' => 'required',
				'name_reference2' => 'required',
				'phone_reference' => 'required',
				'phone_reference2' => 'required',
				'file' => 'required'
			]
		);
	}
}
