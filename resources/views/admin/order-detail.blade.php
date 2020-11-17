@extends('admin_layout')
@section('title', 'Đơn hàng')
@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Chi tiết đơn hàng</h4>
                    </div>
                    <br>
                    <div class="table-agile-info">
                @if (!empty($orderDetail))
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">Chi tiết đơn hàng</h4>
                        </div>
                        @include('partials.alert-view')
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert-box error alert-success alert">Lỗi:{{ $error }}</div>
                            @endforeach


                        @endif
                        {{-- <div class="table-agile-info">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Thông tin đăng nhập
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped b-t b-light">
                                        <thead>
                                            <tr>
                                                <th class="fz-th">Tên khách hàng</th>
                                                <th class="fz-th">Số điện thoại</th>
                                                <th class="fz-th">Email</th>

                                                <th style="width:30px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>Nguyen Van Ti</td>
                                                <td>0123456789</td>
                                                <td>tinv@gmail.com</td>
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div> --}}
                        <br>
                        <div class="table-agile-info">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Thông tin đặt hàng
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped b-t b-light">
                                        <thead>
                                            <tr>
                                                <th class="fz-th">Tên KH</th>
                                                <th class="fz-th">Số điện thoại</th>
                                                <th class="fz-th">Địa chỉ</th>
                                                <th class="fz-th">Thời gian đặt</th>
                                                <th class="fz-th">Mã giảm giá</th>
                                                <th class="fz-th">Hình thức thanh toán</th>
                                                <th class="fz-th">Hình thức giao hàng</th>
                                                <th style="width:30px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ \Str::title($orderDetail['CustomerName']) ?? "" }}</td>
                                                <td>{{ $orderDetail['CustomerPhone'] ?? "" }}</td>
                                                <td>{{ \Str::title($orderDetail['ShippingAddress']) ?? "" }}</td>
                                                <td>{{ Carbon\Carbon::parse($orderDetail['OrderCreatedAt'])->format('d-m-Y H:i:s') ?? "" }}</td>
                                                <td>{{ $orderDetail['Coupon'] ?? "" }}</td>
                                                <td>{{ $orderDetail['PaymentMethod'] ?? "" }}</td>
                                                <td>{{ $orderDetail['ShippingMethod'] ?? "" }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <br><br>

                        <div class="table-agile-info">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Liệt kê chi tiết đơn hàng
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped b-t b-light">
                                        <thead>
                                            <tr>
                                                <th style="width:20px;"></th>
                                                <th class="fz-th">Tên sản phẩm</th>
                                                <th class="fz-th">Size</th>
                                                <th class="fz-th">Giá</th>
                                                <th class="fz-th">Topping</th>
                                                <th class="fz-th">Ghi chú</th>
                                                <th class="fz-th">Tổng tiền</th>

                                                <th style="width:30px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($orderProducts as $key => $product)
                                                <tr>
                                                    <td>{{ $key ?? "" }}</td>
                                                    <td>{{ $product['Name'] ?? "" }}</td>
                                                    <td>{{ $product['Size'] ?? "" }}</td>
                                                    <td>{{ number_format($product['PriceBuy'], 0, ',', '.' ) ?? 0 }} đ</td>
                                                    <td>
                                                    {!! $product['Toppings'] !!}
                                                    </td>
                                                    <td>{{ $product['Attribute'] }}</td>
                                                    <td>{{ number_format($product['Total'], 0, ',', '.') }} đ</td>
                                                </tr>
                                            @empty
                                                <tr colspan='7'>
                                                    Không có sản phẩm trong đơn hàng.
                                                </tr>
                                            @endforelse

                                            <tr>
                                                <td colspan="2">
                                                    @if ($orderDetail['ShippingMethod'] == "Giao Tận Nơi")
                                                        Phí ship: +15.000 đ<br>
                                                    @endif
                                                    Tổng giảm: -{{ number_format($orderDetail['Discount'], 0, ',', '.') ?? 0 }} đ<br>
                                                    Thanh toán: {{ number_format($orderDetail['Total'], 0, ',', '.') ?? 0 }} đ
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="bg-white">
                                                    <form action="/admin/order/update" method="post" id="frm_update">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="id" value="{{ $orderDetail['Id'] ?? ""}}">
                                                        <select class="form-control order_details" name="newStatus" onchange="this.form.submit();">
                                                           @forelse ($nextStatus as $key => $status)
                                                               @if ($loop->first)
                                                                   <option value="{{ $status ?? '' }}" data-id="{{ $orderDetail['Id'] }}" checked>{{ $status ?? '' }}</option>
                                                               @else
                                                                   <option value="{{ $status ?? '' }}" data-id="{{ $orderDetail['Id'] }}">{{ $status ?? '' }}</option>
                                                               @endif
                                                           @empty
                                                               <option value="">Không có trạng thái</option>
                                                           @endforelse
                                                        </select>
                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a target="_blank" href="#">In đơn hàng</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
