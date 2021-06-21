<?php


use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use illuminate\support\str;
use App\Product;
use App\Sector;
use App\Order;
use App\User;
use App\Category;

use App\Order_Product;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            "Surgelati",
            "Secchi",
            "Deperibili",
            "Pasta",
            "Salumi",
            "Sottoacet"
        ];
        $reperibile = [
            "0",
            "1",
            "1",
            "0",
            "1",
            "0"
        ];

        foreach ($category as $key => $value) {
            $newCategory = new Category;
            $newCategory->tipo = $value;
            $newCategory->reperibile = $reperibile[$key];
            $newCategory->save();
        }
    }
}
