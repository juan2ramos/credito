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
		Schema::table('creditRequest',function($table)
		{

			$table->integer('type_document');
			$table->integer('identificacion_card');
			$table->string('name');
			$table->string('second_name');
			$table->string('last_name');
			$table->string('second_last_name');
			$table->string('birth_city');
			$table->string('city_residency');
			$table->date('date_expedition');
			$table->string('instead_expedition');
			$table->date('date_birth');
			$table->integer('mobile_phone');
			$table->integer('phone');
			$table->string('address');
			$table->string('office_address');
			$table->integer('monthly_income');
			$table->integer('monthly_expenses');
			$table->string('name_reference');
			$table->integer('phone_reference');
			$table->string('name_reference2');
			$table->integer('phone_reference2');
			$table->string('files');

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
			$table->dropColumn('type_document');
			$table->dropColumn('identificacion_card');
			$table->dropColumn('name');
			$table->dropColumn('second_name');
			$table->dropColumn('last_name');
			$table->dropColumn('second_last_name');
			$table->dropColumn('birth_city');
			$table->dropColumn('city_residency');
			$table->dropColumn('date_expedition');
			$table->dropColumn('instead_expedition');
			$table->dropColumn('date_birth');
			$table->dropColumn('mobile_phone');
			$table->dropColumn('phone');
			$table->dropColumn('address');
			$table->dropColumn('office_address');
			$table->dropColumn('monthly_income');
			$table->dropColumn('monthly_expenses');
			$table->dropColumn('name_reference');
			$table->dropColumn('name_reference2');
			$table->dropColumn('phone_reference2');
			$table->dropColumn('files');
		});
	}

}
