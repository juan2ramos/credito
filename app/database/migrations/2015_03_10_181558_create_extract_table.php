<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtractTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('extracts',function($table)
		{
			$table->increments('id');
			$table->integer('nit');
			$table->integer('numero_documento');
			$table->date('fecha_contabilizacion');
			$table->string('punto_venta');
			$table->float('tasa_interes');
			$table->float('valor_compra');
			$table->float('cargos_abonos');
			$table->float('saldo_credito_diferido');
			$table->string('cuotas');
			$table->integer('dias_vencidos');
			$table->integer('saldo_sin_vencer');
			$table->integer('un_mes');
			$table->integer('dos_meses');
			$table->integer('tres_meses');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('extracts');
	}

}
