<?php
namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Coupon;

class CouponService
{
    public function getAll()
    {
        return Coupon::all();
    }

    public function getById($id)
    {
        return Coupon::find($id);
    }

    public function getStartDateLoad($started)
    {
        $start = str_replace(' ', 'T', $started);
        $start = substr($start, 0, 16);
        return $start;
    }

    public function getEndDateLoad($ended)
    {
        $end = str_replace(' ', 'T', $ended);
        $end = substr($end, 0, 16);
        return $end;
    }

    public function insert(Request $request)
    {
        $start = str_replace('T', ' ', $request->Started_at);
        $start = $start . ':00';
        $end = str_replace('T', ' ', $request->Ended_at);
        $end = $end . ':00';

        DB::beginTransaction();
        try {
            // insert coupon in db
            $newcou = Coupon::create([
                'Id' => $request->Id,
                'Type' => $request->Type,
                'Value' => $request->Value,
                'Description' => $request->Description,
                "Started_at" => $start,
                "Ended_at" => $end,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ]);

            DB::commit();
            return true;
        }
        catch (Exception $e) {
            DB::rollBack();
            $message = "An unexpected error occurred. Failed to add new category.";
            return $message;
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            
            //$cou = Coupon::find($request->Id);

            $request->Started_at = str_replace('T', ' ', $request->Started_at);
            $request->Started_at = $request->Started_at . ':00';
            $request->Ended_at = str_replace('T', ' ', $request->Ended_at);
            $request->Ended_at = $request->Ended_at . ':00';

            // echo $request->all();
            //$cou->update($request->all());
            //$cou->save();

            DB::table('coupon')
            ->updateOrInsert(
                ['Id' => $request->Id],
                [   
                    'Type' => $request->Type,
                    'Value' => $request->Value,
                    'Description' => $request->Description,
                    'Started_at' => $request->Started_at,
                    'Ended_at' => $request->Ended_at
                ]
            );

            DB::commit();
            return true;
        }
        catch (Exception $e) {
            DB::rollBack();
            $message = "An unexpected error occurred. Failed to update Category.";
            return $message;
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            if (Coupon::find($id) == null) return "ID bị sai!";
            DB::table('coupon')
            ->updateOrInsert(
                ['Id' => $id],
                [   
                    'Started_at' => \Carbon\Carbon::now(), 
                    'Ended_at' => \Carbon\Carbon::now()
                ]
            );

            DB::commit();
            return true;
        }
        catch (Exception $e) {
            DB::rollBack();
            $message = "An unexpected error occurred. Failed to update Category.";
            return $message;
        }
    }
    
}

?>