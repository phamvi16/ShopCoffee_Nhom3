<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;

class CustomerController extends Controller
{
    public function index()
    {
        $account = (new CustomerService())->getAll();
        return view('admin.customer', compact('account'));
    }

    public function getCustomer($phone)
    {
        return view('admin.customer-detail');
    }
}
