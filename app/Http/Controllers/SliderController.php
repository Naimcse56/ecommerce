<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class SliderController extends Controller
{
    public function index(){
        $this->AdminAuthCheck();
    	return view('admin.add_slider');
    }
    public function save_slider(Request $req){
    	$data = array();
    	$data['publication_status'] = $req->publication_status;

    	$image = $req->file('slider_image');
    	if ($image) {
    		$image_name = str_random(20);
    		$ext = strtolower($image->getClientOriginalExtension());
    		$image_full_name = $image_name.'.'.$ext;
    		$upload_path = 'slider/';
    		$image_url = $upload_path.$image_full_name;
    		$success = $image->move($upload_path,$image_full_name);
    		if ($success) {
    			$data['slider_image'] = $image_url;
    			DB::table('tbl_slider')->insert($data);
    			Session::put('message', 'Slider added successfully !');
    			return Redirect::to('/addSlider');
    		}
    	}
    	DB::table('tbl_slider')->insert($data);
    			Session::put('message', 'Slider added successfully without Image!');
    			return Redirect::to('/add_slider');
    }

    public function all_slider(){
        $this->AdminAuthCheck();
    	$all_slider_info = DB::table('tbl_slider')->get();
    							//echo "<pre>";
    							//print_r($all_slider_info);
    							//echo "</pre>";
    							//exit();
    	//get() is used for display all data and first() is used for display first row's data...
    	$manage_slider = view('admin.all_slider')
    	->with('all_slider_info', $all_slider_info);
    	return view('admin_layout')->with('admin.all_slider', $manage_slider);

    	//return view('admin.all_category');
    }

    public function unactive_slider($slider_id){
    	DB::table('tbl_slider')->where('slider_id',$slider_id)
    							->update(['publication_status' => 0]);
    	Session::put('message', 'Slider deactive successfully !!');
    	return Redirect::to('/allSlider');
    }

    public function active_slider($slider_id){
    	DB::table('tbl_slider')->where('slider_id',$slider_id)
    							->update(['publication_status' => 1]);
    	Session::put('message', 'Slider active successfully !!');
    	return Redirect::to('/allSlider');
    }

    public function delete_slider($slider_id){
    	DB::table('tbl_slider')->where('slider_id',$slider_id)
    							->delete();

    	Session::put('message', 'Slider deleted successfully !!');
    	return Redirect::to('/allSlider');
    }

    public function AdminAuthCheck(){
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return view('admin.dashboard');
        }else{
            return Redirect::to('/backend')->send();
        }
    }
}
