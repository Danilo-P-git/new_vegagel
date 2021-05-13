<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,

            ProductSeeder::class,
            SaleSeeder::class,
            SectorSeeder::class
            // Sale_productSeeder::class
        ]);


    }
}
