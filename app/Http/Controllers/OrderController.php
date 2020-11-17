<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

use App\Services\OrderService;

class OrderController extends Controller
{
    public function index(){
        return view('admin.order');
    }
    
    public function show($id = null) {
    	// Validate data
        $validator = Validator::make(['id' => $id], [
            'id' => ['required', 'numeric', 'exists:order,Id']
        ],
        [
            'required' => 'Chưa có id đơn hàng',
            'numeric' => 'Id đơn hàng phải là số',
            'exists' => 'Id đơn hàng không tồn tại'
        ]);

        // Redirect order list if validate fails
        if ($validator->fails()) {
            return redirect('/admin/order')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Get order details
    	$orderDetail = (new OrderService())->get_order_by_id($id);

    	// Get order products
    	$orderProducts = (new OrderService())->get_order_products($id)['orderProducts'];

    	// Get next status
    	$nextStatus = config('order.updateStatus')[$orderDetail['Status']];
        return (!empty($orderDetail)) ? view('admin.order-detail', compact('orderDetail', 'nextStatus', 'orderProducts')) : abort(404);
    }

    public function update(Request $request)
    {
    	// Validate data
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'numeric', 'exists:order,Id'],
            'newStatus' => ['required', 'string'],
        ],
        [
            'required' => 'Chưa có :attribute',
            'numeric' => ':Attribute phải là số',
            'string' => ':Attribute phải có định dạng chuỗi',
            'exists' => ':Attribute không tồn tại'
        ],
        [
        	'id' => 'id',
        	'newStatus' => 'trạng thái đơn hàng mới'
        ])->validate();

		if ((new OrderService())->update_order_status($request) == true) {
			return redirect('/admin/order/' . $request->id)->with('success', 'Cập nhật trạng thái đơn hàng thành công');
		}
		else {
			return redirect('/admin/order/' . $request->id)->with('error', 'Lỗi khi cập nhật trạng thái đơn hàng');
		}
              
    }
}
