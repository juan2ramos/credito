<?php

namespace admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use credits\Entities\User;

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

	private function validateUser(){
		if(Auth::user()->roles_id != 1)
			return Redirect::back();
	}
}