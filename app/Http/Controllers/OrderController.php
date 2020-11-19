<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
class OrderController extends Controller
{
    public function index(){
        $all_order = Order:: all();
        return view('admin.order', compact('all_order'));
    }
    public function detail() {
        return view('admin.order-detail');
    }
}
