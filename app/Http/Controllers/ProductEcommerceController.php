<?php
  
namespace App\Http\Controllers;
  
use App\User;
use App\Order;
use App\Product;
use App\OrdersEcommerce;
use App\Order_Ecommerces;
use Illuminate\Http\Request;
use App\OrdersEcommerce_item;
use App\Order_Ecommerce_product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
  
class ProductEcommerceController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $users=User::all();
        $products = Product::all();
        return view('ecommerce.products', compact('products','users'));
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cart()
    {
        
        return view('ecommerce.cart');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart(Request $request, $id)
    {
        
        
        
        // dd($request->quantita_bloccata);
        
        $users=Auth::user();
        
        $products = Product::with('sector')->where('esaurito', '=', 0)->find($id);
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
            /* $products->sector->quantita_bloccata = $products->sector->quantita_bloccata + $cart[$id]['quantity']; */
            
        } else {
            $cart[$id] = [
                "id_product"=>$request->id,
                "name" => $products->name,
                "description"=>$products->description,
                "user" => $users->id,
                "quantity" => 1,
                "price" => $products->prezzo_al_pezzo,
                "lotto" => $products->codice_stock,
                "prezzoKg" => $products->prezzo_al_kg,
                "codice_prodotto" => $products->codice_prodotto,
                "data_di_consegna" => $request->data_di_consegna,
                "image" => $products->image,
                

            ];
            
        }
        
        
        /* dd($products->sector->quantita_bloccata); */
        
          
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function sendOrder(Request $request)
    {
        
        
        
        /* dd($request->quantity); */
        $users=Auth::user();
        $cart = session()->get('cart');
         
        $orderEcommerce = New Order_Ecommerces;
        $orderEcommerce->user_id = Auth::User()->id;
        $orderEcommerce->data_di_consegna = $request->data_di_consegna;
        /* $orderEcommerce->ecommerce = $request->zona; */
        $orderEcommerce->save();
        /* dd($orderEcommerce); */
        $idOrder=$orderEcommerce->id;
        /* dd($cart); */
        $quantity=0;
        foreach ($cart as $key){
            

            $orderProductEcommerce= New order_Ecommerce_product();
            $orderProductEcommerce->order_ecommerce_id = $idOrder;
            $orderProductEcommerce->product_id=$key['id_product'];
            $orderProductEcommerce->quantita=$request->quantity;
            $quantity += $updateQty=DB::table('sectors')->where('product_id', '=', $key['id_product'])->increment('quantita_bloccata', $request->quantity);
            $orderProductEcommerce->save();

        }
        
        
        

        /* dd($orderProductEcommerce); */

        

        //FINE SALVATAGGIO DATI NEL DB
        
        $request->session()->pull('cart', $cart);
        $request->session()->flash('message', 'Inserimento riuscito');
        
        
        
        // dd($products);
       return redirect()->back() ;
    }
}
