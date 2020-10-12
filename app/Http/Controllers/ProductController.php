<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Carbon;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(){
        return view('admin.product');
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

            // 1 size - 1 product data
            foreach ($sizes as $item) {
                
                // Store product in db
                $newpro = Product::create([
                    'Name' => $request->Name,
                    'Description' => $request->Description,
                    'Size' => $item,
                    'Price' => $request->input('Price'.$item),
                    'Sale_Price' => $request->input('SalePrice'.$item),
                    'Image' => $imageName,
                    'Visibility' => $request->Visibility
                ]);
                
                // Get categories from user
                $categories = $request->Category;
                foreach ($categories as $category) {
                    //Store product with category
                    ProductCategory::create([
                        'Id_Category' => $category,
                        'Id_Product' => $newpro->Id
                    ]);

                }
                
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
        // Array all categories
        $arrayCategories = array_column($categories->toArray(), 'Id');

        // Array categories of product
        $arrayProCategories = array_column($pro->category->toArray(), 'Id');

        // Get categories from array ProCategories that are present in array Categories
        $commonCategories = array_intersect($arrayProCategories, $arrayCategories);
        
        return view('admin.editpro', compact('categories', 'pro', 'commonCategories'));
    }

    // Update Product
    public function update(Request $request) {
     // Validate data
        $validator = Validator::make($request->all(), [
            'Name' => ['required', 'string'],
            'Category' => ['required'],
            'Description' => ['required', 'string'],
            'Price' => ['required', 'numeric', 'min:0'],
            'Sale_Price' => ['required', 'numeric', 'min:0'],
            'Image' => ['image'],
            'Visibility' => ['required', 'string'],
        ],
        [
            'required' => ':Attribute must be filled.',
            'string' => 'The price muse be a string.',
            'image' => 'The :attribute field is not a valid image.',
            'numeric' => 'The price muse be a number.',
            'min' => ":Attribute must be greater than or equal to zero (0)."
        ])->validate();

        DB::beginTransaction();
         try {
            $pro = Product::find($request->Id);

            // A value is present on the request and is not empty?
            if($request->filled('Image')){
                $image = $request->Image;

                // Set name for image
                $imageName = 'product-' . Carbon::now()->format('YmdHis') . '.' . $image->extension();

                // Move image to foler public/ProductImages/Products
                $image->move(public_path('ProductImages/Products'), $imageName);

                // Change image of product
                $pro->Image = $imageName;
            }

            // Store product in db
            
            $pro->Name = $request->Name;
            $pro->Description = $request->Description;
            $pro->Price = $request->Price;
            $pro->Sale_Price = $request->Sale_Price;
            $pro->Visibility = $request->Visibility;
            $pro->save();

            // Remove all old categories
            DB::table('product_category')->where('Id_Product', $pro->Id)->delete();

            // Get categories from user
            $categories = $request->Category;
            foreach ($categories as $category) {
                //Store product with new categories
                ProductCategory::create([
                    'Id_Category' => $category,
                    'Id_Product' => $pro->Id
                ]);
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

    public function detail_pro(){
        return view('pages.product-detail');
    }
}
