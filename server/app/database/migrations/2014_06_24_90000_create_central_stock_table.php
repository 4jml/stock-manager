<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCentralStockTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('central_stocks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id')->unsigned()->index()->unique();
			$table->foreign('product_id')->references('id')->on('products');
			$table->string('quantity');
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
		Schema::drop('central_stocks');
	}

}
