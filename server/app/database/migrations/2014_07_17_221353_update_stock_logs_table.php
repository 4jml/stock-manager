<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateStockLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('drive_order_lines', function(Blueprint $table)
        {
            $table->integer('product_id')->unsigned()->index()->after('drive_order_id');
            $table->foreign('product_id')->references('id')->on('products');
        });

        DB::Statement('ALTER TABLE `stock_logs` CHANGE `transport_id` `transport_id` INT(10)  UNSIGNED  NULL;');
	}

}
