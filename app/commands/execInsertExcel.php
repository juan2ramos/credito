<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class execInsertExcel extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'execInsertExcel';

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
        $dir = public_path('toUpload/extracts/');
        $files = scandir($dir);
        $command = "";
        for( $i = 0; $i < count($files); $i++){
            if(strpos($files[$i], '**extract**') !== false) {
                //shell_exec("cd " . base_path() . "; php artisan insert:excel " . $file . " > /dev/null & ");
                $command .= "php artisan insert:excel " . $files[$i] . " > /dev/null & ";
                $command .= $i < count($files) - 1 ? 'wait;' : '';
            }
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
