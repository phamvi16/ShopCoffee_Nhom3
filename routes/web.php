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
Route::get('/product-detail/', [ProductController::class,'detail_pro']);



//Admin route group
Route::group(['prefix' => 'admin'], function(){
	Route::get('/', [AdminController::class, 'index']);
	//Category
	Route::get('/category', [CategoryController::class, 'index']);
	Route::get('/add-category', [CategoryController::class, 'add_cat']);
	Route::get('/edit-category', [CategoryController::class, 'edit_cat']);

	//Product route group
	Route::group(['prefix' => 'product'], function(){
		Route::get('/', [ProductController::class, 'index']);
		Route::get('/create', [ProductController::class, 'create']);
		Route::post('/store', [ProductController::class, 'store']);
		Route::get('/edit/{id}', [ProductController::class, 'edit']);
		Route::post('/update', [ProductController::class, 'update']);
		Route::get('/show', [ProductController::class, 'show']);
	});


	//Customer
	Route::get('/customer', [CustomerController::class, 'index']);

	//Order
    Route::get('/order', [OrderController::class, 'index']);

    //Topping
    Route::get('/topping', [ToppingController::class, 'index']);
});
//show Product_category Menu
Route::get('/menu/{{Id_Category}', [MenuController::class, 'show_menu']);





