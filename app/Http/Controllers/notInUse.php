<?php

namespace App\Http\Controllers;
use App\Product;
use App\Sector;
use App\Order;
use App\Order_Product;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class Cart {
    private $items;
    private $total;
    public function __construct() {
        $this->items = [];
        $this->total = 0.00;
    }

    public function emptyCart() {
        $this->items = [];
        $this->total = 0.00;
    }

    // metodi getter e setter per l’array di prodotti nel carrello
    public function setItems($items) {
        $this->items = $items;
    }
    public function getItems() {
        $items = [];
        if($this->hasItems()) {
            foreach($this->items as $item) {
                $items[] = [
                        'id' => $item['id'],
                        'name' => $item['name'],
                        'description' => $item['description'],
                        'price' => $item['price'],
                        'manufacturer' => $item['manufacturer'],
                        'image' => $item['image'],
                        'quantity' => $item['quantity'],
                        'subtotal' => $item['subtotal'],
                        'slug' => $item['slug']
                ];
            }
        }
        return $items;
    } 
    //METODI PER IL TOTALE
    public function setTotal($value) {
        $this->total = $value;
    }

    public function getTotal() {
            return $this->total;
    }

    //aggiornamento del carrello

    public function updateCart(Product $product, $quantity) {
        if($this->hasItems()) {
            foreach($this->items as $item)  {
                if($product->id == $item['id']) {
                    $item['quantity'] = $quantity;
                    $item['subtotal'] = ($product->price * $quantity);
                    $this->calculateTotal();
                }
            }
        }
    }

    //rimozione prodotti dal carrello

    public function removeFromCart(Product $product) {
        if($this->hasItems()) {
            $i = -1;
            foreach($this->items as $item) {
                $i++;
                if($product->id == $item['id']) {
                    unset($this->items[$i]);
                    $this->calculateTotal();
                }
            }
        }
    }

    // aggiungi al carrello Se la quantità non è valida o il prodotto è già presente l’operazione viene annullata.
    public function addToCart(Product $product, $quantity) {
        if($quantity < 1 || $this->isInCart($product)) {
            return;
        }
        $item = [
            'id' => $product->id,
            'name' => $product->title,
            'description' => $product->description,
            'price' => $product->price,
            'manufacturer' => $product->manufacturer,
            'image' => $product->image,
            'quantity' => $quantity,
            'subtotal' => ($product->price * $quantity),
            'slug' => $product->slug
        ];
        $this->items[] = $item;
        $this->calculateTotal();
    }


    //verifica prodotto duplicato su carrello

    private function isInCart(Product $product) {
        if( $this->hasItems()) {
           foreach( $this->items as $item ) {
               if($item['id'] == $product->id) {
                   return true;
               }
           }
           return false;
        } else {
            return false;
        }
    }

    //somma di tutti i totali parziali

    private function calculateTotal() {
        $this->total = 0.00;
        if($this->hasItems()) {
            $tot = 0.00;
            foreach($this->items as $item) {
                $tot += $item['subtotal'];
            }
            $this->total = $tot;
        }
    }

    // verifica effettivo riempimento del carrello 

    private function hasItems() {
        return ( count( $this->items ) > 0 );
    }

    //aggiunta di un prodotto al carrello. Il client invia l’ID del prodotto e la quantità selezionata ed il metodo del nostro controller delle route dedicate al carrello effettua l’operazione

    public function add(Request $request, $id = '0')
    {
        $product_id = $id;
        $quantity = 1;
        if ($request->has(['id', 'quantity'])) {
            $product_id = $request->input('id');
            $quantity = (int) $request->input('quantity');
        }
        $product = Product::find($product_id);
        if(is_null($product)) {
            return redirect()->route('home');
        }
        $cart = new Cart();
        $sessionCart = $request->session()->get('cart');
        if(!$sessionCart) {
            $cart->addToCart($product, $quantity);
            $request->session()->put(['cart' => ['items' => $cart->getItems(), 'total' => $cart->getTotal()]]);
        } else {
            $cart->setItems($sessionCart['items']);
            $cart->setTotal($sessionCart['total']);
            $cart->addToCart($product, $quantity);
            $request->session()->put(['cart' => ['items' => $cart->getItems(), 'total' => $cart->getTotal()]]);
        }
        return redirect()->route('cart');
        //dall’implementazione di questo metodo, prima viene effettuata l’operazione in memoria tramite i metodi del controller Cart e solo in un secondo momento i dati vengono salvati e sincronizzati con la sessione tramite i metodi dell’oggetto session()

        //Il metodo funziona in due modalità: l’aggiunta al carrello dall’elenco dei prodotti (con quantità fissa pari a 1) e l’aggiunta con quantità variabile dalla pagina del singolo prodotto. In entrambi i casi il client passa l’ID del prodotto in modo che Laravel reperisca il dato tramite il metodo find() del modello.


        
    }
    
    //Il funzionamento del metodo che rimuove un prodotto dal carrello è analogo nel design ma con esito opposto.
    public function cartRemove(Request $request)
    {
        $id = (int) $request->input('id');
        $product = Product::find($id);
        $cart = new Cart();
        $sessionCart = $request->session()->get('cart');
        $cart->setItems($sessionCart['items']);
        $cart->setTotal($sessionCart['total']);
        $cart->removeFromCart($product);
        $request->session()->put(['cart' => ['items' => $cart->getItems(), 'total' => $cart->getTotal()]]);
        return redirect()->route('cart');
        //Come sempre, viene istanziata la classe Cart, vengono impostati i suoi dati prendendoli da quelli presenti nella sessione corrente e quindi viene invocato il suo metodo specifico per la rimozione di un prodotto dal carrello. Infine vengono nuovamente sincronizzati i dati del carrello con quelli presenti in sessione.
    }
    
    //L’aggiornamento del carrello non è altro che la terza applicazione della nostra logica di lettura/scrittura/sincronizzazione.
    public function cartUpdate(Request $request)
    {
        $qty = $request->input('qty');
        $parts = explode(',', $qty);
        $cart = new Cart();
        $sessionCart = $request->session()->get('cart');
        $cart->setItems($sessionCart['items']);
        $cart->setTotal($sessionCart['total']);
        foreach($parts as $part) {
            $qtys = explode('-', $part);
            $id = (int) $qtys[0];
            $quantity = (int) $qtys[1];
            $product = Product::find($id);
            $cart->updateCart($product, $quantity);
        }
        $request->session()->put(['cart' => ['items' => $cart->getItems(), 'total' => $cart->getTotal()]]);
        return redirect()->route('cart');
    }





    
}
