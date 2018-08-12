<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class CategoryController extends Controller
{
    public function index(){
        $this->AdminAuthCheck();
    	return view('admin.add_category');
    }

    public function all_category(){

        $this->AdminAuthCheck();
    	$all_category_info = DB::table('tbl_category')->get();
    	//get() is used for display all data and first() is used for display first row's data...
    	$manage_category = view('admin.all_category')
    	->with('all_category_info', $all_category_info);
    	return view('admin_layout')->with('admin.all_category', $manage_category);

    	//return view('admin.all_category');
    }

    public function save_category(Request $req){
    	$data = array();
    	$data['category_id'] = $req->category_id;
    	$data['category_name'] = $req->category_name;
    	$data['category_description'] = $req->category_description;
    	$data['publication_status'] = $req->publication_status;

    	DB::table('tbl_category')->insert($data);
    	Session::put('message', 'Category added successfully !!');
    	return Redirect::to('/addCategory');
    }

    public function unactive_category($category_id){
    	DB::table('tbl_category')->where('category_id',$category_id)
    							->update(['publication_status' => 0]);
    	Session::put('message', 'Category deactive successfully !!');
    	return Redirect::to('/allCategory');
    }

    public function active_category($category_id){
    	DB::table('tbl_category')->where('category_id',$category_id)
    							->update(['publication_status' => 1]);
    	Session::put('message', 'Category active successfully !!');
    	return Redirect::to('/allCategory');
    }

    public function edit_category($category_id){
        $this->AdminAuthCheck();
    	$category_info = DB::table('tbl_category')
    						->where('category_id',$category_id)
    						->first();
    	$category_info = view('admin.edit_category')
    							->with('category_info', $category_info);
    	return view('admin_layout')->with('admin.edit_category', $category_info);
    	
    	//return view('admin.edit_category');
    }

    public function update_category(Request $req, $category_id){
    	$data = array();
    	$data['category_name'] = $req->category_name;
    	$data['category_description'] = $req->category_description;

    	DB::table('tbl_category')->where('category_id',$category_id)
    							->update($data);

    	Session::put('message', 'Category updated successfully !!');
    	return Redirect::to('/allCategory');
    }

    public function delete_category($category_id){
    	DB::table('tbl_category')->where('category_id',$category_id)
    							->delete();

    	Session::put('message', 'Category deleted successfully !!');
    	return Redirect::to('/allCategory');
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
