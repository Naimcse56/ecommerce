<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Post;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
//session_start();

class HomeController extends Controller
{
    public function index(){
    	$all_published_product = DB::table('tbl_products')
    						->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
    						->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
    						->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
    						->limit(6) //limit(6) is used for display 6 product in each page
    						->where('tbl_products.publication_status', 1)
    						->get();
    	$manage_published_product = view('pages.homeContent')
    	->with('all_published_product', $all_published_product);
    	return view('layout')->with('pages.homeContent', $manage_published_product);
    	//return view('pages.homeContent');
    }

    public function showproduct_by_category($category_id){
        $product_by_category = DB::table('tbl_products')
                            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                            ->select('tbl_products.*','tbl_category.category_name')
                            ->limit(9) //limit(6) is used for display 6 product in each page
                            ->where('tbl_category.category_id', $category_id)
                            ->where('tbl_products.publication_status', 1)
                            ->get();
        $manage_product_by_category = view('pages.product_by_category')
        ->with('product_by_category', $product_by_category);
        return view('layout')->with('pages.product_by_category', $manage_product_by_category);
    }




    public function showproduct_by_subcategory($id){
        $product_by_subcategory = DB::table('tbl_products')
                            ->join('tbl_sub_category','tbl_products.id','=','tbl_sub_category.id')
                            ->select('tbl_products.*','tbl_sub_category.sub_category_name')
                            ->limit(9) //limit(6) is used for display 6 product in each page
                            ->where('tbl_sub_category.id', $id)
                            ->where('tbl_products.publication_status', 1)
                            ->get();
        $manage_product_by_subcategory = view('pages.product_by_subcategory')
        ->with('product_by_subcategory', $product_by_subcategory);
        return view('layout')->with('pages.product_by_subcategory', $manage_product_by_subcategory);
    }







    

    public function showproduct_by_manufacture($manufacture_id){
        $product_by_manufacture = DB::table('tbl_products')
                            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                            ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
                            ->select('tbl_products.*','tbl_category.category_name', 'tbl_manufacture.manufacture_name')
                            ->limit(9) //limit(6) is used for display 6 product in each page
                            ->where('tbl_manufacture.manufacture_id', $manufacture_id)
                            ->where('tbl_products.publication_status', 1)
                            ->get();

        $manage_product_by_manufacture = view('pages.product_by_manufacture')
        ->with('product_by_manufacture', $product_by_manufacture);
        return view('layout')->with('pages.product_by_manufacture', $manage_product_by_manufacture);
    }

    public function product_deatails_by_id($product_id){
        $product_by_details = DB::table('tbl_products')
                            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                            ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
                            ->join('tbl_comment','tbl_products.product_id','=','tbl_comment.product_id')
                            ->select('tbl_products.*','tbl_category.category_name', 'tbl_manufacture.manufacture_name','tbl_comment.product_comment','tbl_comment.com_name','tbl_comment.created_at')
                            ->limit(9) //limit(6) is used for display 6 product in each page
                            ->where('tbl_products.product_id', $product_id)
                            ->where('tbl_products.publication_status', 1)
                            ->first();
        $manage_product_by_details = view('pages.product_details')
        ->with('product_by_details', $product_by_details);
        return view('layout')->with('pages.product_details', $manage_product_by_details);
    }



    public function addcomment(Request $req){
        $data = array();
        $data['product_id'] = $req->product_id;
        $data['com_name'] = $req->com_name;
        $data['product_comment'] = $req->product_comment;

        DB::table('tbl_comment')->insert($data);
        //return view('pages.product_details');
        return Redirect::to('/');
    }
}


