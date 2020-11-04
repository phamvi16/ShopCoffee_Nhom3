<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OderProduct;
use App\Models\OderTopping;

use App\Models\CustomerAccount;
use App\Models\CustomerDetail;
use App\Models\CustomerShipping;
use App\Models\ShippingInformation;
use App\Models\Loyalty;

use App\Services\CustomerService;

use Illuminate\Support\Facades\DB;
class OrderService{

    public function InsertOrder($data,Request $request){


            $ProcessCustomer = (new CustomerService())->InsertOrUpdate_FromView($request); // xong phan nay

            if($ProcessCustomer){
                $ProcessOrder = $this->InsertData_Order($data,$request->phone);
                if($ProcessOrder){
                    return 1;
                }
                else{
                    return "Xảy ra lỗi khi xác nhận hóa đơn! chúng tôi sẽ xử lý nhanh thôi!";
                }
            }
            else{
                return "Xảy ra lỗi khi nạp thông tin khách hàng! chúng tôi sẽ xử lý nhanh thôi!";
            }

    }
    public function InsertData_Order($data,$phone){
        for($i = 0 ;$i<Count($data);$i++){
            $data[$i]['coupon']='1';
            // $data[$i]['payment_method']="1";
            // $data[$i]
        }
    }
    public function Insert_SingleRecord($phone){

    }
}

?>