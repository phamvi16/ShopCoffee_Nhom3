<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategory;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;
class MenuController extends Controller
{

    public function index(){
        $all_category = Category::All();
     	$all_product = Product::All();
         return view('pages.menu', compact('all_product','all_category'));  
    
    }

     public function show_product($Id_Category){
     	
     	$all_product = Category::where('Id',$Id_Category)->product->get();
        return view('pages.menu', compact('all_product'));  
    }
}
