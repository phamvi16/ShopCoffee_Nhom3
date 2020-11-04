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
        $all_paymentmethod = DB::table('payment_method')->where('status','Hỗ Trợ')->get();
        
        // echo json_encode($all_paymentmethod);

        if($isbought == "first_time"){
            $data['isBought']=0;
            $data['all_paymentmethod']=$all_paymentmethod;
            return $data;
        }
        else{
            $data = (new CustomerService())->GetInfor($phone);
            $all_paymentmethod = DB::table('payment_method')->where('status','Hỗ Trợ')->get();
            $data['all_paymentmethod']=$all_paymentmethod;

            if(!$data){
                $data['isBought']=0;
            }
            $data['isBought']=1;
            return $data;
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

        $result = (new OrderService())->InsertOrder($data, $request);
        // echo dd($data);
        if($result == 1){
            return "success";
        }
        else{
            return $result;
        }
    }
}
