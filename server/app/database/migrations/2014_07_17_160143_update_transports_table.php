<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateTransportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('transports', function(Blueprint $table)
		{
			$table->dropColumn('departure', 'arrival');
		});

		Schema::table('transports', function(Blueprint $table)
		{
			$table->integer('departure')->unsigned()->nullable()->index()->after('end');
			$table->foreign('departure')->references('id')->on('shops');

			$table->integer('arrival')->unsigned()->nullable()->index()->after('departure');
			$table->foreign('arrival')->references('id')->on('shops');

			$table->boolean('validated')->default(false);

			$table->softDeletes();
		});

		Schema::create('transport_lines', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('transport_id')->unsigned()->index();
			$table->foreign('transport_id')->references('id')->on('transports');
			$table->integer('product_id')->unsigned()->index();
			$table->foreign('product_id')->references('id')->on('products');
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
		Schema::drop('transport_lines');

		Schema::table('transports', function(Blueprint $table)
		{
			$table->dropForeign('transports_departure_foreign');
			$table->dropForeign('transports_arrival_foreign');
		});

		Schema::table('transports', function(Blueprint $table)
		{
			$table->dropColumn('departure');
			$table->dropColumn('arrival');
			$table->dropColumn('validated');
			$table->dropColumn('deleted_at');
		});

		Schema::table('transports', function(Blueprint $table)
		{
			$table->string('departure')->nullable();
			$table->string('arrival')->nullable();
		});
	}

}
