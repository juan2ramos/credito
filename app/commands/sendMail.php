<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

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
		$users = \credits\Entities\User::whereRaw('roles_id = 5 and hasCredit = 0 and user_state = 1')->get();
		foreach($users as $user){
			$email = $user->email;
			Mail::send('emails.ESimpleAccept', ['msn' => 'prueba'], function ($m) use($email){
				$m->to($email, 'Creditos Lilipink')->subject('Notificación Lilipink');
			});
		}

		Mail::send('emails.ESimpleAccept', ['msn' => 'prueba'], function ($m){
			$m->to('sanruiz1003@gmail.com', 'Creditos Lilipink')->subject('Notificación Lilipink');
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
