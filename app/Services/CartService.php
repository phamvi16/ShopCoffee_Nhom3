<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Session;
use App\Models\ProductSize;
use App\Models\Topping;

/**
 * Class CartService
 */
class CartService
{
    /**
     * 
     */
    public function __construct(){}

    public function getCartTotal()
    {
    	$cart = Session::get('cart');
    	$total = 0;
    	if (!empty($cart)) {
    		foreach ($cart as $key => $value) {
    			$total += $this->getCartItemTotal($key);
    		}
    	}
    	return $total;
    }

    public function getCartItemTotal($key)
    {
    	$item = Session::get('cart')[$key];
    	$total = 0;
    	$total += $item['product_price'];
    	if (count($item['topping']) > 0){
			foreach ($item['topping'] as $id => $price) {
				$total += $price;
			}
		}
		return $total;
    }

    public function updateCartItem(Request $request)
    {
    	$cart_item = Session::get('cart')[$request->item_key];
    	$cart_item_toppings = $cart_item["topping"];
		$prod_size = ProductSize::find($request->product_size);
		$cart_item["product_price"] = $prod_size->Sale_Price;
		$cart_item["product_size"] = $prod_size->Size;
		$cart_item["ice"] = $request->Ice ?? 0;
		$cart_item["sugar"] = $request->Sugar;
		$cart_item["hot"] = $request->Hot ?? "";
		// Get id topping in request
		[$keys, $values] = Arr::divide($request->Topping);
		$topping_new_id = $values;
		// Get id topping in cart
		[$keys, $values] = Arr::divide($cart_item_toppings);
		$topping_old_id = $keys;
		// Get removed toppings
		$removedToppings = array_diff($topping_old_id, $topping_new_id);
		// Get added toppings
		$addedToppings = array_diff($topping_new_id, $topping_old_id);

		foreach ($removedToppings as $key => $value) {
			// Remove toppings
        	Arr::forget($cart_item_toppings, $value);
        }

        foreach ($addedToppings as $key => $value) {
        	// Add toppings
        	$cart_item_toppings[$value] = Topping::find($value)->Price;
        }
		// Store in session
		$cart_item["topping"] = $cart_item_toppings;
		// Save session
		Session::put("cart." . $request->item_key, $cart_item);
    }
}

