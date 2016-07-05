<?php

use credits\Entities\User;
use credits\Entities\CreditRequest;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class cargar extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'cargar';

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
	private $data;

	public function fire()
	{
		$dir = $_SERVER['DOCUMENT_ROOT'] . "public/toUpload/";

		try {
			Excel::filter('chunk')->load($dir . 'data.xlsx')->chunk(250, function ($reader) {
				foreach($reader->toArray() as $data){
					$user = User::where('identification_card', $data['cedula'])->first();
					if(!$user){
						$user = User::create([
							'identification_card' => $data['cedula'],
							'name' => $data['nombre'],
							'user_name' => str_replace(' ', '.', $data['nombre']),
							'email' => $data['email'] ? $data['email'] : 'Sin registro',
							'address' => $data['direccion'] ? $data['direccion'] : 'Sin registro',
							'residency_city' => $data['ciudad'] ? $data['ciudad'] : 'Sin registro',
							'phone' => $data['tel1'] ? $data['tel1'] : 'Sin registro',
							'mobile_phone' => $data['tel2'] ? $data['tel2'] : 'Sin registro',
							'document_type' => 0,
							'roles_id' => 4
						]);
					}

					$credit = CreditRequest::where('user_id', intval($user->id))->first();

					if(!$credit){
						$c = new CreditRequest;
						$c->user_id = intval($user->id);
						$c->value = intval($data['limitecredito']);
						$c->state = 1;
						$c->location = 3;
						$c->responsible = 18;
						$c->save();
					}
					else{
						$credit->value = $data['limitecredito'];
						$credit->save();
					}
				}
			});

			echo $message = "El archivo  se ha guardado en la base de datos.";

		} catch(Exception $e){

			echo $message = "No se ha guardar . Intenta subirlo de nuevo.";
		}

		Mail::send('emails.excel', ['msn' => $message], function ($m) use($message){
			$m->to('sanruiz1003@gmail.com', 'Creditos Lilipink')->subject('Archivos actualizados');
		});

		array_map('unlink', glob($_SERVER['DOCUMENT_ROOT'] . "/toUpload/*"));
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('step', InputArgument::REQUIRED, 'Primer paso.'),
		);
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
