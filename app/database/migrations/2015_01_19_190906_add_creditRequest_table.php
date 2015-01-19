<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreditRequestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('creditRequest',function($table){
			$table->dropcolumn('type_document');
			$table->integer('document_type');
			$table->string('state');
			$table->boolean('notify');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('creditRequest',function($table){
			$table->dropColumn('document_type','state','notify');
		});
	}

}
