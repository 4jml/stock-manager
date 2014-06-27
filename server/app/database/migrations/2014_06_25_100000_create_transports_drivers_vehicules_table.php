<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransportsDriversVehiculesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('drivers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('lastname');
			$table->string('firstname');
		});

		Schema::create('vehicules', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('make');
			$table->string('model');
			$table->string('plate');
		});

		Schema::create('transports', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('driver_id')->unsigned()->index();
			$table->foreign('driver_id')->references('id')->on('drivers');
			$table->integer('vehicule_id')->unsigned()->index();
			$table->foreign('vehicule_id')->references('id')->on('vehicules');
			$table->datetime('start')->nullable();
			$table->datetime('end')->nullable();
			$table->string('departure')->nullable();
			$table->string('arrival')->nullable();
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
		Schema::drop('transports');
		Schema::drop('drivers');
		Schema::drop('vehicules');
	}

}
