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
          $all_product = Product::all();
            return view('admin.product', compact('all_product'));
    }
    

    // Show form to add new product
    public function create(){
        $categories = Category::All();
        return view('admin.addpro', compact('categories'));
    }

    // Store new product
    public function store(Request $request)
    {
        // Validate data
        $validator = Validator::make($request->all(), [
            'Name' => ['required', 'string', 'unique:product'],
            'Category' => ['required', 'numeric'],
            'Description' => ['required', 'string'],
            'Size' => ['required'],
            'Price' => ['required', 'numeric', 'min:0'],
            'Image' => ['required', 'image'],
            'Visibility' => ['required', 'string'],
        ],
        [
            'required' => ':Attribute must be filled.',
            'unique' => 'Another product with this :attribute already exists.',
            'string' => 'Invalid format.',
            'image' => 'Invalid image format.',
            'numeric' => 'Invalid format.',
            'min' => ":Attribute must be greater than or equal to zero (0)."
        ])->validate();

        $size = "";

        // Merge all size of product into 1 string
        $sizes = $request->Size;
        foreach ($sizes as $item) {
            $size .= $item . '/';
        }

        //Omitted comma at the end of string size
        $size = substr($size, 0, -1);

        // Store product proccess
        DB::beginTransaction();
        try {

            $image = $request->Image;

            // Set name for image
            $imageName = 'product-' . Carbon::now()->format('YmdHis') . '.' . $image->extension();

            // Move image to foler public/ProductImages/Products
            $image->move(public_path('ProductImages/Products'), $imageName);

            // Store product in db
            $newpro = Product::create([
                'Name' => $request->Name,
                'Description' => $request->Description,
                'Size' => $size,
                'Price' => $request->Price,
                'Sale_Price' => $request->Sale_Price,
                'Image' => $imageName,
                'Visibility' => $request->Visibility
            ]);
            //Store product with category
            ProductCategory::create([
                'Id_Category' => $request->Category,
                'Id_Product' => $newpro->Id
            ]);

            DB::commit();
            return redirect("admin/product/edit");
        }
        catch (Exception $e) {
            DB::rollBack();
            $message = "An unexpected error occurred. Failed to add new product.";
            return redirect("admin/product/create")->with('error', $message);
        }
    }
    //edit product
    public function edit($id) {
        $categories = Category::All();
        $pro = Product::find($id);
        return view('admin.editpro', compact('categories', 'pro'));
    }
    // update product
    public function update(Request $request) {
     // Validate data
        $validator = Validator::make($request->all(), [
            'Name' => ['required', 'string'],
            'Category' => ['required', 'numeric'],
            'Description' => ['required', 'string'],
            'Size' => ['required'],
            'Price' => ['required', 'numeric', 'min:0'],
            'Image' => ['image'],
            'Visibility' => ['required', 'string'],
        ],
        [
            'required' => ':Attribute must be filled.',
            'string' => 'Invalid format.',
            'image' => 'Invalid image format.',
            'numeric' => 'Invalid format.',
            'min' => ":Attribute must be greater than or equal to zero (0)."
        ])->validate();
         try {
            $pro = Product::find($request->Id);
            if($request->Image != NULL){
                $image = $request->Image;

                // Set name for image
                $imageName = 'product-' . Carbon::now()->format('YmdHis') . '.' . $image->extension();

                // Move image to foler public/ProductImages/Products
                $image->move(public_path('ProductImages/Products'), $imageName);
                $pro->Image = $imageName;

            }

            // Store product in db
            // dd($request->All());
                $pro->Name = $request->Name;
                $pro->Description = $request->Description;
                // $pro->Size = $size;
                $pro->Price = $request->Price;
                $pro->Sale_Price = $request->Sale_Price;
                $pro->Visibility = $request->Visibility;
                $pro->save();
            // //Store product with category
            // ProductCategory::create([
            //     'Id_Category' => $request->Category,
            //     'Id_Product' => $newpro->Id
            // ]);

            DB::commit();
            return redirect("admin/product/edit/" . $pro->Id);
        }
        catch (Exception $e) {
            DB::rollBack();
            $message = "An unexpected error occurred. Failed to edit product.";
            return redirect("admin/product/edit")->with('error', $message);
        }

    }


    // --------Pages

    public function detail_pro(){
        return view('pages.product-detail');
    }
}
