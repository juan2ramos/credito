<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreditRequest extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('creditRequest',function($table)
		{
			$table->dropColumn(array('cedula','ciudad_residencia','fecha_expedicion','fecha_nacimiento','lugar_expedicion','celular','telefono','direccion','direccion_oficina','archivo','tipo_documento','referencia','valor_mensual'));

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('creditRequest');
	}

}
