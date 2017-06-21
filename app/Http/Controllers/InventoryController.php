<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class InventoryController extends Controller
{
    //

	function index(){

		$all_items = Item::all();

		return view('inventory.index',compact('all_items'));
	}

	function add_item(Request $request){
		// echo "Adding item";
		// echo "Name:" . $request->input('name');
		// echo "Qty:" . $request->input('qty');
		// echo "Price:" . $request->input('price');

		$myitem = new Item();
		$myitem->name = $request->input('name');
		$myitem->qty = $request->input('qty');
		$myitem->price = $request->input('price');
		$myitem->save();

		// TO DO: Insert successful message
		return redirect('/inventory');
	}

	function update_item($item_id){

		$item = Item::find($item_id);

		return view('inventory.update',compact('item'));
	}

	function save_update_item(Request $request){
		$item_id = $request->input("id");
		$item = Item::find($item_id);

		$item->qty = $request->input('qty');
		$item->price = $request->input('price');
		$item->save();
		return redirect('/inventory');
	}
}
