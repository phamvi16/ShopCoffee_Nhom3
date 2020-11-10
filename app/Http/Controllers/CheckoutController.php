<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topping;
use App\Models\PaymentMethod;
use App\Services\CustomerService;
use App\Services\OrderService;
use Illuminate\Support\Carbon;
use DB;
class CheckoutController extends Controller
{
    public function index(){

        $all_topping = DB::table('topping')->get();
        if(!session()->has('cart')){
            return redirect()->to('/gio-hang');
        }
        return view('pages.checkout',compact('all_topping'));
    }
    public function Verify(Request $request){
        $phone = $request->phone;
        $isbought = $request->isbought;

        $all_paymentmethod = DB::table('payment_method')->where('status','Hỗ Trợ')->get();
        
        if($isbought == "first_time"){
            $data['cart'] = session('cart');
            $data['alltopping'] = DB::table('topping')->get();
            $data['isBought']=0;
            $data['TryGetVal']=0;
            $data['all_paymentmethod']=$all_paymentmethod;
            return $data;
        }
        else{
            $data2 = (new CustomerService())->GetInfor($phone);
            if(!$data2){
                $data2['isBought']=0;
                $data2['TryGetVal']=1;
            }
            else{
                $data2['isBought']=1;
            }
            $data2['all_paymentmethod']=$all_paymentmethod;
            $data2['cart'] = session('cart');
            $data2['alltopping'] = DB::table('topping')->get();
            return $data2;
        }
    }
    public function Checkout(Request $request){
        
        // $data = Session::get('cart'); -- ko hieu sao lai ko chay dc lenh nay`
        $data = session('cart');

        $result = (new OrderService())->InsertCheckout($data, $request);
        if($result == 1){
            $data['result']="success";
        }
        else{
            $data['result']="fail";
        }
        return $data;
    }
    public function ClearCart(){
        session()->forget('cart');
        return redirect('/menu');
    }
    public function ApplyCoupon(Request $request){
        $all_coupon = DB::table('coupon')->where('Started_at','<=',Carbon::now())->where('Ended_at','>=',Carbon::now())->get();
        $tmp = collect($all_coupon)->where('Id',$request->coupon)->first();
        if($tmp!=null){
            
            $result = json_decode(json_encode($tmp),true);
            $dump_obj = [$result['Id'],$result['Value']];
            session()->put('coupon',$dump_obj);
            
            return $result;
        }
        else{
            return 0;
        }
        // return Count($all_coupon);
    }
}
