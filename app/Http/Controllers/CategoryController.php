<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function index()
    {
        $all_category = (new CategoryService())->getAll();
        return view('admin.category', compact('all_category'));
    }

    // Show form new Category
    public function add()
    {
        return view('admin.addcat');
    }

    // Insert New Category
    public function insert(Request $request)
    {
        if ((new CategoryService())->insert($request) == true)
        {
            return redirect("admin/category");
        }
        else
        {
            return redirect("admin/category/add")->with('error', $message);
        }
    }

    // Show form edit Category
    public function edit($id)
    {
        $cat = (new CategoryService())->getById($id);
        return view('admin.editcat', compact('cat'));
    }

    // Update Category
    public function update(Request $request)
    {
        if ((new CategoryService())->update($request) == true)
        {
            return redirect("admin/category/edit/" . $request->Id)->with('success', "The product detail was successfully updated.");
        }
        else
        {
            return redirect("admin/category/edit/" . $request->Id)->with('error', $message);
        }
    }

}
