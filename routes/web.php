<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/inventory', 'InventoryController@index');
Route::post('/inventory/add','InventoryController@add_item');
Route::get('inventory/update/{item_id}','InventoryController@update_item');
Route::post('inventory/update/','InventoryController@save_update_item');
Route::get('inventory/delete/{item_id}','InventoryController@delete_item');

Route::get('/shop','ShopController@index');
Route::post('/shop', 'ShopController@add_to_cart');
Route::get('/shop/remove/{item_id}','ShopController@remove_from_cart');

Route::get('/checkout', 'ShopController@checkout');