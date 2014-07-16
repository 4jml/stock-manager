<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCanceledDeliveredDriveOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('drive_orders', function(Blueprint $table)
		{
			$table->boolean('canceled')->default(false);
			$table->boolean('delivered')->default(false);
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
			$table->dropColumn('canceled');
			$table->dropColumn('delivered');
		});
	}

}
