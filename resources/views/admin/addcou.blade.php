@extends('admin_layout')
@section('title', 'Coupon')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('Admins/css/add-pro.css') }}">
@endsection
@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        @if(\Session::has('success'))
                            <div class="alert-box success"><span>Thành công: </span> {{ \Session::get('success') }}</div>

                         @elseif(\Session::has('error'))
                            <div class="alert-box error"><span>Lỗi: </span> {{ \Session::get('error') }}</div>
                        @endif
                    <h4 class="card-title">Thêm mã giảm giá</h4>
                    </div>
                    <div class="card-body ">
                        <form action="/admin/coupon/insert" id="add-pro-form" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>ID phiếu giảm giá</label>
                                        <input type="text" class="form-control" name="Id" id="Id" value="{{ old('Id') }}" required>
                                        @if($errors->has('Id'))
                                            <div class="alert-box error"><span>Lỗi: </span> {{ $errors->first('Id') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Loại</label>
                                        <br>
                                        <!-- <select style="opacity: 1; position: static" class="form-control" name="Type" id="Type" onmousedown="checkType()" required> -->
                                        <input id="per" type="radio" name="Type" value="Percent">
                                        <label>Phần trăm (0% -> 50%)</label>
                                        <br>
                                        <input id="fix" type="radio" name="Type" value="Fixed">
                                        <label>Cố định (0$ -> 30.000$)</label>
                                            <!-- <option value="Hết hàng">Product</option> -->
                                        <!-- </select> -->

                                        @if($errors->has('Type'))
                                            <div class="alert-box error"><span>Lỗi: </span> {{ $errors->first('Type') }}</div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Số lượng</label>
                                        <input style="opacity: 1; position: static" type="number" class="form-control" name="Value" value="0" id="Value" min="0" max="50" required disabled>
                                        <label>Phá là tui khóa đó nha!</label>
                                        @if($errors->has('Value'))
                                            <div class="alert-box error"><span>Lỗi: </span> {{ $errors->first('Value') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea style="resize: none; border:1px solid #E3E3E3; border-radius: 30px;" rows="8" class="form-control" name="Description" id="Description" required>{{ old('Description') }}</textarea>
                                        @if($errors->has('Description'))
                                            <div class="alert-box error"><span>Lỗi: </span> {{ $errors->first('Description') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Ngày bắt đầu</label>
                                        <input type="datetime-local" class="form-control" name="Started_at" id="Started_at" value="2020-01-01T00:00:00" required>
                                        @if($errors->has('Started_at'))
                                            <div class="alert-box error"><span>Lỗi: </span> {{ $errors->first('Started_at') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Ngày kết thúc</label>
                                        <input type="datetime-local" class="form-control" name="Ended_at" id="Ended_at" value="2020-01-01T00:00:00" required>
                                        @if($errors->has('Ended_at'))
                                            <div class="alert-box error"><span>Lỗi: </span> {{ $errors->first('Ended_at') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" name="btnSave" class="btn btn-info">Lưu</button>
                                        <a href="/admin/coupon" name="btnBack" class="btn back">Quay lại</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('Admins/js/addcou.js') }}"></script>
@endsection
