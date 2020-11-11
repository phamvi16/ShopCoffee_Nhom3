<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;

class LoginController extends Controller
{
    public function index(){
        if( session()->has('user')){
            return redirect()->to('/trang-chu');
        }
        else{
            return view('pages.login');
        }
    }

    public function Login(Request $request){
        $phone = $request->phone;
        $password = $request->password;

        $result = (new CustomerService())->CheckLogin($phone,$password);
        if($result){
            $request->session()->put('user', $phone);
            if(session()->has('cart') && Count(session('cart'))> 0 ){
                return 2;
            }
            // return redirect()->to('/menu');
            return 1;
        }
        else return 0;
    }
    public function SignUp(Request $request){
        $name = $request->name;
        $birthday = $request->birthday;
        $phone = $request->phone;
        $password = $request->password;
        $email = $request->email;

        $result = (new CustomerService())->CheckSignUp($name,$birthday,$phone,$password,$email);
        if($result==1){
            return "Đăng Ký Thành Công";
        }
        else{
            return "Đăng Ký Thất Bại";
        }
    }
    public function Logout(){
        if(session()->has('user')){
            session()->forget('user');
            return 1;
        }
        else{
            return 0;
        }
    }
    public function myaccount(Request $request){
        return view('pages.myaccount.myaccount');
    }
    public function order(Request $request){
        return view('pages.myaccount.order');
    }
}
