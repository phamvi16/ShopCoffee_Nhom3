<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topping;
use DB;
class CheckoutController extends Controller
{
    public function index(){
        $all_topping = DB::table('topping')->get();
        return view('pages.checkout',compact('all_topping'));
    }
}
