`<?php

class SuppliersTableSeeder extends Seeder {

    public function run()
    {
        Supplier::create(array(
            'name' => 'Premier fournisseur'
        ));

        Supplier::create(array(
            'name' => 'Second fournisseur'
        ));
    }

}