<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductStatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_states', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('description')->nullable();
			$table->decimal('price', 8, 2);
			$table->decimal('weight', 6, 3);
			$table->string('barcode');
		});

		Schema::table('products', function(Blueprint $table) {
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('ALTER TABLE `products` DROP `deleted_at`');
		Schema::drop('product_states');
	}

}
