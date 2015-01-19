<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropCreditRequest extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('creditRequest',function($table)
		{
			$table->dropColumn(array('name','second_name','last_name','second_last_name','mobile_phone','phone','address','document_type','identificacion_card','date_birth','city_residency','birth_city'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('creditRequest',function($table)
		{
			$table->drop('creditRequest');
		});
	}

}
