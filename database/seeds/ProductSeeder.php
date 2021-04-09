<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use illuminate\support\str;
use App\Product;
use App\Sector;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i <10 ; $i++) { 
            $newProduct = new Product;
            $newProduct->codice_prodotto = $faker->numberBetween(10000, 30000);
            $newProduct->codice_stock = $faker->numberBetween(10000, 30000);
            $newProduct->data_di_scadenza = $faker->date('Y-m-d');
            $newProduct->name = $faker->sentence(3);
            $newProduct->description = $faker->text(60);
            $newProduct->costo = $faker->numberBetween(10, 50);
            $newProduct->save();
        }
    }
}
