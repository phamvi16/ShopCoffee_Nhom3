<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderTopping;
use App\Models\ProductSize;
use App\Models\Attribute;

use App\Models\CustomerAccount;
use App\Models\CustomerDetail;
use App\Models\CustomerShipping;
use App\Models\ShippingInformation;
use App\Models\Loyalty;

use App\Services\CustomerService;
use Illuminate\Support\Facades\DB;

class OrderService{
    public function InsertCheckout($data,Request $request){



            $ProcessCustomer = (new CustomerService())->InsertOrUpdate_FromView($request); // xong phan nay

            if($ProcessCustomer){
                $ProcessOrder = $this->InsertData_Checkout($data,$request->phone,$request->payment,$request->shipping);
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
    public function InsertData_Checkout($data,$phone,$payment_method,$shipping_method){
        $status ="Chờ Xử Lý";
        $customer_shipping = DB::table('shipping_information')->where('phone', $phone)->first();
        $coupon = "1";
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
        
        $point = floor($total/10000);

        $isSuccess_InsertOder = $this->Insert_OrderTable($customer_shipping->Id,$coupon,$payment_method,$shipping_method,$total_quantity,$total,$point,$status);
        if($isSuccess_InsertOder){
            $isSuccess_UpdatePoint = (new CustomerService)->UpdatePoint($point,$phone);
            if($isSuccess_UpdatePoint){
                return $this->Insert_OrderProduct($data);
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
        
        DB::beginTransaction();
        try{
            Order::create([
                'customer'=>$customer_shippingid,
                'coupon'=>"BigSale",
                'payment_method'=>$payment_method,
                'shipping_method'=>$shipping_method,
                'total_quantity'=>$total_quantity,
                'total'=>$total,
                'point'=>$point,
                'status'=>$status
            ]);
            DB::commit();
            return 1;
        }
        catch(Exception $e){
            DB::rollBack();
            throw new Exception($e->getMessage());
            return 0;
        }
    }
    public function Insert_OrderProduct($data){
        $Order = Order::latest()->first(); // $isOder['Id'];
        DB::beginTransaction();
        try{
        foreach($data as $key => $product){
                $productsize = DB::table('product_size')->where('Size', $product['product_size'])->where('Id_product',$product['product_id'])->first();

                $newOrderProduct = OrderProduct::create([
                    'id_product_size'=>$productsize->Id,
                    'id_order'=>$Order->Id,
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
}

?>