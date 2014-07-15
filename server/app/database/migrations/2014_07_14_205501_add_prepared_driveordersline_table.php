<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPreparedDriveOrdersLineTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('drive_order_lines', function(Blueprint $table)
		{
			$table->boolean('prepared')->default(false);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('drive_order_lines', function(Blueprint $table)
		{
			$table->dropColumn('prepared');
		});
	}

}
