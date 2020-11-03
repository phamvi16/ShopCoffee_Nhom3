<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Models\CustomerAccount;
use App\Models\CustomerDetail;
use App\Models\CustomerShipping;
use App\Models\ShippingInformation;
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
    // Account Manage
    public function InsertAccountFromView(Request $request){
        DB::beginTransaction();
        try {
            CustomerAccount::create([
                'phone'=> $request->phone,
                'password'=>"random"
            ]);
            CustomerDetail::create([
                'phone'=>$request->phone,
                'name'=>$request->name,
                'birthday'=>$request->birthday,
                'email'=>$request->email
            ]);
            Loyalty::create([
                'phone'=>$request->phone,
                'level'=>'Bronze',
                'point'=>0,
                'discount_loyalty'=>0
                
            ]);
            ShippingInformation::create([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'address'=>$request->address
            ]);
            $idship = ShippingInformation::latest()->first();

            CustomerShipping::create([
                'phone'=>$request->phone,
                'id_shipping'=>$idship['Id']
            ]);
            DB::commit();
            return 1;
        }catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return 0;
        }
    }
    // ---------------------------------------------------Detail manage ------------------------------------------------------------------------------------
    public function UpdateCustomerDetail($request){
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
            // $findID = CustomerShipping::where('phone',$request->phone)->first();

            // echo dd($findID['id_shipping']);

            DB::table('shipping_information')
            ->updateOrInsert(
                ['phone'=>$request->phone ],
                ['name'=>$request->name,'email'=>$request->email,'address'=>$request->address,'phone' => $request->phone]
            );

            $findID = DB::table('shipping_information')->where('phone', $request->phone)->first();

            DB::table('customer_shipping')
            ->updateOrInsert(
                ['phone'=>$request->phone],
                ['id_shipping'=>$findID->Id ]
            );
            // update loyalty when checkout success

            DB::commit();
            return 1;
        }
        catch(Exception $e){
            DB::rollBack();
            throw new Exception($e->getMessage());
            return 0;
        }

    }
    // ------------------------------------------- customer shipping ---------------------
    public function InsertCustomerShipping($phone){

        return 1;
    }
    // ----------------------------------------------end------------------------------

    public function InsertOrUpdate(Request $request){
        $isExistPhone = CustomerAccount::where('phone', '=', $request->phone)->first();
        if($isExistPhone){
            if($this->UpdateCustomerDetail($request) ){
                return 1;
            }
            else{
                return 0;
            }

        }
        else{
            if($this-> InsertAccountFromView($request) == 1){
                 return 1;
            }
            else{
                return 0;
            }
            
        }

    }
    public function GetInfor($phone){
        $account = CustomerAccount::where('phone', '=', $phone)->first();
        if($account == null) return false;

        $general = CustomerShipping::where('phone','=',$phone)->first();
        if($general == null) return false;

        $detail = CustomerDetail::where('phone','=',$phone)->first();
        $shipping_info = ShippingInformation::where('id','=',$general->Id_Shipping)->first();

        $data = [];

        $data['phone']=$phone;
        $data['name']=$shipping_info->Name;
        $data['email']=$shipping_info->Email;
        $data['address']=$shipping_info->Address;
        $data['birthday'] = $detail->Birthday;
        // echo dd($data);
        return $data;
    }
}

?>