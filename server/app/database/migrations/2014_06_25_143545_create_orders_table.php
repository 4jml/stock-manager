<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('supplier_id')->unsigned()->index();
			$table->foreign('supplier_id')->references('id')->on('suppliers');
			$table->boolean('validated')->default(false);
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('order_lines', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('order_id')->unsigned()->index();
			$table->foreign('order_id')->references('id')->on('orders');
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
		Schema::drop('order_lines');
		Schema::drop('orders');
	}

}
