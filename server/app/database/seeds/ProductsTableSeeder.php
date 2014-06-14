`<?php

class ProductsTableSeeder extends Seeder {

    public function run()
    {
        Product::create(array(
            'name' => 'Premier produit',
            'description' => 'Description du premier produit',
            'price' => 45,
            'weight' => 1.2,
            'barcode' => 'c0a96aa1622ac282126709095eefa8bf'
        ));

        Product::create(array(
            'name' => 'Second produit',
            'description' => 'Description du second produit',
            'price' => 29.99,
            'weight' => 2.6,
            'barcode' => 'f1972a094bf65111c8d644b86d5e7b7b'
        ));
    }

}