<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Carbon;
use Illuminate\Support\Arr;
use App\Models\Category;


class CategoryController extends Controller
{
    public function index(){
       
        return view('admin.category');
    }
    
}
