<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class ProductController extends Controller
{
    public function index(){
        $this->AdminAuthCheck();
    	return view('admin.add_product');
    }
    public function save_product(Request $req){
    	$data = array();
    	$data['product_name'] = $req->product_name;
    	$data['category_id'] = $req->category_id;
    	$data['manufacture_id'] = $req->manufacture_id;
    	$data['product_short_description'] = $req->product_short_description;
    	$data['product_long_description'] = $req->product_long_description;
    	$data['product_price'] = $req->product_price;
    	$data['product_size'] = $req->product_size;
    	$data['product_color'] = $req->product_color;
    	$data['publication_status'] = $req->publication_status;

    	$image = $req->file('product_image');
    	if ($image) {
    		$image_name = str_random(20);
    		$ext = strtolower($image->getClientOriginalExtension());
    		$image_full_name = $image_name.'.'.$ext;
    		$upload_path = 'image/';
    		$image_url = $upload_path.$image_full_name;
    		$success = $image->move($upload_path,$image_full_name);
    		if ($success) {
    			$data['product_image'] = $image_url;
    			DB::table('tbl_products')->insert($data);
    			Session::put('message', 'Product added successfully !');
    			return Redirect::to('/addProduct');
    		}
    	}
    	DB::table('tbl_products')->insert($data);
    			Session::put('message', 'Product added successfully without Image!');
    			return Redirect::to('/add_product');
    }

    public function all_product(){
        $this->AdminAuthCheck();
    	$all_product_info = DB::table('tbl_products')
    						->join('tbl_category','tbl_products.category_id', '=', 'tbl_category.category_id')
    						->join('tbl_manufacture','tbl_products.manufacture_id', '=', 'tbl_manufacture.manufacture_id')
    						->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
    						->get();
    							//echo "<pre>";
    							//print_r($all_product_info);
    							//echo "</pre>";
    							//exit();
    	//get() is used for display all data and first() is used for display first row's data...
    	$manage_product = view('admin.all_product')
    	->with('all_product_info', $all_product_info);
    	return view('admin_layout')->with('admin.all_product', $manage_product);

    	//return view('admin.all_category');
    }
    public function unactive_product($product_id){
    	DB::table('tbl_products')->where('product_id',$product_id)
    							->update(['publication_status' => 0]);
    	Session::put('message', 'Product deactive successfully !!');
    	return Redirect::to('/allProduct');
    }

    public function active_product($product_id){
    	DB::table('tbl_products')->where('product_id',$product_id)
    							->update(['publication_status' => 1]);
    	Session::put('message', 'Product active successfully !!');
    	return Redirect::to('/allProduct');
    }

    public function delete_product($product_id){
    	DB::table('tbl_products')->where('product_id',$product_id)
    							->delete();

    	Session::put('message', 'Product deleted successfully !!');
    	return Redirect::to('/allProduct');
    }



    //without login No page is acceseble
    public function AdminAuthCheck(){
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return view('admin.dashboard');
        }else{
            return Redirect::to('/backend')->send();
        }
    }
}
