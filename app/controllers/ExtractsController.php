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
			$user = User::whereRaw("identification_card = {$identification}")->first();
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
		if($this->setData($identification)){
            $this->PDFGen($identification)->stream('extracto.pdf');
        }
	}

	public function sendPDF($identification){
        if($this->setData($identification)) {
            $output = $this->PDFGen($identification)->output();
            $pdfPath = 'extracto.pdf';
            File::put($pdfPath, $output);

            Mail::send('emails.accept', ['email' => 'email'], function ($message) use ($pdfPath, $user) {
                $message->to($user->email, 'creditos lilipink')->subject('Envio de extracto');
                $message->attach($pdfPath);
            });
        }
    }

	public function uploadTempFiles(){
        if(!Request::ajax())
            return Redirect::back();

        $names = [];
        $files = Input::file();
        foreach ($files as $file){
            $fileName = str_random(5) . '**extract**' . $file->getClientOriginalName();
            $fileName = str_replace(' ', '', $fileName);
            $file->move(public_path('toUpload/extracts/temp/'), $fileName);
            array_push($names, $fileName);
        }

        return $names;
    }

	private function PDFGen($identification){
        require_once base_path('vendor/thujohn/pdf/src/Thujohn/Pdf/dompdf/dompdf_config.inc.php');
        $html = View::make('pdf.extract', $this->data)->render();
        $dompdf = new DOMPDF();
        $dompdf ->set_paper("A4", "portrait");
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->get_canvas()->get_cpdf()->setEncryption($identification, $identification);
        return $dompdf;
    }
}
