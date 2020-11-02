<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Carbon;
use Illuminate\Support\Arr;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSize;
use App\Models\Category;
use App\Services\CategoryService;

class ProductController extends Controller
{
    public function index(){
          $all_product = Product::all();
            return view('admin.product', compact('all_product'));
    }
    

    // Show form to add new product
    public function create(){
        $categories = Category::All();
        return view('admin.addpro', compact('categories'));
    }

    // Store New Product
    public function store(Request $request)
    {
        // Validate data
        $validator = Validator::make($request->all(), [
            'Name' => ['required', 'string'],
            'Category' => ['required'],
            'Description' => ['required', 'string'],
            'Size' => ['required'],
            'Image' => ['required', 'image'],
            'Visibility' => ['required', 'string'],
        ],
        [
            'required' => ':Attribute must be filled.',
            'string' => 'The :attribute must be a string.',
            'image' => 'The :attribute field is not a valid image.'
        ])->validate();

        // Store product proccess

        // Get product image from user
        $image = $request->Image;

        // Set name for image
        $imageName = 'product-' . Carbon::now()->format('YmdHis') . '.' . $image->extension();

        // Move image to foler public/ProductImages/Products
        $image->move(public_path('ProductImages/Products'), $imageName);

        DB::beginTransaction();
        try {
            $sizes = $request->Size;

            // Store product in db
            $newpro = Product::create([
                'Name' => $request->Name,
                'Description' => $request->Description,
                'Image' => $imageName,
                'Visibility' => $request->Visibility
            ]);

            // // Get categories from user
            $categories = $request->Category;
            foreach ($categories as $category) {
                //Store product with category
                ProductCategory::create([
                    'Id_Category' => $category,
                    'Id_Product' => $newpro->Id
                ]);
                $upCount = (new CategoryService())->addCount($category);
            }
            

            // Store size
            foreach ($sizes as $item) {
                DB::table('product_size')->insert([
                    'Id_Product' => $newpro->Id,
                    'Size' => $item,
                    'Price' => $request->input("Price" . $item),
                    'Sale_Price' => $request->input("SalePrice" . $item),
                    "created_at" =>  \Carbon\Carbon::now(), 
                    "updated_at" => \Carbon\Carbon::now()
                ]);
            }

            DB::commit();
            return redirect("admin/product");
        }
        catch (Exception $e) {
            DB::rollBack();
            $message = "An unexpected error occurred. Failed to add new product.";
            return redirect("admin/product/create")->with('error', $message);
        }
    }

    //Edit Product
    public function edit($id) {

        $categories = Category::All();
        $pro = Product::find($id);
        $commonCategories = $restSize = null;

        // All size and size name
        $allSize = [
            ["Size" => "S", "Name" => "Small"],
            ["Size" => "M", "Name" => "Medium"],
            ["Size" => "L", "Name" => "Large"],
            ["Size" => "None", "Name" => "None"]
        ];

        // Get array all size name with key = size and value = name(size)
        $AllSizeName = Arr::pluck($allSize, "Name", "Size");

        if ($pro != null) {
            // Array all categories
            $arrayCategories = array_column($categories->toArray(), 'Id');

            // Array categories of product
            $arrayProCategories = array_column($pro->category->toArray(), 'Id');

            // Get categories from array ProCategories that are present in array Categories
            $commonCategories = array_intersect($arrayProCategories, $arrayCategories);

            // Get only size of product 
            $proSize = array_column($pro->product_size->toArray(), 'Size');

            // Get size from array allSize that are not present in array proSize 
            $restSize = array_diff(array_column($allSize, "Size"), $proSize);
        }
        
        return view('admin.editpro', compact('categories', 'pro', 'commonCategories', 'restSize', 'AllSizeName'));
    }

    // Update Product
    public function update(Request $request) {
     // Validate data
        $validator = Validator::make($request->all(), [
            'Name' => ['required', 'string'],
            'Category' => ['required'],
            'Description' => ['required', 'string'],
            'Size' => ['required'],
            'Image' => ['image'],
            'Visibility' => ['required', 'string'],
        ],
        [
            'required' => ':Attribute must be filled.',
            'string' => ':Attribute muse be a string.',
            'image' => 'The :attribute field is not a valid image.'
        ])->validate();

        DB::beginTransaction();
         try {
            $pro = Product::find($request->Id);

            // Update product in db
            $pro->update($request->All());

            // An Image is present on the request?
            if($request->hasFile('Image')){
                $image = $request->Image;

                // Set name for image
                $imageName = 'product-' . Carbon::now()->format('YmdHis') . '.' . $image->extension();

                // Move image to foler public/ProductImages/Products
                $image->move(public_path('ProductImages/Products'), $imageName);

                // Change image of product
                $pro->Image = $imageName;

            }
            // Save change
            $pro->save();

            // Update Categories
            // Array Product categories (old)
            $arrOldCategories = array_column($pro->category->toArray(), 'Id');
            foreach ($arrOldCategories as $categories)
            {
                $subCount = (new CategoryService())->subCount($categories);
            }

            // Array Product categories (new from user)
            $arrNewCategories = $request->Category;
            foreach ($arrNewCategories as $categories)
            {
                $addCount = (new CategoryService())->addCount($categories);
            }

            // Get categories from array arrOldCategories that are not present in array arrNewCategories
            // Deleted categories
            $deletedCategories = array_diff($arrOldCategories, $arrNewCategories);
            
            // Get categories from array arrNewCategories that are not present in array arrOldCategories
            // Added categories
            $addedCategories = array_diff($arrNewCategories, $arrOldCategories);

            // Update new categories in db
            foreach ($deletedCategories as $deletedCategory) {
                //Delete category that user did not check
                DB::table("product_category")->where("Id_Category", $deletedCategory)
                                            ->where("Id_Product", $pro->Id)
                                            ->delete();
            }

            foreach ($addedCategories as $addedCategory) {
                // Add new category
                ProductCategory::create([
                    'Id_Category' => $addedCategory,
                    'Id_Product' => $pro->Id
                ]);
            }

            // Update Size
            // Array Product sizes (new from user)
            $arrNewSizes = $request->Size;

            // Array Product sizes (old from db)
            $arrOldSizes = array_column($pro->product_size->toArray(), 'Size');

            // Get sizes from array arrOldSizes that are not present in array arrNewSizes
            // Deleted sizes
            $deletedSizes = array_diff($arrOldSizes, $arrNewSizes);

            foreach ($deletedSizes as $deletedSize) {
                //Delete size that user did not check
                DB::table("product_size")->where("Id_Product", $pro->Id)
                                            ->where("Size", $deletedSize)
                                            ->delete();
            }
            
            foreach ($arrNewSizes as $newSize) {
                // new size -> not found in db -> insert new size
                // new size -> found in db -> update
                DB::table("product_size")->updateOrInsert(["Id_Product" => $pro->Id, "Size" => $newSize],
                                                    ["Price" => $request->input("Price" . $newSize), "Sale_Price" => $request->input("SalePrice" . $newSize), "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()]);
            }

            DB::commit();
            return redirect("admin/product/edit/" . $pro->Id)->with('success', "The product detail was successfully updated.");
        }
        catch (Exception $e) {
            DB::rollBack();
            $message = "An unexpected error occurred. Failed to edit product.";
            return redirect("admin/product/edit/" . $pro->Id)->with('error', $message);
        }

    }

    // --------Pages

    public function show($id = null){
        $pro = Product::find($id);
        return ($pro != null) ?  view('pages.product-detail', compact('pro')) : abort(404);
    }
}
