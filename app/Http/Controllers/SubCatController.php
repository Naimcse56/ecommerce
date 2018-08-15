<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class SubCatController extends Controller
{
    public function index(){
        $this->AdminAuthCheck();

    	return view('admin.add_sub_category');
    }


    public function save_sub_category(Request $req){
    	$data = array();
    	$data['category_id'] = $req->category_id;
    	$data['sub_category_name'] = $req->sub_category_name;
    	$data['category_id'] = $req->category_id;
    	$data['publication_status'] = $req->publication_status;

    	DB::table('tbl_sub_category')->insert($data);
    	Session::put('message', 'Sub Category added successfully !!');
    	return Redirect::to('/addSubCategory');
    }

    public function all_sub_category(){

        $this->AdminAuthCheck();
    	$all_sub_category_info = DB::table('tbl_sub_category')->get();
    	//get() is used for display all data and first() is used for display first row's data...
    	$manage_sub_category = view('admin.all_sub_category')
    	->with('all_sub_category_info', $all_sub_category_info);
    	return view('admin_layout')->with('admin.all_sub_category', $manage_sub_category);

    	//return view('admin.all_category');
    }

    public function unactive_subCat($id){
    	DB::table('tbl_sub_category')->where('id',$id)
    							->update(['publication_status' => 0]);
    	Session::put('message', 'Deactive successfully !!');
    	return Redirect::to('/allSubCategory');
    }

    public function active_subCat($id){
    	DB::table('tbl_sub_category')->where('id',$id)
    							->update(['publication_status' => 1]);
    	Session::put('message', 'Active successfully !!');
    	return Redirect::to('/allSubCategory');
    }

    public function delete_product($id){
    	DB::table('tbl_sub_category')->where('id',$id)
    							->delete();

    	Session::put('message', 'Deleted successfully !!');
    	return Redirect::to('/allSubCategory');
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
