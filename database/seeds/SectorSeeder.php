$<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use illuminate\support\str;
use App\Product;
use App\Sector;
use App\Order;
use App\User;
use App\Order_Product;

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
        $products = Product::withoutEvents( function() {
            $products = Product::orderBy('id')->get();
            return $products;
        });

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
            // $newSector->codice_prodotto = $stockArray[$i];
            $newSector->settore = $key;
            $newSector->scaffale = $randomScaffale[$sectors];
            $newSector->quantita_di_cartoni = 5;
            $newSector->quantita_rimanente = 50;
            $newSector->quantita_a_cartone = 10;
            $newSector->quantita_bloccata = 0;
            $newSector->save();
            $i++;
            // $idSector = $newSector->id;
            // $appoggio = Sector::with('product')->inRandomOrder()->first();

            // $appoggioId = $appoggio->id;

            // $findOrder = Order_Product::find($appoggioId);
            
            // $quantitaOrder = $findOrder->quantita;
            // $orderId = $findOrder->product_id;
            // dd($orderId);

            // $sector = Sector::where('product_id', '=', $orderId)->firstOrFail();
            // $sector->quantita_bloccata =  $sector->quantita_bloccata + $quantitaOrder;
            // $sector->push();
        }
        // $appoggios = Sector::with('product')->get();
        // // dd($appoggios);
        // foreach ($appoggios as $appoggio) {
        //     $appoggioId = $appoggio->product->id;
        //     // dd($appoggioId);
        //     $findOrder = Order_Product::where('product_id', '=', $appoggioId)->first();
            

        //     if ($findOrder!=null) {
               

        //         $quantitaOrder = $findOrder->quantita;
        //         $orderId = $findOrder->product_id;
                
        //         $sector = Sector::where('product_id', '=', $orderId)->first();
        //         $sector->quantita_bloccata += $quantitaOrder;
        //         $sector->push();
        //     }
            

        // }



    }
}
