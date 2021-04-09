<?php

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
        
        
        foreach ($randomSectors as $sectors => $key) {
            $product = Product::inRandomOrder()->first();
            
            $newSector = new Sector;
            $newSector->products_id = $product->id;
            $newSector->codice_stock = $product->codice_stock;
            $newSector->settore = $key;
            $newSector->scaffale = $randomScaffale[$sectors];
            $newSector->quantita_rimanente = $faker->numberBetween(1, 50);
            $newSector->save();
        
        }


    }
}
