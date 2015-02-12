<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditRequestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('creditRequest',function($table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('notify');
			$table->string('state');
			$table->string('files');
			$table->string('name_reference');
			$table->integer('phone_reference');
			$table->string('name_reference2');
			$table->integer('phone_reference2');
			$table->integer('monthly_expenses');
			$table->integer('monthly_income');
			$table->string('office_address');
			$table->string('instead_expedition');
			$table->date('date_expedition');
			$table->integer('priority');
			$table->integer('location');
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
		Schema::drop('creditRequest');
	}

}
