<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDriveOrderNumberDriveOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('drive_orders', function(Blueprint $table)
		{
			$table->string('reference');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('drive_orders', function(Blueprint $table)
		{
			$table->dropColumn('reference');
		});
	}

}
