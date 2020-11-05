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

    // Show form new Coupon
    public function add()
    {
        return view('admin.addcou');
    }

    // Insert New Coupon
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

    //Show form edit Coupon
    public function edit($id)
    {
        return redirect("admin/coupon")->with('error', 'Id không có :))');

        $realtime = \Carbon\Carbon::now();
        $cou = (new CouponService())->getById($id);
        $start = (new CouponService())->getStartDateLoad($cou->Started_at);
        $end = (new CouponService())->getEndDateLoad($cou->Ended_at);
        //echo $start;
        return view('admin.editcou', compact('id', 'cou', 'realtime', 'start', 'end'));
    }

    // Update Coupon
    public function update(Request $request)
    {
        if ((new CouponService())->update($request) == true)
        {
            return redirect("admin/coupon/edit/" . $request->Id)->with('success', "The topping detail was successfully updated.");
        }
        else
        {
            return redirect("admin/coupon/edit/" . $request->Id)->with('error', $message);
        }
    }

    // // Delete Topping
    public function delete($id)
    {
        if ((new CouponService())->delete($id) == true)
        {
            sleep(1);
            return redirect("admin/coupon");
        }
        else
        {
            return redirect("admin/coupon")->with('error', $message);
        }
    }

}
