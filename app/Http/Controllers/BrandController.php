<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class BrandController extends Controller
{
    public function index(){
        $this->AdminAuthCheck();
    	return view('admin.add_brand');
    }

    public function save_manufacture(Request $req){
    	$data = array();
    	$data['manufacture_id'] = $req->manufacture_id;
    	$data['manufacture_name'] = $req->manufacture_name;
    	$data['manufacture_description'] = $req->manufacture_description;
    	$data['publication_status'] = $req->publication_status;

    	DB::table('tbl_manufacture')->insert($data);
    	Session::put('message', 'Manufacture added successfully !!');
    	return Redirect::to('/addBrand');
    }

    public function all_manufacture(){

        $this->AdminAuthCheck();
    	$all_manufacture_info = DB::table('tbl_manufacture')->get();
    	//get() is used for display all data and first() is used for display first row's data...
    	$manage_manufacture = view('admin.all_brand')
    	->with('all_manufacture_info', $all_manufacture_info);
    	return view('admin_layout')->with('admin.all_brand', $manage_manufacture);

    	//return view('admin.all_category');
    }

    public function unactive_manufacture($manufacture_id){
    	DB::table('tbl_manufacture')->where('manufacture_id',$manufacture_id)
    							->update(['publication_status' => 0]);
    	Session::put('message', 'Manufacture deactive successfully !!');
    	return Redirect::to('/allBrand');
    }

    public function active_manufacture($manufacture_id){
    	DB::table('tbl_manufacture')->where('manufacture_id',$manufacture_id)
    							->update(['publication_status' => 1]);
    	Session::put('message', 'Manufacture active successfully !!');
    	return Redirect::to('/allBrand');
    }
    public function edit_manufacture($manufacture_id){
        $this->AdminAuthCheck();
    	$manufacture_info = DB::table('tbl_manufacture')
    						->where('manufacture_id',$manufacture_id)
    						->first();
    	$manufacture_info = view('admin.edit_manufacture')
    							->with('manufacture_info', $manufacture_info);
    	return view('admin_layout')->with('admin.edit_manufacture', $manufacture_info);
    	
    	//return view('admin.edit_category');
    }

    public function update_manufacture(Request $req, $manufacture_id){
    	$data = array();
    	$data['manufacture_name'] = $req->manufacture_name;
    	$data['manufacture_description'] = $req->manufacture_description;

    	DB::table('tbl_manufacture')->where('manufacture_id',$manufacture_id)
    							->update($data);

    	Session::put('message', 'Manufacture updated successfully !!');
    	return Redirect::to('/allBrand');
    }

    public function delete_manufacture($manufacture_id){
    	DB::table('tbl_manufacture')->where('manufacture_id',$manufacture_id)
    							->delete();

    	Session::put('message', 'Manufacture deleted successfully !!');
    	return Redirect::to('/allBrand');
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
