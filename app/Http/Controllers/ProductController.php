<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('admin.product');
    }

    public function add_pro(){
        return view('admin.addpro');
    }

    public function edit_pro(){
        return view('admin.editpro');
    }



    // --------Pages

    public function detail_pro(){
        return view('pages.product-detail');
    }
}
