<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use illuminate\support\str;
use App\Product;
use App\Sector;
use App\Sale;
use App\User;
class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i <10 ; $i++) { 
            $product = Product::inRandomOrder()->first();
            $user = User::inRandomOrder()->first();
            $newSale = new Sale;
            $newSale->products_id = $product->id;
            $newSale->quantita = $faker->numberBetween(2,5);
            $newSale->users_id = $user->id;
            $newSale->save();
        }
    }
}
