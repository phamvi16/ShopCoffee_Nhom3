<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategory;
use Session;
use App\Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;
class MenuController extends Controller
{
    public function index()
    {
        $all_category = Category::All();
        $all_product = Product::where([['Visibility', '<>', 'Delete'], ['Visibility', '<>', 'Hidden']])->get();
        $catnow = 0;
        return view('pages.menu', compact('all_product', 'all_category', 'catnow'))->with("sort", "all");
    }

    public function show_menu($sort, $id)
    {
        $all_category = Category::All();
        
        if ($sort == "all")
        {
            if ($id != 0)
            {
                $all_product = Category::find($id)->product;
                $catnow = $id;
            }
            else
            {
                $all_product = Product::all();
                $catnow = 0;
            }

            return view('pages.menu', compact('all_product', 'all_category', 'catnow'))->with('sort', "all");
        }
        else if ($sort == "priceasc")
        {
            if ($id != 0)
            {
                $all_product = Category::find($id)->product;
                $catnow = $id;
            }
            else
            {
                $all_product = Product::all();
                $catnow = 0;    
            }

            $all_product = $this->filterPriceAsc($all_product);
            return view('pages.menu', compact('all_product', 'all_category', 'catnow'))->with('sort', "asc");
        }
        else if ($sort == "pricedesc")
        {
            if ($id != 0)
            {
                $all_product = Category::find($id)->product;
                $catnow = $id;
            }
            else
            {
                $all_product = Product::all();
                $catnow = 0;
            }

            $all_product = $this->filterPriceDesc($all_product);
            return view('pages.menu', compact('all_product', 'all_category', 'catnow'))->with('sort', "desc");
        }
    }

    public function filterPriceAsc($all_product)
    {
 
        $n=0;
        foreach ($all_product as $pro)
        {
            $n++;
        }

        for ($i = 0; $i < $n-1; $i++)
        {
            for ($j = $i+1; $j < $n; $j++)
            {
                if ($all_product[$i]->product_size[0]->Sale_Price > $all_product[$j]->product_size[0]->Sale_Price)
                {
                    $temp = $all_product[$i];
                    $all_product[$i] = $all_product[$j];
                    $all_product[$j] = $temp;
                }
            }
        }

        for ($i = 0; $i < $n-1; $i++)
        {
            if ($all_product[$i]->product_size->count() < 2) continue;
            for ($j = $i+1; $j < $n; $j++)
            {
                if ($all_product[$j]->product_size->count() < 2) continue;
                if ($all_product[$i]->product_size[1]->Sale_Price > $all_product[$j]->product_size[1]->Sale_Price)
                {
                    $temp = $all_product[$i];
                    $all_product[$i] = $all_product[$j];
                    $all_product[$j] = $temp;
                }
            }
        }

        for ($i = 0; $i < $n-1; $i++)
        {
            if ($all_product[$i]->product_size->count() < 3) continue;
            for ($j = $i+1; $j < $n; $j++)
            {
                if ($all_product[$j]->product_size->count() < 3) continue;
                if ($all_product[$i]->product_size[2]->Sale_Price > $all_product[$j]->product_size[2]->Sale_Price)
                {
                    $temp = $all_product[$i];
                    $all_product[$i] = $all_product[$j];
                    $all_product[$j] = $temp;
                }
            }
        }

        return $all_product;
    }

    public function filterPriceDesc($all_product){
        
        $n=0;
        foreach ($all_product as $pro)
        {
            $n++;
        }

        for ($i = 0; $i < $n-1; $i++)
        {
            for ($j = $i+1; $j < $n; $j++)
            {
                if ($all_product[$i]->product_size[0]->Sale_Price < $all_product[$j]->product_size[0]->Sale_Price)
                {
                    $temp = $all_product[$i];
                    $all_product[$i] = $all_product[$j];
                    $all_product[$j] = $temp;
                }
            }
        }

        for ($i = 0; $i < $n-1; $i++)
        {
            if ($all_product[$i]->product_size->count() < 2) continue;
            for ($j = $i+1; $j < $n; $j++)
            {
                if ($all_product[$j]->product_size->count() < 2) continue;
                if ($all_product[$i]->product_size[1]->Sale_Price < $all_product[$j]->product_size[1]->Sale_Price)
                {
                    $temp = $all_product[$i];
                    $all_product[$i] = $all_product[$j];
                    $all_product[$j] = $temp;
                }
            }
        }

        for ($i = 0; $i < $n-1; $i++)
        {
            if ($all_product[$i]->product_size->count() < 3) continue;
            for ($j = $i+1; $j < $n; $j++)
            {
                if ($all_product[$j]->product_size->count() < 3) continue;
                if ($all_product[$i]->product_size[2]->Sale_Price < $all_product[$j]->product_size[2]->Sale_Price)
                {
                    $temp = $all_product[$i];
                    $all_product[$i] = $all_product[$j];
                    $all_product[$j] = $temp;
                }
            }
        }

        return $all_product;
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords_submit;

        $all_category = Category::All();
        $all_product = Product::where('Name', 'like', '%' .$keywords. '%')->get();

        return view('pages.menu')->with('all_product', $all_product)->with('all_category', $all_category)->with('keywords', $keywords)->with('catnow', 0)->with('sort', 'all');
    }
}

