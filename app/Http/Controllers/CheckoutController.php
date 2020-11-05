<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topping;
use App\Models\PaymentMethod;
use App\Services\CustomerService;
use App\Services\OrderService;
use DB;
class CheckoutController extends Controller
{
    public function index(){
        $all_topping = DB::table('topping')->get();
        return view('pages.checkout',compact('all_topping'));
    }
    public function Verify(Request $request){
        $phone = $request->phone;
        $isbought = $request->isbought;

        // echo json_encode($all_paymentmethod);
        $all_paymentmethod = DB::table('payment_method')->where('status','Hỗ Trợ')->get();
        
        if($isbought == "first_time"){
            $data['isBought']=0;
            $data['TryGetVal']=0;
            $data['all_paymentmethod']=$all_paymentmethod;
            return $data;
        }
        else{
            $data2 = (new CustomerService())->GetInfor($phone);
            // $all_paymentmethod = DB::table('payment_method')->where('status','Hỗ Trợ')->get();
            if(!$data2){
                $data2['isBought']=0;
                $data2['TryGetVal']=1;
            }
            else{
                $data2['isBought']=1;
            }
            $data2['all_paymentmethod']=$all_paymentmethod;
            return $data2;
        }
    }
    public function Checkout(Request $request){

        // $phone = $request->phone;
        // $name = $request->name;
        // $birthday = $request->birthday;
        // $address = $request->address;
        // $email = $request->email;

        // $data = Session::get('cart'); -- ko hieu sao lai ko chay dc lenh nay`
        $data = session('cart');

        $result = (new OrderService())->InsertCheckout($data, $request);
        // echo dd($data);
        if($result == 1){
            return "success";
        }
        else{
            return $result;
        }
    }
}
