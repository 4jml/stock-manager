<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateShopsAndProductsTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Update the shops table
		$columns = array(
			'`description` text',
			'`address` varchar(255)',
			'`zip` int',
			'`city` varchar(255)'
		);

		foreach ($columns as $column) {
			DB::statement('ALTER TABLE `shops` MODIFY ' . $column . ' null');
		}

		// Update the products table
		$columns = array(
			'`description` text null',
			'`price` decimal(8,2) not null',
			'`weight` decimal(6,3) not null'
		);

		foreach ($columns as $column) {
			DB::statement('ALTER TABLE `products` MODIFY ' . $column);
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Update the shops table
		$columns = array(
			'`description` text',
			'`address` varchar(255)',
			'`zip` int',
			'`city` varchar(255)'
		);

		foreach ($columns as $column) {
			DB::statement('ALTER TABLE `shops` MODIFY' . $column . ' not null');
		}

		// Update the products table
		$columns = array(
			'`description` varchar(255) not null',
			'`price` varchar(255) not null',
			'`weight` varchar(255) not null'
		);

		foreach ($columns as $column) {
			DB::statement('ALTER TABLE `products` MODIFY ' . $column);
		}
	}

}
