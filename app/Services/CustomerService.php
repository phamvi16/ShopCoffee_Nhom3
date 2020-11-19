<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\CustomerAccount;
use App\Models\CustomerDetail;
use App\Models\CustomerShipping;
use App\Models\ShippingInformation;
use App\Models\Loyalty;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;

class CustomerService{

    public function CheckLogin($phone,$password)
    {
        $phone = CustomerAccount::where('phone', '=', $phone)->first();
        if($phone == null) return false;
        
        if($phone->Password == $password){
            return true;
        }
        else{
            return false;
        }
    }

    public function CheckSignup($name,$birthday,$phone,$password,$email)
    {
        $isExistPhone = CustomerAccount::where('phone', '=', $phone)->where('password','!=','NULL')->first();
        if($isExistPhone !=null) return 0;
        else{
            DB::beginTransaction();
            try {
                DB::table('customer_account')
                ->updateOrInsert(
                    ['phone'=> $phone],
                    ['password'=>$password]
                );
                DB::table('customer_detail')
                ->updateOrInsert(
                    ['phone'=>$phone],
                    ['name'=>$name,
                    'birthday'=>$birthday,
                    'email'=>$email]
                );
                DB::table('loyalty')->updateOrInsert(
                    ['phone'=>$phone],
                    ['level'=>'Bronze',
                    'point'=>0,
                    'discount_loyalty'=>0]
                );
                DB::commit();

                DB::commit();
                return 1;
            } catch (Exception $e) {
                DB::rollBack();
                throw new Exception($e->getMessage());
                return 0;
            }
        }
    }

    // Account Manage
    public function InsertAccount_FromView(Request $request)
    {
        // $newpass = substr(md5(microtime()),rand(0,26),10);
        DB::beginTransaction();
        try {
            CustomerAccount::create([
                'phone'=> $request->phone,
                'password'=>"NULL"
            ]);
            CustomerDetail::create([
                'phone'=>$request->phone,
                'name'=>$request->name,
                'birthday'=>$request->birthday,
                'email'=>$request->email
            ]);
            Loyalty::create([
                'phone'=>$request->phone,
                'level'=>'Khách Hàng Mới',
                'point'=>0,
                'discount_loyalty'=>0
                
            ]);
            $newShippingInfo = ShippingInformation::create([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'address'=>$request->address,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ]);
            // $idship = ShippingInformation::latest()->first();

            CustomerShipping::create([
                'phone'=>$request->phone,
                'id_shipping'=>$newShippingInfo->Id
            ]);
            DB::commit();
            return 1;
        }catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return 0;
        }
    }

    public function UpdateCustomerInformation_FromView($request)
    {
        DB::beginTransaction();
        try{
            DB::table('customer_detail')
            ->updateOrInsert(
                ['phone' => $request->phone],
                [   'name' => $request->name,
                    'email'=>$request->email,
                    'birthday'=>$request->birthday
                ]
            );

            DB::table('shipping_information')
            ->updateOrInsert(
                ['phone'=>$request->phone ],
                ['name'=>$request->name,'email'=>$request->email,'address'=>$request->address,'phone' => $request->phone,"updated_at" => \Carbon\Carbon::now()]
            );

            $findID = DB::table('shipping_information')->where('phone', $request->phone)->first();

            DB::table('customer_shipping')
            ->updateOrInsert(
                ['phone'=>$request->phone],
                ['id_shipping'=>$findID->Id ]
            );

            DB::commit();
            return 1;
        }
        catch(Exception $e){
            DB::rollBack();
            throw new Exception($e->getMessage());
            return 0;
        }

    }

    public function InsertOrUpdate_FromView(Request $request)
    {
        $isExistPhone = CustomerAccount::where('phone', '=', $request->phone)->first();
        if($isExistPhone){
            if($this->UpdateCustomerInformation_FromView($request) ){
                return 1;
            }
            else return 0;
        }
        else{
            if($this->InsertAccount_FromView($request) == 1){
                 return 1;
            }
            else return 0;
            
        }
    }

    // Update Point when checkout
    public function UpdatePoint($point, $phone)
    {
        Loyalty::where('phone', $phone)->increment('Point', $point);
        $acc = Loyalty::where('phone', '=', $phone)->first();
        if ($acc->Point < 100) 
        {
            DB::table('loyalty')
            ->updateOrInsert(
                ['phone' => $phone],
                ['level' => 'Khách Hàng Mới', 'Discount_Loyalty' => 0, 'updated_at' => \Carbon\Carbon::now()]
            );
        }
        else if ($acc->Point > 100 && $acc->Point < 500) 
        {
            DB::table('loyalty')
            ->updateOrInsert(
                ['phone' => $phone],
                ['level' => 'Khách Hàng Thân Thiết', 'Discount_Loyalty' => 5, 'updated_at' => \Carbon\Carbon::now()]
            );
        }
        else if ($acc->Point > 500 && $acc->Point < 1000) 
        {
            DB::table('loyalty')
            ->updateOrInsert(
                ['phone' => $phone],
                ['level' => 'Khách Hàng Cao Cấp', 'Discount_Loyalty' => 10, 'updated_at' => \Carbon\Carbon::now()]
            );
        }
        else if ($acc->Point > 1000) 
        {
            DB::table('loyalty')
            ->updateOrInsert(
                ['phone' => $phone],
                ['level' => 'Khách Hàng VIP', 'Discount_Loyalty' => 20, 'updated_at' => \Carbon\Carbon::now()]
            );
        }
        return 1;
    }

    public function updatePassword($phone, $password)
    {
        $acc = CustomerAccount::where('phone', '=', $phone)->first();
        DB::table('customer_account')
            ->updateOrInsert(
                ['phone' => $phone],
                ['password' => $password, 'updated_at' => \Carbon\Carbon::now()]
            );
        return 1;
    }

    // Get Single Customer
    public function GetInfor($phone)
    {
        $account = CustomerAccount::where('phone', '=', $phone)->first();
        if($account == null) return false;

        $general = CustomerShipping::where('phone', '=', $phone)->first();
        if($general == null) return false;

        $detail = CustomerDetail::where('phone', '=', $phone)->first();
        if($detail == null) return false;

        $loyalty = Loyalty::where('phone', '=', $phone)->first();
        if($loyalty == null) return false;

        $shipping_info = ShippingInformation::where('id', '=', $general->Id_Shipping)->first();
        if($shipping_info == null) return false;

        $data = [];

        $data['phone'] = $phone;
        $data['password'] = $account->Password;
        $data['name'] = $shipping_info->Name;
        $data['email'] = $shipping_info->Email;
        $data['address'] = $shipping_info->Address;
        $data['birthday'] = $detail->Birthday;
        $data['level'] = $loyalty->Level;
        $data['point'] = $loyalty->Point;
        $data['discount'] = $loyalty->Discount_Loyalty;
        $data['created'] = $shipping_info->created_at;
        $data['updated'] = $shipping_info->updated_at;
        
        return $data;
    }

    //Admin - get all customer
    public function getAll()
    {
        $data = [];
        $i = 0;

        $account = CustomerDetail::all();
        foreach ($account as $acc)
        {
            $loy = Loyalty::where('phone', '=', $acc->Phone)->first();

            $arr_acc = [];
            $arr_acc['Name'] = $acc->Name;
            $arr_acc['Phone'] = $acc->Phone;
            $arr_acc['Email'] = $acc->Email;
            $arr_acc['Level'] = $loy->Level;

            $i++;
            $data[$i] = $arr_acc;
        }

        return $data;
    }
}

?>