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
                                                <th class="label-cus" colspan="2">Đặt lại mật khẩu</th>
                                                <th style="width:30px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <input type="hidden" value="{{$account['phone']}}" id="phone" />
                                                <td>{{$account['phone']}}</td>
                                                <td><input class="border-0" type="password" value="{{$account['password']}}" disabled></td>
                                                <td>{{$account['created']}}</td>
                                                <td>{{$account['updated']}}</td>
                                                @if ($account['password'] != 'NULL')
                                                    <td class="btn btn-primary reset my-2" id="reset"><i class="fas fa-undo-alt i-reset"></i></td>
                                                    <td>Tạo lại mật khẩu và gửi Email cho khách hàng</td>
                                                @else
                                                    <td>Tài khoản chưa được khách hàng tạo</td>
                                                    <td></td>
                                                @endif
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
                                                <th class="label-cus">Chiết khấu</th>

                                                <th style="width:30px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$account['name']}}</td>
                                                <td>{{$account['phone']}}</td>
                                                <td>{{$account['email']}}</td>
                                                <td>{{$account['address']}}</td>
                                                <td>{{$account['level']}}</td>
                                                <td>{{$account['point']}}</td>
                                                <td>{{$account['discount']}}%</td>
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

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#reset").click(function(){
            $(location).attr('href', '/admin/customer/reset/' + $('#phone').val());
        });
    });
</script>
@endsection
