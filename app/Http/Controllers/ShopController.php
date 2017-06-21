<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

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

    	if($request->session()->has('cart')){
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
}
