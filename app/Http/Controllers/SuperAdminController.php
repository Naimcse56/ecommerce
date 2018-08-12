<?php

namespace App\Http\Controllers;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    
    public function index(){
    	$this->AdminAuthCheck();
    	return view('admin.dashboard');
    }

    public function logout(){
    	//Session::put('admin_name',null);
    	//Session::put('admin_id', null);
    	Session::flush();
    	return Redirect::to('/backend');
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
