<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderTopping;
use App\Models\ProductSize;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\PaymentMethod;
use App\Models\Coupon;

use App\Models\CustomerAccount;
use App\Models\CustomerDetail;
use App\Models\CustomerShipping;
use App\Models\ShippingInformation;
use App\Models\Loyalty;

use App\Services\CustomerService;


class OrderService{
    public function InsertCheckout($data,Request $request){



            $ProcessCustomer = (new CustomerService())->InsertOrUpdate_FromView($request); // xong phan nay
            
            if($ProcessCustomer){
                
                $ProcessOrder = $this->InsertData_Checkout($data,$request->phone,$request->payment,$request->shipping,$request->coupon,$request->discount);
                if($ProcessOrder){
                    return 1;
                }
                else
                {
                    return "Xảy ra lỗi khi xác nhận hóa đơn! chúng tôi sẽ xử lý nhanh thôi!";
                }
            }
            else
            {
                return "Xảy ra lỗi khi nạp thông tin khách hàng! chúng tôi sẽ xử lý nhanh thôi!";
            }

    }
    public function InsertData_Checkout($data,$phone,$payment_method,$shipping_method,$coupon,$discount){
        $status ="Chờ Xử Lý";
        $customer_shipping = DB::table('shipping_information')->where('phone', $phone)->first();
        $total_quantity=0;
        if($shipping_method =="Giao Tận Nơi"){
            $total=15000;
        }
        else{
            $total=0;
        }
        foreach($data as $key =>$value){
            $total_quantity+=1;
            $total += $value['product_price'];
            

            //xet topping
            if(Count($value['topping']) == 0){
                continue;
            }
            else
            foreach($value['topping'] as $id => $gia){
                $total +=$gia;
            }
        }
        $total-=$discount;
        
        
        $point = floor($total/10000);

        $isSuccess_InsertOder = $this->Insert_OrderTable($customer_shipping->Id,$coupon,$payment_method,$shipping_method,$total_quantity,$total,$point,$status);
        if($isSuccess_InsertOder){
            $isSuccess_UpdatePoint = (new CustomerService)->UpdatePoint($point,$phone);
            if($isSuccess_UpdatePoint){
                return $this->Insert_OrderProduct($data,$isSuccess_InsertOder);
            }
            else{
                return 0;
            }
        }
        else{
            return 0;
        }
    }

    public function Insert_SingleRecord($phone)
    {

    }
    public function Insert_OrderTable($customer_shippingid,$coupon,$payment_method,$shipping_method,$total_quantity,$total,$point,$status){
        if($coupon==null){
            $coupon ="Default";
        }
        
        DB::beginTransaction();
        try{
            $newOrder = Order::create([
                'customer'=>$customer_shippingid,
                'coupon'=>$coupon,
                'payment_method'=>$payment_method,
                'shipping_method'=>$shipping_method,
                'total_quantity'=>$total_quantity,
                'total'=>$total,
                'point'=>$point,
                'status'=>$status
            ]);
            DB::commit();
            return $newOrder->Id;
        }
        catch(Exception $e){
            DB::rollBack();
            throw new Exception($e->getMessage());
            return 0;
        }
    }
    public function Insert_OrderProduct($data,$newOrderId){
        // $Order = Order::latest()->first(); // $isOder['Id'];
        DB::beginTransaction();
        try{
        foreach($data as $key => $product){
                $productsize = DB::table('product_size')->where('Size', $product['product_size'])->where('Id_product',$product['product_id'])->first();

                $newOrderProduct = OrderProduct::create([
                    'id_product_size'=>$productsize->Id,
                    'id_order'=>$newOrderId,
                    'price_buy'=>$productsize->Sale_Price
                ]);

                foreach($product['topping'] as $id_topping=>$price){
                    OrderTopping::create([
                        'id_order_product'=> $newOrderProduct->Id,
                        'id_topping'=>$id_topping,
                        'price_buy'=>$price
                    ]);
                }
                Attribute::create([
                    'id_order_product'=>$newOrderProduct->Id,
                    'sugar'=>$product['sugar'],
                    'ice'=>$product['ice'],
                    'hot'=>$product['hot']
                ]);
            }
            DB::commit();
            return 1;
        }
        catch(Exception $e){
            DB::rollBack();
            throw new Exception($e->getMessage());
            return 0;
        }
    }

    // Get order by Id
    public function get_order_by_id($id)
    {
        $orderInfo = Order::find($id);
        $customerInfo = (new CustomerService())->get_customer_shipping_by_id($orderInfo->Customer);

        $orderArr = [];
        // Customer Info
        $orderArr['CustomerName'] = $customerInfo['CustomerName'];
        $orderArr['CustomerPhone'] = $customerInfo['CustomerPhone'];
        $orderArr['ShippingName'] = $customerInfo['ShippingName'];
        $orderArr['ShippingAddress'] = $customerInfo['ShippingAddress'];

        // Order Info
        $orderArr['PaymentMethod'] = PaymentMethod::find($orderInfo->Payment_Method)->Name;
        $orderArr['ShippingMethod'] = $orderInfo->Shipping_Method;
        $orderArr['Coupon'] = $orderInfo->Coupon;
        $orderArr['OrderCreatedAt'] = $orderInfo->created_at;
        $orderArr['Total'] = $orderInfo->Total;
        $orderArr['Status'] = $orderInfo->Status;
        $orderArr['Id'] = $orderInfo->Id;
        $orderArr['Discount'] = $this->get_discount_price($orderInfo->Coupon, $this->get_order_products($orderInfo->Id)['orderOriginalPrice']);

        return $orderArr;
    }

    // Change order status
    public function update_order_status(Request $request)
    {
        $order = Order::find($request->id);
        DB::beginTransaction();
        try {
            $order->Status = $request->newStatus;
            $order->save();
            DB::commit();
            return true; //Success  
        } catch (Exception $e) {
            DB::rollback();
            return false; //Fail
        }
    }

    public function get_order_products($orderId)
    {
        $orderProducts = [];
        $orderTotal = 0;
        // Get all product of order $orderId
        $products = OrderProduct::where('Id_Order', '=', $orderId)->get();
        
        $count = 1;
        foreach ($products as $product) {
            $orderProductDetails = [];
            // Get id product size
            $idSize = $product->Id_Product_Size;
            // Get product info
            $orderProductDetails['Name'] = $this->get_product_name_by_id_size($idSize);
            $orderProductDetails['Size'] = ProductSize::find($idSize)->Size;
            $orderProductDetails['PriceBuy'] = $product->Price_Buy;
            $orderProductDetails['Toppings'] = $this->get_product_toppings_string($product->Id);
            $orderProductDetails['Attribute'] = $this->get_product_attribute_string($product->Id);
            $orderProductDetails['Total'] = $product->totalPrice;

            // Calculate order total price
            $orderTotal += $product->totalPrice;

            $orderProducts[$count++] = $orderProductDetails;
        }
        return [
            'orderProducts' => $orderProducts,
            'orderOriginalPrice' => $orderTotal
        ];
    }

    public function get_product_name_by_id_size($idSize)
    {
        //get product id
        $proId = ProductSize::find($idSize)->Id_Product;
        // Get name by id
        $productName = Product::find($proId)->Name;
        return $productName ?? "";
    }

    public function get_product_toppings($orderProductId)
    {
        $toppingRes = [];
        // Get toppings
        $toppings = OrderProduct::find($orderProductId)->topping;
        foreach ($toppings as $topping) {
            $toppingRes[$topping->Name] = $topping->Price;
        }
        return $toppingRes;
    }

    // Display toppings as string
    public function get_product_toppings_string($orderProductId)
    {
        // Get toppings
        $toppings = $this->get_product_toppings($orderProductId);
        $toppingStr = "";
        foreach ($toppings as $name => $price) {
            $toppingStr .= $name . ' (+' . number_format($price, 0, ',', '.') . ' đ) <br>';
        }
        if ($toppingStr == "") $toppingStr = "Không có topping";
        return $toppingStr;
    }

    public function get_attributes($orderProductId)
    {
        // Get attributes
        $attributes = OrderProduct::find($orderProductId)->attribute;
        $attributeRes = [];
        $attributeRes['Sugar'] = $attributes->Sugar;
        $attributeRes['Ice'] = $attributes->Ice;
        $attributeRes['Hot'] = $attributes->Hot;
        return $attributeRes;
    }

    // Display attributes as string
    public function get_product_attribute_string($orderProductId)
    {
        // Get id product size
        $idSize = OrderProduct::find($orderProductId)->Id_Product_Size;
        // Get size of product
        $size = ProductSize::find($idSize)->Size;
        $attStr = "";
        if ($size != "None") {
            // Only for products which have many size
            // Get all attributes of current product
            $attributes = $this->get_attributes($orderProductId);

            $count = count($attributes);

            foreach ($attributes as $name => $value) {
                if ($value != 0 || $value != "") {
                    // Not display comma at first attribute
                    $attStr .= ($count != count($attributes)) ? " + " : "";

                    // If attribute is hot then do not display word "hot"
                    $attStr .= (($value != "hot") ? $value . '% ' : "") . config('order.attributes.' . $name);
                } else {
                    $attStr .= ""   ;
                }
                $count--;
            }
        }
        else {
            $attStr = "Không có ghi chú";
        }
        return $attStr;
    }

    public function get_discount_price($coupon, $originalTotalPrice)
    {
        // Get coupon info
        $couponInfo = Coupon::find($coupon);
        $couponType = $couponInfo->Type;
        $discountValue = $couponInfo->Value;

        switch ($couponType) {
            case 'Percent':
                // Original price
                $discount = ($originalTotalPrice + 15000)* $discountValue /100;
                break;

            case 'Fixed':
                $discount = $discountValue;
                break;
            
            default:
                $discount = 0;
                break;
        }
        return $discount;
    }
}

?>