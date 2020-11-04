<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Topping;

class ToppingService
{
    public function getAll()
    {
        return Topping::where('Status', '<>', 'Delete')->get();
    }

    public function getById($id)
    {
        return Topping::find($id);
    }

    public function insert(Request $request)
    {
        DB::beginTransaction();
        try {
            $count = 0;

            // Store product in db
            $newtop = Topping::create([
                'Name' => $request->Name,
                'Price' => $request->Price,
                'Status' => $request->Status,
                "created_at" => \Carbon\Carbon::now(), 
                "updated_at" => \Carbon\Carbon::now()
            ]);

            DB::commit();
            return true;
        }
        catch (Exception $e) {
            DB::rollBack();
            $message = "An unexpected error occurred. Failed to add new topping.";
            return $message;
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $top = Topping::find($request->Id);

            $top->update($request->All());
            $top->save();

            DB::commit();
            return true;
        }
        catch (Exception $e) {
            DB::rollBack();
            $message = "An unexpected error occurred. Failed to update Topping.";
            return $message;
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $top = Topping::find($id);            
            $top->Status = 'Delete';
            $top->save();

            DB::commit();
            return true;
        }
        catch (Exception $e) {
            DB::rollBack();
            $message = "An unexpected error occurred. Failed to delete Topping.";
            return $message;
        }
    }
    
}

?>