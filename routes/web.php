<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ToppingController;


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

Route::get('api/product/getall', function() {
    $data = DB::table('topping')->get();
    var_dump($data);
});

Route::get('/',[HomeController::class, 'index'] );
Route::get('/trang-chu', [HomeController::class, 'index']);
Route::get('/menu', [MenuController::class, 'index']);
Route::get('/lien-he', [ContactController::class,'index']);
Route::get('/dang-nhap', [LoginController::class, 'index']);
Route::get('/gio-hang', [CartController::class,'index']);
Route::get('/checkout', [CheckoutController::class,'index']);
Route::get('/product-detail/{id?}', [ProductController::class,'show']);



//Admin route group
Route::group(['prefix' => 'admin'], function(){
	Route::get('/', [AdminController::class, 'index']);

	//Category route group
	Route::group(['prefix' => 'category'], function(){
		Route::get('/', [CategoryController::class, 'index']);
		Route::get('/add', [CategoryController::class, 'add']);
		Route::post('/insert', [CategoryController::class, 'insert']);
		Route::get('/edit/{id}', [CategoryController::class, 'edit']);
		Route::put('/update', [CategoryController::class, 'update']);
	});

	//Product route group
	Route::group(['prefix' => 'product'], function(){
		Route::get('/', [ProductController::class, 'index']);
		Route::get('/create', [ProductController::class, 'create']);
		Route::post('/store', [ProductController::class, 'store']);
		Route::get('/edit/{id}', [ProductController::class, 'edit']);
		Route::put('/update', [ProductController::class, 'update']);
		Route::get('/show', [ProductController::class, 'show']);
		Route::get('/delete/{id}', [ProductController::class, 'delete']);
	});
	
	//Topping route group
	Route::group(['prefix' => 'topping'], function(){
		Route::get('/', [ToppingController::class, 'index']);
		Route::get('/add', [ToppingController::class, 'add']);
		Route::post('/insert', [ToppingController::class, 'insert']);
		Route::get('/edit/{id}', [ToppingController::class, 'edit']);
		Route::put('/update', [ToppingController::class, 'update']);
		Route::get('/delete/{id}', [ToppingController::class, 'delete']);
	});


	//Customer
	Route::get('/customer', [CustomerController::class, 'index']);

	//Order
    Route::get('/order', [OrderController::class, 'index']);
    
});
//show Product_category Menu
Route::get('/menu/{Id_Category}', [MenuController::class, 'show_menu']);
Route::get('/tim-kiem',[MenuController::class, 'search']);

// login and signup route
Route::get('/login', [LoginController::class, 'login']);
Route::post('/signup', [LoginController::class, 'SignUp']);

//checkout route
Route::post('/verify', [CheckoutController::class, 'Verify']);
Route::post('/processcheckout', [CheckoutController::class, 'Checkout']);

//Cart
Route::post('/add-cart', [CartController::class,'add_cart']);
Route::get('/gio-hang', [CartController::class,'gio_hang']);
Route::get('/del-pro-cart/{session_is}', [CartController::class,'del_product']);
Route::get('/show', [CartController::class, 'show']);






