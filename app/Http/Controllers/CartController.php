<?php
namespace App\Http\Controllers;
use DB;
use Session;
use App\Models\ProductSize;
use App\Models\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
     public function gio_hang(Request $request){
     // --seo
       return view('pages.cart');
     }
    // cách 1 fail:
    public function add_cart(Request $request){
    // Session::forget('cart');
      $data = $request->all();
      $session_id = substr(md5(microtime()),rand(0,26),5);
      $cart = Session::get('cart');
      if($cart==true){
          $is_avaiable = 0;
        //   foreach($cart as $key => $val){
        //       if($val['product_id']==$data['id']){
        //           $is_avaiable++;
        //       }
        //  }
          if($is_avaiable == 0){
              $cart[] = array(
              'session_id' => $session_id,
              'product_name' => $data['cart_product_name'],
              'product_id' => $data['cart_product_id'],
              'product_image' => $data['cart_product_image'],
              'product_price' => $data['cart_product_price'],
              'product_size' => $data['cart_product_size'],
              );
              Session::put('cart',$cart);    
          }
      }else{
          $cart[] = array(
              'session_id' => $session_id,
              'product_name' => $data['cart_product_name'],
              'product_id' => $data['cart_product_id'],
              'product_image' => $data['cart_product_image'],
              'product_price' => $data['cart_product_price'],  
              'product_size' => $data['cart_product_size'], 
          );
          Session::put('cart',$cart);
      }
      Session::save();
    // print_r($data);
    }
   public function del_product($session_id){
        $cart =Session::get('cart');
        if($cart==true){
            foreach($cart as $key =>$val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            session::put('cart',$cart);
            return redirect()->back()->with('message','delete successfully');
        }else{
            return redirect()->back()->with('message','delete fali');
        }
    }

}