<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDriveOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('drive_orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('customer_id')->unsigned()->index();
			$table->foreign('customer_id')->references('id')->on('customers');
			$table->integer('shop_id')->unsigned()->index();
			$table->foreign('shop_id')->references('id')->on('shops');
			$table->boolean('prepared')->default(false);
			$table->dateTime('date');
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('drive_order_lines', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('drive_order_id')->unsigned()->index();
			$table->foreign('drive_order_id')->references('id')->on('drive_orders');
			$table->integer('product_state_id')->unsigned()->index();
			$table->foreign('product_state_id')->references('id')->on('product_states');
			$table->integer('quantity');
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
		Schema::drop('drive_order_lines');
		Schema::drop('drive_orders');
	}

}
