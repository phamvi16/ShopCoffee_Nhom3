<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Services\CustomerService;
use App\Mail\OrderShipped;
use App\Models\CustomerShipping;
use App\Models\ShippingInformation;

class CustomerController extends Controller
{
    public function index()
    {
        $account = (new CustomerService())->getAll();
        return view('admin.customer', compact('account'));
    }

    public function getCustomer($phone)
    {
        $account = (new CustomerService())->GetInfor($phone);
        return view('admin.customer-detail', compact('account'));
    }

    function generatePassword($length = 8) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);
    
        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = Rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }
    
        return $result;
    }

    public function resetPassword($phone)
    {
        $general = CustomerShipping::where('phone', '=', $phone)->first();
        $shipping_info = ShippingInformation::where('id', '=', $general->Id_Shipping)->first();
        $acc = (new CustomerService())->updatePassword($phone, $this->generatePassword(36));
        $account = (new CustomerService())->GetInfor($phone);

        Mail::send(
            'admin.mail', 
            array('password'=>$account['password'], 'content'=>'Mật khẩu mới của bạn:'), 
            function ($m) use ($shipping_info) {
                $m->from('cafe.house.ad@gmail.com', 'Cafe House');
                $m->to($shipping_info->Email, $shipping_info->Name)->subject('Reset Password');
            }
        );

        return view('admin.customer-detail', compact('account'));
    }

}
