<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class CheckoutController extends Controller
{
    public function login_checkout(){
    	return view('pages.customer_login');
    }
    public function customer_registration(Request $req){
    	$data = array();
    	$data['customer_name'] = $req->customer_name;
    	$data['customer_email'] = $req->customer_email;
    	$data['password'] = md5($req->password);
    	$data['mobile_number'] = $req->mobile_number;

    	$customer_id = DB::table('tbl_customer')
    				->insertGetId($data);

    	Session::put('customer_id',$customer_id);
    	Session::put('customer_name',$req->customer_name);
    	return Redirect::to('/checkout');

    }
    public function checkout(){
    	return view('pages.checkout');
    }

    public function save_shipping_details(Request $req){
    	$data = array();
    	$data['shipping_email'] = $req->shipping_email;
    	$data['shipping_fname'] = $req->shipping_fname;
    	$data['shipping_lname'] = $req->shipping_lname;
    	$data['shipping_address'] = $req->shipping_address;
    	$data['shipping_mobile'] = $req->shipping_mobile;
    	$data['shipping_city'] = $req->shipping_city;

    	//echo "<pre>";
    	//print_r($data);
    	//echo "</pre>";
    	$shipping_id = DB::table('tbl_shipping')
    				->insertGetId($data);

    	Session::put('shipping_id',$shipping_id);
    	return Redirect::to('/payment');
    }

    public function payment(){
        return view('pages.payment');
    }

    public function customer_login(Request $request){
    	$customer_email = $request->customer_email;
    	$password = md5($request->password);
    	$result = DB::table('tbl_customer')
    			->where('customer_email', $customer_email)
    			->where('password', $password)
    			->first();
    			if ($result) {
    				Session::put('customer_id', $result->customer_id);
    				return Redirect::to('/checkout');
    			}else{
    				Session::put('message', 'Email or Password Invalid');
    				return Redirect::to('/login-checkout');
    			}
    }

    public function customer_logout(){
    	//Session::put('admin_name',null);
    	//Session::put('admin_id', null);
    	Session::flush();
    	return Redirect::to('/');
    }


    public function order_place(Request $request)
    {
      $payment_gateway=$request->payment_method; //db er column er nam payment_method
      
      //echo $payment_gateway;
      // $total=Cart::total();
      // echo $total;
      
      $payment_data=array();
      $payment_data['payment_method']=$payment_gateway;
      $payment_data['payment_status']='pending';
      $payment_id=DB::table('tbl_payment')
             ->insertGetId($payment_data);//payment er nijer jei ID seta niye nilam
  
      $order_data=array();
      $order_data['customer_id']=Session::get('customer_id');
      $order_data['shipping_id']=Session::get('shipping_id');
      $order_data['payment_id']=$payment_id;
      $order_data['order_total']=Cart::total();
      $order_data['order_status']='0';
      $order_id=DB::table('tbl_order')
               ->insertGetId($order_data);
  
     $contents=Cart::content(); //content er data gula sob niye ashlam & loop er maddome pass kore dilam
     $order_details_data=array();
     foreach ($contents as  $v_content) 
     {
        $order_details_data['order_id']=$order_id;
        $order_details_data['product_id']=$v_content->id; //cart er moddhe just ID silo tai
        $order_details_data['product_name']=$v_content->name;
        $order_details_data['product_price']=$v_content->price;
        $order_details_data['product_sales_quantity']=$v_content->quantity;
        DB::table('tbl_order_details')
            ->insert($order_details_data);
     }
     if ($payment_gateway=='handcash') {
          
           Cart::destroy();
          return view('pages.handcash');
         
        
     }elseif ($payment_gateway=='card') {
   
      echo "card";
      
     }elseif($payment_gateway=='paypal'){
         echo "paypal";
     }else{
      echo "not selectd";
     }
    }


     public function manage_order()
    {
     $this->AdminAuthCheck();
      $all_order_info=DB::table('tbl_order')
                     ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
                     ->select('tbl_order.*','tbl_customer.customer_name')
                     ->get();
       $manage_order=view('admin.manage_order')
               ->with('all_order_info',$all_order_info);
       return view('admin_layout')
               ->with('admin.manage_order',$manage_order); 
    }
  public function view_order($order_id)
  {
    $this->AdminAuthCheck();
      $order_by_id=DB::table('tbl_order')
              ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
              ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
              ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
              ->select('tbl_order.*','tbl_order_details.*','tbl_shipping.*','tbl_customer.*')
              ->where('tbl_order.order_id',$order_id)
              ->get();
       $view_order=view('admin.view_order')
               ->with('order_by_id',$order_by_id);
       return view('admin_layout')
               ->with('admin.view_order',$view_order); 
                     // echo "<pre>";
                     //  print_r($order_by_id);
                     // echo "</pre>";
  }

  public function unactive_order($order_id){
      DB::table('tbl_order')->where('order_id',$order_id)
                  ->update(['order_status' => 0]);
      return Redirect::to('/manage-order');
    }

    public function active_order($order_id){
      DB::table('tbl_order')->where('order_id',$order_id)
                  ->update(['order_status' => 1]);
      return Redirect::to('/manage-order');
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
