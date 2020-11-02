<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topping;
use App\Services\CustomerService;
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
}
