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
		$locations[0] = 'Seleccione una ciudad';
		$points = Location::join('points', 'locations.id', '=', 'points.location_id')->select('locations.id as location_id', 'locations.name as location_name', 'points.id as point_id', 'points.name as point_name')->whereRaw('isEnterpricingShop = 1 and state > 0')->get();
		foreach ($points as $point) {
			if (!in_array($point['location_name'], $locations)){
				$locations[$point['location_id']] = $point['location_name'];
			}
		}
		return View::make('front.enterprisingRegister', compact('locations', 'points'));
	}

	function postRegister(){
        $inputs = Input::all();
        $isCredit = Input::has('isCredit');
        $rules = $this->getRules($isCredit);
        $validator = $this->validate($inputs, $rules);
        if($validator->fails())
            return Redirect::back()->withErrors($validator)->withInput();

        $user = $this->createUser($inputs);
        if($isCredit){
            $user->hasCredit = 1;
            $user->save();
            $creditRequest = CreditRequest::create($inputs);
            $creditRequest->files = $inputs['files'];
            $creditRequest->user_id = $user['id'];
            $creditRequest->priority = 2;
            $creditRequest->location = $inputs['location'];
            $creditRequest->point = $inputs['point'];
            $creditRequest->save();
        }

        return Redirect::route('enterprisingRegister')->with(['message'=>"Te has registrado satisfactoriamente. Espera aprobación", 'isCredit' => $isCredit]);
    }

	public function enterpricingCreditList(){
		if(Auth::user()->roles_id == 4)
			return Redirect::to('/');
		if(Auth::user()->roles_id == 3)
			$users = User::join('creditRequest', 'users.id', '=', 'creditRequest.user_id')->whereRaw('users.roles_id = 5 and creditRequest.state = 1 and users.location = ' . Auth::user()->location)->paginate(20);
		else
			$users = User::join('creditRequest', 'users.id', '=', 'creditRequest.user_id')->whereRaw('users.roles_id = 5 and creditRequest.state = 1')->paginate(20);
		return View::make('back.enterpricingCreditList', compact('users'));
	}

	public function enterpricingSimpleList(){
		if(Auth::user()->roles_id == 4)
			return Redirect::to('/');
		if(Auth::user()->roles_id == 3)
			$users = User::whereRaw('users.roles_id = 5 and users.hasCredit = 0 and users.location = ' . Auth::user()->location . " and user_state < 2")->orderBy('user_state')->paginate(20);
		else
			$users = User::whereRaw('users.roles_id = 5 and users.hasCredit = 0 and user_state < 2')->orderBy('user_state')->paginate(20);
		return View::make('back.enterpricingList', compact('users'));
	}

	private function validate($request, $rules){
		return Validator::make($request, $rules);
	}

	private function createUser($input){
		$user = User::create($input);
		$user->user_name = str_replace(' ', '.', $input['name'] . '.' . $input['last_name']);
		$user->roles_id = 5;
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
			'identification_card' => 'required|numeric|unique:users,identification_card',
			'instead_expedition' => 'required',
			'date_expedition' => 'required',
			'residency_city' => 'required',
			'address' => 'required',
			'mobile_phone' => 'required|numeric|digits:10',
			'phone' => 'required|numeric|digits_between:7,10'
		];

		if($isCredit){
			$rules['monthly_income'] = 'required|numeric';
			$rules['monthly_expenses'] = 'required|numeric';
			$rules['location'] = 'required';
			$rules['point'] = 'required';
			$rules['name_reference'] = 'required';
			$rules['name_reference2'] = 'required';
			$rules['phone_reference'] = 'required|numeric|digits_between:7,10';
			$rules['phone_reference2'] = 'required|numeric|digits_between:7,10';
		}

		return $rules;
	}
}
