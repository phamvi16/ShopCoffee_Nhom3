@extends('admin_layout')
@section('title', 'Khách hàng')
@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Chi tiết Khách hàng</h4>
                    </div>
                    <div class="card-body ">
                        <div class="table-agile-info">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Thông tin tài khoản
                                </div>


                                <div class="table-responsive">
                                    <table class="table table-striped b-t b-light">
                                        <thead>
                                            <tr>
                                                <th class="label-cus">Số điện thoại</th>
                                                <th class="label-cus">Mật khẩu</th>
                                                <th class="label-cus">Ngày tạo</th>
                                                <th class="label-cus">Ngày cập nhật</th>
                                                <th class="label-cus">Đặt lại mật khẩu</th>
                                                <th style="width:30px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>0987654321</td>
                                                <td><input class="border-0" type="password" value="123456789" disabled></td>
                                                <td>24/11/2020</td>
                                                <td>25/11/2020</td>
                                                <td class="btn btn-primary reset my-2"><i class="fas fa-undo-alt i-reset"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                        <div class="table-agile-info">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Thông tin khách hàng
                                </div>


                                <div class="table-responsive">
                                    <table class="table table-striped b-t b-light">
                                        <thead>
                                            <tr>
                                                <th class="label-cus">Họ và tên</th>
                                                <th class="label-cus">Ngày sinh</th>
                                                <th class="label-cus">Email</th>
                                                <th class="label-cus">Địa chỉ</th>
                                                <th class="label-cus">Hạng mức</th>
                                                <th class="label-cus">Điểm tích lũy</th>

                                                <th style="width:30px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Nguyen Van Teo</td>
                                                <td>0987654321</td>
                                                <td>teonv@gmail.com</td>
                                                <td>123 Cộng Hòa, p.13, Tân Bình, TPHCM</td>
                                                <td>KH thân thiết</td>
                                                <td>150</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
