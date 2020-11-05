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
            $cat = Category::find($request->Id);

            $cat->update($request->All());

            if($request->hasFile('Image')){
                // Get category image from user
                $image = $request->Image;
    
                // Set name for image
                $imageName = 'category-' . Carbon::now()->format('YmdHis') . '.' . $image->extension();
    
                // Move image to foler public/ProductImages/Products
                $image->move(public_path('CategoryImages/Categories'), $imageName);

                $cat->Image = $imageName;
            }

            $cat->save();

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