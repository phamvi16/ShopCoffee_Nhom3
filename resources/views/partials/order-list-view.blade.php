@forelse ($all_order as $order)
    <tr>
        <td>{{ $order->Id ?? '' }}</td>
        <td>{{$order->customer_shipping->Phone}}</td>
        <td>{{$order->created_at}} </td>
        <td>{{$order->payment_method->Name}} </td>
        <td>{{$order->Total}}</td>
    
        <td class="i-eye">
            <a href="/admin/order/edit/{{ $order->Id ?? '' }}"><i class="fas fa-eye"></i></a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6">Không có đơn hàng để hiển thị</td>
    </tr>
@endforelse