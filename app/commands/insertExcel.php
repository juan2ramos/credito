<?php

use credits\Entities\Extract;
use credits\Entities\ExcelDaily;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class insertExcel extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'insert:excel';

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
        $doc = 'extractos';
        $dir = null;
        $message = null;

        try{
            if($this->argument('table') == 'extracts'){
                $dir = public_path('toUpload/extracts/');
                foreach (scandir($dir) as $file){
                    if(strpos($file, '**extract**') !== false) {
                        Excel::filter('chunk')->load($dir . $file)->chunk(250, function ($reader) {
                            Extract::insert($this->validate($reader));
                        });
                        unlink($dir . $file);
                    }
                }

            } else {
                $dir = base_path() . "/public/toUpload/";
                $doc = $this->argument('table') . '.xlsx';

                Excel::filter('chunk')->load($dir . $doc)->chunk(250, function ($reader) {
                    if($this->argument('table') == 'extracts')
                        Extract::insert($this->validate($reader));
                    else
                        ExcelDaily::insert($this->validate($reader));
                });
            }

            $message = "El archivo " . $doc . " se ha guardado en la base de datos.";

        } catch (Exception $e){

            $message = "No se ha guardado " . $doc . ". Intenta subirlo de nuevo.";
        }


        Mail::send('emails.excel', ['msn' => $message], function ($m) use($message){
            $m->to('sanruiz1003@gmail.com', 'Creditos Lilipink')->subject('Notificación Lilipink');
        });

        Mail::send('emails.excel', ['msn' => $message], function ($m) use($message){
            $m->to('carterainnova@innova-quality.com.co', 'Creditos Lilipink')->subject('Notificación Lilipink');
        });

        $dir = [public_path('toUpload/extracts/'), public_path('toUpload/')];
        $this->cleanDirectory($dir[0]);
        $this->cleanDirectory($dir[1]);
	}

	private function validate($reader){
		$dataReader = $reader->toArray();
		foreach($dataReader as $key => $data){
			unset($dataReader[$key]['0']);
		}
		return $dataReader;
	}

    private function cleanDirectory($dir){
        foreach (scandir($dir) as $file){
            if($file !== '.' && $file !== '..' && strpos($file, '.') !== false)
                unlink($dir . $file);
        }
    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [['table', InputArgument::REQUIRED, 'Tabla a la que se va a agregar.']];
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
