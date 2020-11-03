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
        $update_Customer = (new CustomerService())->InsertOrUpdate($request); // xong phan nay

        if($update_Customer){
            return 1;
        }
        else{
            return 0;
        }
    }
}

?>