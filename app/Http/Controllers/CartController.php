<?php
namespace App\Http\Controllers;
use DB;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Models\ProductSize;
use App\Models\Product;
use Cart;
use session_start;

use App\Services\CartService;

class CartController extends Controller
{

    public function show($id = null){
        $pro = Product::find($id);
        return ($pro != null) ?  view('pages.product-detail', compact('pro')) : abort(404);
    }
     public function gio_hang(Request $request){
      // dd(Session::get('cart'));
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
              'ice'=>100,
              'sugar'=>100,
              'hot'=>'',
              'topping'=>[
               ],
            
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
              'ice'=>100,
              'sugar'=>100,
              'hot'=>'',
              'topping'=>[
               ],
              
          );
          Session::put('cart',$cart);
      }
      Session::save();
      echo "Added";
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
            return redirect()->back()->with('message','delete falil');
        }
    }

    public function get_modal(Request $request)
    {
      // Get item in cart
      $cart_item = Session::get('cart')[$request->key];
      // Get all available sizes
      $all_pro_sizes = Product::find($cart_item['product_id'])->product_size->sortByDesc('Size');
      $data = array(
              'size_view' => view('../partials.modal-size', ["all_pro_sizes" => $all_pro_sizes, "product_size" => $cart_item["product_size"]])->render(),
              'topping_view' => view('../partials.modal-topping-view', ["session_toppings" => $cart_item['topping']])->render(),
              'item_total' => (new CartService())->getCartItemTotal($request->key),
              'cart_item' => $cart_item
          );
      echo json_encode($data);
    }

    public function update(Request $request)
    {
      $cartService = new CartService();
      // Update session
      $cartService->updateCartItem($request);
      // Get cart total
      $cart_total = $cartService->getCartTotal();
      // Get updated item
      $cart_item = Session::get('cart')[$request->item_key];
      $data = array(
              'item_view' => view('../partials.cart-item-view', ["item" => $cart_item, "cartkey" => $request->item_key])->render(),
              'key' => $request->item_key,
              'session' => Session::get('cart'),
              'cart_total' => $cart_total
          );
      echo json_encode($data);
    }
}