<?php

namespace admin;

use credits\Entities\CreditRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

	public function activate($id){
		$this->validateUser();
		$user = User::find($id);
        $userName = strtolower($user->name . '.' . $user->last_name);
        $service = \credits\Components\Services\SendRequest::create();
        $response = null;

        try{
            $response = $service->postRequest('http://emprendedoras.lilipink.com/wp-json/wp/v2/users', [
                'roles' => '["emprendedora_contado"]',
                "username" => $user->email,
                "password" => $userName . "123",
                "email" => $user->email
            ]);

            if($response) {
                $user->update(['user_state' => 1, 'user_name' => $userName, 'password' => $userName . '123', 'page_id' => json_decode($response)->id]);
                $service->getAction('["emprendedora_contado"]', $user, $userName . "123");
            }

        } catch (Exception $e){
            $service->getError($e->getCode());
        }
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