<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Services\CouponService;

class CouponController extends Controller
{
    public function index()
    {
        $all_coupon = (new CouponService())->getAll();
        $realtime = \Carbon\Carbon::now();
        return view('admin.coupon', compact('all_coupon', 'realtime'));
    }

    // Show form new Topping
    public function add()
    {
        return view('admin.addcou');
    }

    // Insert New Topping
    public function insert(Request $request)
    {
        //echo $request->Started_at;
        if ((new CouponService())->insert($request) == true)
        {
            return redirect("admin/coupon");
        }
        else
        {
            return redirect("admin/coupon/add")->with('error', $message);
        }
    }

    // Show form edit Topping
    // public function edit($id)
    // {
    //     $top = (new ToppingService())->getById($id);
    //     return view('admin.edittop', compact('top'));
    // }

    // // Update Topping
    // public function update(Request $request)
    // {
    //     if ((new ToppingService())->update($request) == true)
    //     {
    //         return redirect("admin/topping/edit/" . $request->Id)->with('success', "The topping detail was successfully updated.");
    //     }
    //     else
    //     {
    //         return redirect("admin/topping/edit/" . $request->Id)->with('error', $message);
    //     }
    // }

    // // Delete Topping
    // public function delete($id)
    // {
    //     if ((new ToppingService())->delete($id) == true)
    //     {
    //         return redirect("admin/topping");
    //     }
    //     else
    //     {
    //         return redirect("admin/topping")->with('error', $message);
    //     }
    // }

}
