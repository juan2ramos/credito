<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcceptCreditTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accept_credit',function($table)
		{
			$table->increments('id');
			$table->integer('data_monthly');
			$table->integer('value_monthly');
			$table->integer('data_credit');
			$table->integer('reference1');
			$table->integer('reference2');
			$table->integer('files');
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
		schema::drop('accept_credit');
	}

}
