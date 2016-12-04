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
        $nUsers = User::where('roles_id', '>=', '4')->select('id', 'roles_id')->orderBy('id', 'DESC')->first()->id;
        $max = 10000;
        $nTimes = $nUsers / $max;
        $round = round($nTimes);

        $nTimes = $round < $nTimes
                ? $round + 1
                : $round;

        $command = '';
        for($i = 1, $from = 1, $to = 10000; $i <= $nTimes;){
            $command .= "php artisan download:excel " . $from ." " . $to . " usuarios" .$i . " > /dev/null &";
            $command .= $i == $nTimes - 1 ? 'wait;' : '';
            $i++;
            $from = $to + 1;
            $to = $max * $i;
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
