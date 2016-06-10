<?php

use \credits\Entities\ExcelDaily;
use \credits\Entities\Extract;
use \credits\Entities\User;

class ExtractsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	private function getMonths(){
		return [
			'ene' => '01',
			'feb' => '02',
			'mar' => '03',
			'abr' => '04',
			'may' => '05',
			'jun' => '06',
			'jul' => '07',
			'ago' => '08',
			'sep' => '09',
			'oct' => '10',
			'nov' => '11',
			'dic' => '12',
		];
	}

	public function sendEmail($identification)
	{
		$users = User::whereRaw("roles_id = 4 and identification_card = {$identification}")->first();
		$extracts = Extract::whereRaw("nit = {$identification}")->orderBy('id', 'DESC')->get();
		$minPay = ExcelDaily::whereRaw("cedula = {$identification}")->get();
		
		$day = explode('-', date("y-m-d"));
		$data = [
			'user' => $users,
			'day' => $day,
			'extracts' => $extracts,
			'minPay' => $minPay,
			'months' => $this->getMonths()
		];

		if($users)
			return PDF::load( View::make('pdf.extract', $data), 'A4', 'portrait')->show();
	}
}
