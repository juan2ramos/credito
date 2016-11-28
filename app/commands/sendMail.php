<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use credits\Entities\User;
use credits\Entities\Extract;
use credits\Entities\CreditRequest;
use credits\Entities\ExcelDaily;

class sendMail extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'send:email';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Enviar extractos a emprendedoras y creditos lilipink.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $users = User::where('roles_id', 4)->orWhere('roles_id', 5)->get();
        foreach ($users as $user){
            $document = $user->identification_card;
            $extracts = Extract::where("nit", $document)->orderBy('id', 'DESC')->get();
            if(count($extracts)){
                $minPay = ExcelDaily::where("cedula", $document)->get();
                $quota = CreditRequest::where('user_id', $user->id)->first();
                $day = explode('-', date("y-m-d"));
                $q = $quota ? $quota->value : 300000;
                $this->PDFGen([
                    'user' => $user,
                    'day' => $day,
                    'extracts' => $extracts,
                    'quota' => intval($q),
                    'minPay' => $minPay,
                    'months' => $this->getMonths()
                ]);
            }
        }
	}

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

    private function PDFGen($data){
        require_once base_path('vendor/thujohn/pdf/src/Thujohn/Pdf/dompdf/dompdf_config.inc.php');
        $html = View::make('pdf.extract', $data)->render();
        $dompdf = new DOMPDF();
        $dompdf ->set_paper("A4", "portrait");
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->get_canvas()->get_cpdf()->setEncryption($data["user"]["identification_card"], $data["user"]["identification_card"]);
        $output = $dompdf->output();
        $pdfPath = 'extracto.pdf';
        File::put($pdfPath, $output);

        Mail::send('emails.sendExtracts', ['email' => 'email'], function ($message) use ($pdfPath, $data) {
            $message->to($data["user"]["email"], 'creditos lilipink')->subject('Envio de extracto');
            $message->attach($pdfPath);
        });
    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
