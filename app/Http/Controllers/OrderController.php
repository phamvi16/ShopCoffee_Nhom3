<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Carbon\Carbon;

use App\Services\OrderService;

use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
        $all_order = Order:: all();
        $today = Carbon::now()->toDateString();
        return view('admin.order', compact('all_order', 'today'));
    }
    
    public function edit($id = null) {
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
			return redirect('/admin/order/edit/' . $request->id)->with('success', 'Cập nhật trạng thái đơn hàng thành công');
		}
		else {
			return redirect('/admin/order/edit/' . $request->id)->with('error', 'Lỗi khi cập nhật trạng thái đơn hàng');
		}
    }

    public function filter_orders(Request $request)
    {
    	// Validate data step 1
        $validator = Validator::make($request->all(), [
            'fromDate' => ['required_with:toDate'],
            'toDate' => ['required_with:fromDate'],
            'status' => ['nullable', 'string'],
        ],
        [
            'required_with' => ':Attribute không được trống',
            'string' => ':Attribute phải có định dạng hợp lệ'
        ],
        [
            'fromDate' => 'ngày bắt đầu',
            'toDate' => 'ngày kết thúc',
            'status' => 'trạng thái cần lọc'
        ])->validate();

        // Get request date
    	if ($request->filled('fromDate') && $request->filled('toDate')) {
    		// string to datetime
    		$fromDate = Carbon::createFromFormat('Y-m-d', $request->fromDate)->toDateString();
	        $toDate = Carbon::createFromFormat('Y-m-d', $request->toDate)->toDateString();

	        // Validate data step 2
	        $validator = Validator::make(['fromDate' => $fromDate, 'toDate' => $toDate], [
	            'fromDate' => ['date_format:Y-m-d', 'before_or_equal:toDate'],
	            'toDate' => ['date_format:Y-m-d'],
	        ],
	        [
	            'date_format' => ':Attribute phải là ngày và có định dạng hợp lệ',
	            'before_or_equal' => ':Attribute phải trước hoặc bằng :date',
	        ],
	        [
	            'fromDate' => 'ngày bắt đầu',
	            'toDate' => 'ngày kết thúc',
	        ])->validate();
    	}
        
        // Message about filter type when success
        $description = "Lọc đơn hàng theo ";

        // Get request status
        $filterStatus = $request->status;

        // Get query buider of Model Order
        $orderQuery = Order::query();

        // Filter by status
        if ($filterStatus != 'all') {
			// Get orders by status
	        $orderQuery = $orderQuery->whereStatus($filterStatus);
	        $description .= "trạng thái <b>\"" . $filterStatus . "\"</b>";
        }
        else {
			$description .= "tất cả trạng thái</b>";
        }
        
        if (!empty($fromDate) && !empty($toDate)) {
            // Filter by date
        	if ($fromDate == $toDate) {
        		// Get orders by date
        		$orderQuery = $orderQuery->whereDate('created_at', '<=', $toDate);
        		$description .= " và lập trong ngày <b>" . Carbon::parse($toDate)->format('d/m/Y') . "</b>";
        	}
        	else {
        		// Get orders between date
        		$orderQuery = $orderQuery->whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $toDate);
        		$description .= " và lập từ ngày <b>" . Carbon::parse($fromDate)->format('d/m/Y') . "</b> đến ngày <b>" . Carbon::parse($toDate)->format('d/m/Y') . "</b>";
        	}
        }
    	$data = array(
              'filterResultView' => view('partials.order-list-view', ['all_order' => $orderQuery->get()])->render(),
              'description' => $description
          );
		echo json_encode($data);
    }
}
