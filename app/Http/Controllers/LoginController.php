<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;

class LoginController extends Controller
{
    public function index(){
    	return view('pages.login');
    }

    public function Login(Request $request){
        $phone = $request->phone;
        $password = $request->password;

        $result = (new CustomerService())->CheckLogin($phone,$password);
        if($result){
            $_SESSION['user'] = $phone;
            return redirect()->to('/menu');
        }
        else{
            echo "fail";
        }
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
}
