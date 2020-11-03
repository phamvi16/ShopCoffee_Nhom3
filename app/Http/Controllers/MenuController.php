<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategory;
use Session;
use App\Cart;
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
     public function show_menu($Id_Category){
        //  $all_product = Category::where('Id',$Id_Category)->ProductCategory->get();
        $all_category = Category::All();
        $all_product = Category::find($Id_Category)->product;
        // dd($cate->product);
        return view('pages.menu', compact('all_product','all_category'));

    }  
   public function search(Request $request){
        $keywords = $request->keywords_submit;

       $all_category = Category::All();
       $search_product = Product::where('Name', 'like', '%' .$keywords. '%')->get();

       return view('pages.search')->with('search_product',$search_product)->with('all_category', $all_category);
   }
}

