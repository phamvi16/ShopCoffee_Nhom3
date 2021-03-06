<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Category;

class CategoryService
{
    public function getAll()
    {
        return Category::all();
    }

    public function getById($id)
    {
        return Category::find($id);
    }

    public function insert(Request $request)
    {
        // Get category image from user
        $image = $request->Image;

        // Set name for image
        $imageName = 'category-' . Carbon::now()->format('YmdHis') . '.' . $image->extension();

        // Move image to foler public/ProductImages/Products
        $image->move(public_path('CategoryImages/Categories'), $imageName);

        DB::beginTransaction();
        try {
            $count = 0;

            // Store product in db
            $newcat = Category::create([
                'Name' => $request->Name,
                'Image' => $imageName,
                'Count' => $count,
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

    public function subCount($id)
    {
        DB::beginTransaction();
        try 
        {
            $cat = Category::find($id);
            $cat->Count = $cat->Count - 1;
            $cat->save();
            DB::commit();
            return true;
        }
        catch (Exception $e) {
            DB::rollBack();
            $message = "An unexpected error occurred. Failed to update Count.";
            return $message;
        }
    }

    public function addCount($id)
    {
        DB::beginTransaction();
        try 
        {
            $cat = Category::find($id);
            $cat->Count = $cat->Count + 1;
            $cat->save();
            DB::commit();
            return true;
        }
        catch (Exception $e) {
            DB::rollBack();
            $message = "An unexpected error occurred. Failed to update Count.";
            return $message;
        }
    }
    
}

?>