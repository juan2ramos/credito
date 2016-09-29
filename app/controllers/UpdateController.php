<?php

class UpdateController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /update
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('back.steps');
	}

	public function update(){
		$request = Input::all();
		$file = Input::file('file');
		$shell = '';
		array_map('unlink', glob($_SERVER['DOCUMENT_ROOT'] . "/toUpload/*"));
		$this->insertExcel($file, 'data');

			if($request['step'] == 1) $shell = 'one';
		elseif($request['step'] == 2) $shell = 'two';
		elseif($request['step'] == 3) $shell = 'three';
		elseif($request['step'] == 4) $shell = 'four';
		
		shell_exec("cd " . $_SERVER['DOCUMENT_ROOT'] . "; cd ..; php artisan cargar " . $shell . " > /dev/null &");
		return Redirect::back();
	}

	private function insertExcel($file, $name){
		$folder = $_SERVER['DOCUMENT_ROOT'] . "/toUpload";
		if(!is_dir($folder)) mkdir($folder, 0777, true);

		$fileName = $name . "." .  $file->getClientOriginalExtension();
		$file->move($folder, $fileName);
	}
}
