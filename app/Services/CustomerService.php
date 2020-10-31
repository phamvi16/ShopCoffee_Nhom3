<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Models\CustomerAccount;
use App\Models\CustomerDetail;
use App\Models\CustomerShipping;
use App\Models\Loyalty;
use Illuminate\Support\Facades\DB;
class CustomerService{

    public function CheckLogin($phone,$password){
        $phone = CustomerAccount::where('phone', '=', $phone)->first();
        if($phone == null) return false;
        
        if($phone->Password == $password){
            return true;
        }
        else{
            return false;
        }
    }
    public function CheckSignup($name,$birthday,$phone,$password,$email){
        $isExistPhone = CustomerAccount::where('phone', '=', $phone)->first();
        if($isExistPhone !=null) return 0;
        else{
            DB::beginTransaction();
            try {
                CustomerAccount::create([
                    'phone'=> $phone,
                    'password'=>$password
                ]);
                CustomerDetail::create([
                    'phone'=>$phone,
                    'name'=>$name,
                    'birthday'=>$birthday,
                    'email'=>$email
                ]);
                Loyalty::create([
                    'phone'=>$phone,
                    'level'=>'Bronze',
                    'point'=>0,
                    'discount_loyalty'=>0
                    
                ]);

                DB::commit();
                return 1;
            } catch (Exception $e) {
                DB::rollBack();
                throw new Exception($e->getMessage());
                return 0;
            }
        }
    }
}

?>