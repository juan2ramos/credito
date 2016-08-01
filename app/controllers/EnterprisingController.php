<?php

use credits\Entities\User;
use credits\Entities\CreditRequest;
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
		return View::make('front.enterprisingRegister');
	}

	protected function simpleRegister(){
		$input = Input::all();
		$user = User::create($input);

		$user->update([
			'user_name' => str_replace(' ', '.', $input['name'] . '.' . $input['last_name']),
			'roles_id' 	=> 5,
			'birth_city' => $input['instead_expedition']
		]);

		return Redirect::route('enterprisingRegister');
	}

	protected function creditRegister(){

		$input = Input::all();

		$user = User::create($input);
		$user->update([
			'user_name' => str_replace(' ', '.', $input['name'] . '.' . $input['last_name']),
			'roles_id' 	=> 5,
			'birth_city' => $input['instead_expedition']
		]);

		$creditRequest = CreditRequest::create($input);
		$creditRequest->files = $input['files'];
		$creditRequest->user_id = $user['id'];
		$creditRequest->save();

		return Redirect::route('enterprisingRegister');
	}
}
