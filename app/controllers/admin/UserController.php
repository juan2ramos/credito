<?php

namespace admin;

use credits\Entities\CreditRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use credits\Entities\User;
use Illuminate\Support\Facades\Mail;

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /admin/user
	 *
	 * @return Response
	 */

	//ALTER TABLE creditos.users ADD user_state INT NULL;

	public function activate($id){
		$this->validateUser();
		$user = User::find($id);
		$user->update(['user_state' => 1]);

		Mail::send('emails.ESimpleAccept', ['email' => 'email'], function ($m) use($user){
			$m->to($user->email, 'Creditos Lilipink')->subject('Eres una emprendedora Lilipink');
		});

		return Redirect::back()->with('message', 'El usuario se ha activado');
	}


	public function disable($id)
	{
		$this->validateUser();

		$user = User::find($id);
		$user->update(['user_state' => 0]);
		return Redirect::back()->with('message', 'El usuario se ha desactivado');
	}

	public function destroy($id)
	{
		$this->validateUser();

		$user = User::find($id);
		$user->update(['user_state' => 2]);
		return Redirect::back()->with('message', 'El usuario se ha desactivado');
	}

	public function getDataEnterpricing($id){
		if(Input::get('type') == 'credit')
			$id = CreditRequest::find($id)->user_id;

		$user = User::find($id);
		return [
			'user' => $user,
			'type' => Input::get('type'),
			'routes' => [
				'enable' => Input::get('enable'),
				'disable' => Input::get('disable')
			]
		];
	}

	private function validateUser(){
		if(Auth::user()->roles_id != 1)
			return Redirect::back();
	}
}