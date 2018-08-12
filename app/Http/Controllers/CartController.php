<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
//use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
//session_start();
class CartController extends Controller
{
    public function add_to_cart(Request $req){
    	$quantity = $req->quantity;
    	$product_id = $req->product_id;
    	$product_info = DB::table('tbl_products')
    				->where('product_id',$product_id)
    				->first();

    	$data['quantity'] = $quantity;
    	$data['id'] = $product_info->product_id;
    	$data['name'] = $product_info->product_name;
    	$data['price'] = $product_info->product_price;
    	$data['options']['image'] = $product_info->product_image;

    	Cart::add($data);
    	return Redirect::to('/show-cart');
    }

    public function show_cart(){
    	$all_published_category = DB::table('tbl_category')
    							->where('publication_status',1)
    							->get();
    	$manage_product_category = view('pages.add_cart')
        ->with('all_published_category', $all_published_category);
        return view('layout')->with('pages.add_cart', $manage_product_category);
    }

    public function delete_cart($rowId){
    	Cart::update($rowId,0);
    	return Redirect::to('/show-cart');
    }
    public function update_cart(Request $req){
    	$quantity = $req->quantity;
    	$rowId = $req->rowId;

    	Cart::update($rowId,$quantity);
    	return Redirect::to('/show-cart');
    }
}
