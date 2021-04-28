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

        $randomCodeProduct = [
            "1000020004000",
            "1200400050000",
            "1000000003000",
            "1000000002010",
            "1000201010050",
            "1020105002000",
            "1004002001020",
            "1002010020020",
            "1020304004550",
            "1020103500520",
            "1012320320303",

            
        ];
        $randomStockCode = [
            "4044155245103",
            "6151043278634",
            "0011007078345",
            "1060500002010",
            "1020201010050",
            "1020105602000",
            "1004002021020",
            "1002010020220",
            "1025504004550",
            "1020305500520",
            "1011132320303",

            
        ];
        for ($i=0; $i <10 ; $i++) { 
            $newProduct = new Product;
            $newProduct->codice_prodotto = $randomCodeProduct[$i];
            $newProduct->codice_stock = $randomStockCode[$i];
            $newProduct->lotto =  substr($randomStockCode[$i], -5);
            $newProduct->data_di_scadenza = $faker->date('Y-m-d');
            $newProduct->name = $faker->sentence(3);
            $newProduct->description = $faker->text(60);
            $newProduct->prezzo_al_pezzo = $faker->numberBetween(10, 50);
            $newProduct->prezzo_al_kg = $faker->numberBetween(10, 50);
            $newProduct->peso = $faker->numberBetween(1,15);

            $newProduct->save();
        }
    }
}
