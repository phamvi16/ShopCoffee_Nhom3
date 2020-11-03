<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topping;
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
        if($isbought == "first_time"){
            return 0;
        }
        else{
            $data = (new CustomerService())->GetInfor($phone);
            if(!$data) return 0;
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
        if($result == 0){
            return "fail";
        }
        else{
            return " success";
        }
            return 1;
    }
}
