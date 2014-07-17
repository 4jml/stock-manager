<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateOrderLinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('order_lines', function(Blueprint $table)
		{
			$table->integer('product_id')->unsigned()->index()->after('order_id');
			$table->foreign('product_id')->references('id')->on('products');
		});
	}

}
