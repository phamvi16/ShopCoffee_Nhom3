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
                                            <th class="fz-th">Ghi chú</th>
                                            <th class="fz-th">Hình thức thanh toán</th>
                                            <th style="width:30px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Nguyen Van Teo</td>
                                            <td>0987654321</td>
                                            <td>123 Cộng Hòa, phường 13, quận Tân Bình, TP.HCM</td>
                                            <td>11/11/2020</td>
                                            <td>asd</td>
                                            <td>Tiền mặt</td>
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
                                            <th class="fz-th">Giá</th>
                                            <th class="fz-th">Topping</th>
                                            <th class="fz-th">Mã giảm giá</th>
                                            <th class="fz-th">Tổng tiền</th>

                                            <th style="width:30px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Trà Hoa Bưởi</td>
                                            <td>40.000 đ</td>
                                            <td>Không</td>
                                            <td>QWERT200</td>
                                            <td>40.000 đđ</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Tổng giảm: 0đ<br>
                                                Phí ship: 10.000 đ<br>
                                                Thanh toán: 50.000 đ
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="bg-white">
                                                <form>
                                                    <select class="form-control order_details">
                                                        <option value="">----Chọn hình thức đơn hàng-----</option>
                                                        <option id="" selected value="1">Chưa xử lý</option>
                                                        <option id="" value="2">Đã xử lý-Đã giao hàng</option>
                                                        <option id="" value="3">Hủy đơn hàng-tạm giữ</option>
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
            </div>
        </div>
    </div>

@endsection
