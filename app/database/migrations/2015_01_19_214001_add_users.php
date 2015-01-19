<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users',function($table)
		{
			$table->string('second_name');
			$table->string('second_last_name');
			$table->string('address');
			$table->string('residency_city');
			$table->string('birth_city');
			$table->integer('mobile_phone');
			$table->integer('phone');
			$table->integer('document_type');
			$table->integer('identification_card');
			$table->date('date_birth');
		}
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users',function($table)
	{
		$table->drop('users');
	});
	}

}
