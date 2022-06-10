<?php
use Illuminate\Support\Facades\Route;



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



/*home controller*/
Route::get('/', 'HomeController@index');
Route::get('/admin-dashboard', 'HomeController@getAdmin');
Route::get('/user-login', 'HomeController@getUserLogin');
Route::get('/user-sign_up', 'HomeController@getUserSignUp');
Route::get('/report/product', 'HomeController@getViewProduct');
Route::get('/report/order', 'HomeController@getReport');

Route::get('/user/contactus', 'HomeController@getContactus');
Route::post('/user/contactus', 'UserController@postContactus');
Route::get('/user/about', 'HomeController@getabout');
Route::post('/user/about', 'UserController@postabout');
Route::get('/user/privacy', 'HomeController@getprivacy');
Route::post('/user/privacy', 'UserController@postprivacy');

/*user controller*/
Route::post('/user/login', 'UserController@postLogin');
Route::get('/user/logout', 'UserController@getLogout');
Route::post('/user/contactus', 'UserController@postContactus');

Route::get('/admin/addproduct', 'ProductController@getAdd');
Route::post('/product/add','ProductController@postAdd');
Route::post('/product/upload', 'ProductController@anyUpload');
Route::get('/product/viewproduct', 'ProductController@getProducts');

/* Shop controller */ 
 Route::get('/product/shop', 'ShopController@getProductImage');
 
 Route::post('/user/signup', 'UserController@postSignup');
 
 /* Shop controller */ 
 Route::get('/product/shop', 'ShopController@getProductImage'); 
 
 /* Product Details */ 
 Route::get('/product/details', 'ShopController@getProductDetails');
 Route::post('/user/cities', 'UserCotroller@getCities');
 
 /*cart*/  
	Route::get('/cart', 'CartController@getIndex');
	Route::get('/cart/add', 'CartController@getAdd');
	Route::post('/cart/delete', 'CartController@postDelete');
	Route::get('/cart/edit', 'CartController@getEdit');
	
	Route::get('/order/address', 'OrderController@getAddress');
	Route::post('/order/add', 'OrderController@postAdd');
	Route::get('/order/returnurl/{orderid}', 'OrderController@returnurl');
	Route::get('/order/returnurl/{orderid}', 'OrderController@returnurl');
	
	Route::get('/user/myorder', 'OrderController@getMyOrder');
	Route::get('/order/view', 'OrderController@getOrders');
	
	
/*edit order*/  
Route::get('/product/edit', 'ProductController@getEdit');
 Route::post('/product/edit', 'ProductController@postEdit');
 Route::post('/product/delete-image', 'ProductController@postDeleteImage');
 
 Route::get('/user/profile', 'UserController@getProfile');
 Route::post('/user/edit', 'UserController@postEdit');
 /*contact us*/ 
Route::get('/admin/contact', 'HomeController@getContact');
Route::get('/users/userinfo', 'HomeController@getUser');
Route::get('/orderdetails', 'OrderController@getMyOrderDetails');
Route::get('/order/view_order_details', 'OrderController@getOrderDetails');
Route::get('/order/invoice', 'OrderController@getInvoice');

Route::get('/order/view_tracking_order', 'OrderController@getTrackingOrders');
 Route::get('/order/order_tracking', 'OrderController@getTrackingorderDetails');
 
 Route::post('/order/update-tracking-status', 'OrderController@postUpdateTrackingStatus');
 Route::post('/order/update-order-status', 'OrderController@postUpdateOrderStatus');