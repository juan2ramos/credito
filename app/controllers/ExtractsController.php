<?php

use \credits\Entities\ExcelDaily;
use \credits\Entities\Extract;
use \credits\Entities\CreditRequest;
use \credits\Entities\User;

class ExtractsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	private function getMonths(){
		return [
			'ene' => 1,
			'feb' => 2,
			'mar' => 3,
			'abr' => 4,
			'may' => 5,
			'jun' => 6,
			'jul' => 7,
			'ago' => 8,
			'sep' => 9,
			'oct' => 10,
			'nov' => 11,
			'dic' => 12,
		];
	}

	public function sendEmail($identification)
	{
		$user = User::whereRaw("roles_id = 4 and identification_card = {$identification}")->first();
		$extracts = Extract::whereRaw("nit = {$identification}")->orderBy('id', 'DESC')->get();
		$minPay = ExcelDaily::whereRaw("cedula = {$identification}")->get();
		$quota = CreditRequest::where('user_id', $user->id)->first();
		
		$day = explode('-', date("y-m-d"));
		$data = [
			'user' => $user,
			'day' => $day,
			'extracts' => $extracts,
			'quota' => intval($quota->value),
			'minPay' => $minPay,
			'months' => $this->getMonths()
		];

		if($user)
			return PDF::load( View::make('pdf.extract', $data), 'A4', 'portrait')->show();
	}
}
