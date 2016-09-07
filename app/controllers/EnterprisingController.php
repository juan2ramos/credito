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
		$rules = $this->getRules(false);
		$validator = $this->validate($input, $rules);

		if($validator->fails())
			return Redirect::back()->withErrors($validator)->withInput();

		$this->createUser($input);
		return Redirect::route('enterprisingRegister')->with(['message'=>"Te has registrado satisfactoriamente. Espera aprobación"]);
	}

	protected function creditRegister(){

		$input = Input::all();
		$rules = $this->getRules(true);
		$validator = $this->validate($input, $rules);

		if($validator->fails())
			return Redirect::back()->withErrors($validator)->withInput()->with(['isCredit' => true]);

		$user = $this->createUser($input);
		$user->hasCredit = 1;
		$user->save();
		$creditRequest = CreditRequest::create($input);
		$creditRequest->files = $input['files'];
		$creditRequest->user_id = $user['id'];
		$creditRequest->priority = 2;
		$creditRequest->location = $input['location'];
		$creditRequest->point = $input['point'];
		$creditRequest->save();

		return Redirect::route('enterprisingRegister')->with(['message'=>"Te has registrado satisfactoriamente. Espera aprobación", 'isCredit' => true]);
	}

	public function enterpricingCreditList(){
		if(Auth::user()->roles_id == 3)
			$users = User::join('creditRequest', 'users.id', '=', 'creditRequest.user_id')->whereRaw('users.roles_id = 5 and creditRequest.state = 1 users.location = ' . Auth::user()->location)->paginate(20);
		else
			$users = User::join('creditRequest', 'users.id', '=', 'creditRequest.user_id')->whereRaw('users.roles_id = 5 and creditRequest.state = 1')->paginate(20);
		return View::make('back.enterpricingCreditList', compact('users'));
	}

	public function enterpricingSimpleList(){
		if(Auth::user()->roles_id == 3)
			$users = User::whereRaw('users.roles_id = 5 and users.hasCredit = 0 and users.location = ' . Auth::user()->location . " and (user_state is null or user_state < 2)")->orderBy('user_state')->paginate(20);
		else
			$users = User::whereRaw('users.roles_id = 5 and users.hasCredit = 0 and (user_state is null or user_state < 2)')->orderBy('user_state')->paginate(20);
		return View::make('back.enterpricingList', compact('users'));
	}

	private function validate($request, $rules){
		return Validator::make($request, $rules);
	}

	private function createUser($input){
		$user = User::create($input);
		$user->user_name = str_replace(' ', '.', $input['name'] . '.' . $input['last_name']);
		$user->roles_id = 5;
		$user->user_state = 1;
		$user->birth_city = $input['instead_expedition'];
		$user->whereIsWorking = $input['whereIsWorking'];
		$user->isWorking = $input['isWorking'];
		$user->save();

		return $user;
	}

	private function getRules($isCredit){
		$rules = [
			'name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:8',
			'password_confirm' => 'required|same:password',
			'identification_card' => 'required|numeric',
			'instead_expedition' => 'required',
			'date_expedition' => 'required',
			'residency_city' => 'required',
			'address' => 'required',
			'mobile_phone' => 'required|numeric|min:7',
			'phone' => 'required|numeric|min:7'
		];

		if($isCredit){
			$rules['monthly_income'] = 'required|numeric';
			$rules['monthly_expenses'] = 'required|numeric';
			$rules['location'] = 'required';
			$rules['point'] = 'required';
			$rules['name_reference'] = 'required';
			$rules['name_reference2'] = 'required';
			$rules['phone_reference'] = 'required|numeric|min:7';
			$rules['phone_reference2'] = 'required|numeric|min:7';
		}

		return $rules;
	}
}
