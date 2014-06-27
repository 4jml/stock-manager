<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UsersTableSeeder');
		$this->call('ShopsTableSeeder');
		$this->call('ProductsTableSeeder');
		$this->call('SuppliersTableSeeder');
		$this->call('DriversTableSeeder');
		$this->call('VehiculesTableSeeder');
		$this->call('TransportsTableSeeder');
		$this->call('StocksTableSeeder');
		$this->call('StockLogsTableSeeder');
		$this->call('CentralStocksTableSeeder');
		$this->call('CentralStockLogsTableSeeder');
		$this->call('SectionsTableSeeder');
		$this->call('CategoriesTableSeeder');
	}

}