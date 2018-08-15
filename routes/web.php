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

Route::post('/addcomment','HomeController@addcomment');



//Front-End Route------------------------------------
Route::get('/', 'HomeController@index');

//Show Category wise product----------------
Route::get('/showproduct_by_category/{category_id}', 'HomeController@showproduct_by_category');
Route::get('/showproduct_by_manufacture/{manufacture_id}', 'HomeController@showproduct_by_manufacture');
Route::get('/view_product/{product_id}', 'HomeController@product_deatails_by_id');
Route::post('/add-to-cart', 'CartController@add_to_cart');
Route::get('/show-cart', 'CartController@show_cart');
Route::get('/delete-cart/{rowId}', 'CartController@delete_cart');
Route::post('/update-cart', 'CartController@update_cart');


//Checkout routes are here-------------------
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::post('/customer-registration','CheckoutController@customer_registration');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save-shipping-details','CheckoutController@save_shipping_details');
Route::get('/customer-logout','CheckoutController@customer_logout');
Route::post('/customer-login','CheckoutController@customer_login');

//Payment routes are here-------------------
Route::get('/payment','CheckoutController@payment');
Route::post('/order_place','CheckoutController@order_place');




//Back-End Route-----------------------------
Route::get('/backend', 'AdminController@index');
Route::get('/dashboard', 'SuperAdminController@index');
Route::post('/admin_dashboard', 'AdminController@Dashboard');
Route::get('/logout','SuperAdminController@logout');

//Category Related Route-----------------------------
Route::get('/addCategory','CategoryController@index');
Route::get('/allCategory','CategoryController@all_category');
Route::post('/save-category','CategoryController@save_category');
Route::get('/edit_category/{category_id}','CategoryController@edit_category');
Route::post('/update_category/{category_id}','CategoryController@update_category');
Route::get('/delete_category/{category_id}','CategoryController@delete_category');
Route::get('/unactive_category/{category_id}','CategoryController@unactive_category');
Route::get('/active_category/{category_id}','CategoryController@active_category');

//Sub Category Related Route-----------------------------
Route::get('/addSubCategory','SubCatController@index');
Route::get('/allSubCategory','SubCatController@all_sub_category');
Route::post('/save-Sub_Category','SubCatController@save_sub_category');
Route::get('/delete_subCat/{id}','SubCatController@delete_subCat');
Route::get('/unactive_subCat/{id}','SubCatController@unactive_subCat');
Route::get('/active_subCat/{id}','SubCatController@active_subCat');

Route::get('/showproduct_by_subcategory/{id}', 'HomeController@showproduct_by_subcategory');


//Brand Related Route-----------------------------
Route::get('/addBrand','BrandController@index');
Route::get('/allBrand','BrandController@all_manufacture');
Route::post('/save-manufacture','BrandController@save_manufacture');
Route::get('/unactive_manufacture/{manufacture_id}','BrandController@unactive_manufacture');
Route::get('/active_manufacture/{manufacture_id}','BrandController@active_manufacture');
Route::get('/edit_manufacture/{manufacture_id}','BrandController@edit_manufacture');
Route::post('/update_manufacture/{manufacture_id}','BrandController@update_manufacture');
Route::get('/delete_manufacture/{manufacture_id}','BrandController@delete_manufacture');

//Product Related Route-----------------------------
Route::get('/addProduct','ProductController@index');
Route::post('/save-product','ProductController@save_product');
Route::get('/allProduct','ProductController@all_product');
Route::get('/unactive_product/{product_id}','ProductController@unactive_product');
Route::get('/active_product/{product_id}','ProductController@active_product');
Route::get('/delete_product/{product_id}','ProductController@delete_product');

//Slider Related Route-----------------------------
Route::get('/addSlider','SliderController@index');
Route::post('/save-slider','SliderController@save_slider');
Route::get('/allSlider','SliderController@all_slider');
Route::get('/unactive_slider/{slider_id}','SliderController@unactive_slider');
Route::get('/active_slider/{slider_id}','SliderController@active_slider');
Route::get('/delete_slider/{slider_id}','SliderController@delete_slider');

//Manage Order Related Routes-------------------
Route::get('/manage-order','CheckoutController@manage_order');
Route::get('/view-order/{order_id}','CheckoutController@view_order');
Route::get('/unactive/{order_id}','CheckoutController@unactive_order');
Route::get('/active/{order_id}','CheckoutController@active_order');