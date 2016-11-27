<?php

use \credits\Entities\ExcelDaily;
use \credits\Entities\Extract;
use \credits\Entities\CreditRequest;
use \credits\Entities\User;
use Maatwebsite\Excel;

class ExtractsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	private $data;
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

	private function setData($identification)
	{
		$extracts = Extract::where("nit", $identification)->orderBy('id', 'DESC')->get();
		if ($extracts){
			$user = User::whereRaw("roles_id = 4 and identification_card = {$identification}")->first();
			$minPay = ExcelDaily::where("cedula", $identification)->get();
			$quota = CreditRequest::where('user_id', $user->id)->first();

			$day = explode('-', date("y-m-d"));
			$q = $quota ? $quota->value : 300000;
			$this->data = [
				'user' => $user,
				'day' => $day,
				'extracts' => $extracts,
				'quota' => intval($q),
				'minPay' => $minPay,
				'months' => $this->getMonths()
			];

			return true;
		}

		return false;
	}

	public function downloadExtract($identification)
	{
		if($this->setData($identification))
			PDF::load( View::make('pdf.extract', $this->data)->render(), 'A4', 'portrait')->download('extracto');
	}


	public function uploadTempFiles(){
        if(!Request::ajax())
            return Redirect::back();

        $names = [];
        $files = Input::file();
        foreach ($files as $file){
            $fileName = str_random(5) . '**extract**' . $file->getClientOriginalName();
            $file->move(public_path('toUpload/extracts/temp/'), $fileName);
            array_push($names, $fileName);
        }

        return $names;
    }

	/*public function prueba(){
		PDF::load(View::make('pdf.extractoprueba'), 'A4', 'portrait')->download('extract');
	} */
}
