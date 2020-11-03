<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ToppingService;

class ToppingController extends Controller
{
    public function index()
    {
        $all_topping = (new ToppingService())->getAll();
        return view('admin.topping', compact('all_topping'));
    }

    // Show form new Topping
    public function add()
    {
        return view('admin.addtop');
    }

    // Insert New Topping
    public function insert(Request $request)
    {
        if ((new ToppingService())->insert($request) == true)
        {
            return redirect("admin/topping");
        }
        else
        {
            return redirect("admin/topping/add")->with('error', $message);
        }
    }

    // Show form edit Topping
    public function edit($id)
    {
        $top = (new ToppingService())->getById($id);
        return view('admin.edittop', compact('top'));
    }

    // Update Topping
    public function update(Request $request)
    {
        if ((new ToppingService())->update($request) == true)
        {
            return redirect("admin/topping/edit/" . $request->Id)->with('success', "The topping detail was successfully updated.");
        }
        else
        {
            return redirect("admin/topping/edit/" . $request->Id)->with('error', $message);
        }
    }

    // Delete Topping
    public function delete($id)
    {
        if ((new ToppingService())->delete($id) == true)
        {
            return redirect("admin/topping");
        }
        else
        {
            return redirect("admin/topping")->with('error', $message);
        }
    }

}
