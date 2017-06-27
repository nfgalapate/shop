<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Receipt;
use App\Transaction;
use Auth;

class ShopController extends Controller
{
    //
    function index(Request $request){
    	$all_items = Item::all();

    	if($request->session()->has('cart')){
    		$cart = $request->session()->get('cart');
    	}else{
    		$cart = [];
    	}
    	

    	return view('shop.index',compact('all_items','cart'));
    }

    function add_to_cart(Request $request){
    	echo "Adding to cart";
    	echo " qty:" . $request->input('qty');
    	echo " item_id" . $request->input('id') ;

    	$item_id = $request->input('id');
    	$qty = $request->input('qty');

    	$cart[$item_id] =$qty;

    	if($request->session()->has('cart')){ //updating session variables
    		$cart = $request->session()->get('cart');
    		$cart[$item_id] =$qty;
    		$request->session()->put('cart',$cart);

    	}else{
    		$request->session()->put('cart',$cart);
    	}
    	


    	return redirect('/shop'); 
    }

    function remove_from_cart($item_id, Request $request){

    	if($request->session()->has('cart')){
    		$cart = $request->session()->get('cart');

    		unset($cart[$item_id]);
    		
    		$request->session()->put('cart',$cart);

    	}
    	return redirect('/shop'); 
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    function checkout(Request $request){
        $all_items = Item::all();

        if($request->session()->has('cart')){
            $cart = $request->session()->get('cart');

            if(count($cart)==0){
                return redirect('/shop');
            }
            //dd($cart); to be continued  
            $total = 0;
            foreach($all_items as $item){
                if(isset($cart[$item->id])){
                    echo "itemid:" .$item->id;
                    echo "<br>name:".$item->name;
                    echo "<br>price:".$item->price;
                    echo "<br>qty: " .$cart[$item->id];
                    echo "<hr>";
                    echo Auth::user()->id;

                    $total += $item->price * $cart[$item->id];
                }
            }   

            $receipt = new Receipt();
            $receipt->user_id = Auth::user()->id;
            $receipt->total = $total; 
            $receipt->save();     

            foreach($cart as $item_id => $qty){
                $transaction = new Transaction;
                $transaction->receipt_id = $receipt->id;
                $transaction->item_id = $item_id;
                $transaction->qty = $qty;
                $transaction->save();
            }

            //clear cart
            $request->session()->put('cart' , []);
        }
       // return redirect('/shop');
    }
}
