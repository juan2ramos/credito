<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use credits\Entities\User;

class execDownloadExcel extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'execDownloadExcel';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Ejecutar comando download:excel por secciones';

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
        $nUsers = User::where('roles_id', '>=', '4')->count();
        $nTimes = $nUsers / 10000;
        $round = round($nTimes);

        $nTimes = $round < $nTimes
                ? $round + 1
                : $round;

        $command = '';
        for($i = 1; $i <= $nTimes; $i++){
            $command .= "php artisan download:excel " . $i ." 10000 usuarios" .$i . " > /dev/null &";
            $command .= $i == $nTimes - 1 ? 'wait;' : '';
        }

        shell_exec("cd " . base_path() . "; " . $command);
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
