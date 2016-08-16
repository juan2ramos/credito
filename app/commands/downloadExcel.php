<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use credits\Entities\User;
use credits\Entities\Location;
use credits\Entities\Point;
use credits\Entities\CreditRequest;

class downloadExcel extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'download:excel';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

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
		$dir = $_SERVER['DOCUMENT_ROOT'] . "public/exports/";
		$doc = 'usuarios.xlsx';

		if(is_dir($dir)){
			unlink($dir . $doc);
			rmdir($dir);
		}

		$users = $this->exportUsers();

		Excel::create('usuarios', function($excel) use($users){
			$excel->sheet('Excel sheet', function($sheet) use($users){
				$sheet->cells('C1:S1', function($cells) {
					$cells->setFontWeight('bold');
					$cells->setBackground('#e80e8a');
					$cells->setFontColor('#ffffff');
					$cells->setAlignment('center');
					$cells->setValignment('middle');
				});
				$sheet->setHeight([1 => 20, 2 => 15]);
				$sheet->setAutoSize(false);
				$sheet->setWidth('A', 1);
				$sheet->setWidth('B', 1);
				$sheet->fromArray($users);
				$sheet->setOrientation('landscape');
			});
		})->store('xlsx', $dir, true);

		$route = "exports/" . $doc;

		Mail::send('emails.usersExcel', ['link' => $route], function ($m) use($route){
			$m->to('carterainnova@innova-quality.com.co', 'Creditos Lilipink')->subject('Notificación Lilipink');
		});

		Mail::send('emails.usersExcel', ['link' => $route], function ($m) use($route){
			$m->to('sanruiz1003@gmail.com', 'Creditos Lilipink')->subject('Notificación Lilipink');
		});
	}

	private function exportUsers(){
		$users = User::where('roles_id', '>=', '4')->select('id', 'roles_id','card as Tarjeta','identification_card as Cedula','name as Nombre1', 'second_name as Nombre2','last_name as Apellido1','second_last_name as Apellido2','email as Email','mobile_phone as Celular','location as Ciudad','created_at as Fecha de creación')->orderBy('roles_id', 'DESC')->get();
		foreach($users as $key => $user){
			$credit = CreditRequest::where('user_id', $user->id)->first();
			$users[$key]['Referencia1']     = $credit ? $credit->name_reference : null;
			$users[$key]['Tel_Referencia1'] = $credit ? $credit->phone_reference : null;
			$users[$key]['Referencia2']     = $credit ? $credit->name_reference2 : null;
			$users[$key]['Tel_Referencia2'] = $credit ? $credit->phone_reference2 : null;
			$users[$key]['Ciudad'] 			= $user->Ciudad ? Location::find($user->Ciudad)->name : 'Sin región';
			$users[$key]['Tienda'] 			= $credit ? Point::find($credit->point)['name'] : 'Sin punto';
			$users[$key]['Cupo_Credito']    = $credit ? $credit->value : null;
			$users[$key]['Emprend'] 		= $user->roles_id == 5 ? 'Si' : 'No';
		}
		return $users;
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
