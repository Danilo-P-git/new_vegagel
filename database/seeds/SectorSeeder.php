$<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use illuminate\support\str;
use App\Product;
use App\Sector;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $randomSectors = [
            "Area 1",
            "Area 2",
            "Area 3",
            "Area 4",
            "Area 5",
            "Area 6",
            "Area 7",
            "Area 8",
            "Area 9",
            "Area 10"
        ];
        $randomScaffale = [
            "scaffale 1",
            "scaffale 2",
            "scaffale 3",
            "scaffale 4",
            "scaffale 5",
            "scaffale 6",
            "scaffale 7",
            "scaffale 8",
            "scaffale 9",
            "scaffale 10"
        ];
        $products = Product::orderBy('id')->get();
        $idArray = array();
        $stockArray = array();
        foreach ($products as $product) {
            $elementId = $product['id'];
            $elementStock = $product['codice_stock'];
            array_push($idArray, $elementId);
            array_push($stockArray, $elementStock);

        }

        $i = 0;
        foreach ($randomSectors as $sectors => $key) {
            
            $newSector = new Sector;
            $newSector->product_id = $idArray[$i];
            $newSector->codice_stock = $stockArray[$i];
            $newSector->settore = $key;
            $newSector->scaffale = $randomScaffale[$sectors];
            $newSector->quantita_al_cartone = $faker->numberBetween(1,10);
            $newSector->quantita_rimanente = $faker->numberBetween(10, 50);
            $newSector->save();
            $i++;
        }


    }
}
