@extends('admin_layout')
@section('title', 'Topping')
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
                        <h4 class="card-title">Chỉnh sửa topping</h4>
                    </div>
                    <div class="card-body ">
                        <form action="/admin/topping/update" id="add-cat-form" method="post" enctype="multipart/form-data">

                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            @if ($top != NULL)

                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>ID</label>
                                            <input type="text" name="Id" class="form-control" value="{{$top->Id ?? ""}}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Tên topping</label>
                                            <input type="text" class="form-control" name="Name" id="Name" value="{{$top->Name ?? ""}}" required>
                                            @if($errors->has('Name'))
                                                <div class="alert-box error"><span>Lỗi: </span> {{ $errors->first('Name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Giá</label>
                                            <input type="number" class="form-control" name="Price" id="Price" value="{{$top->Price ?? ""}}" required>
                                            @if($errors->has('Price'))
                                                <div class="alert-box error"><span>Lỗi: </span> {{ $errors->first('Price') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select style="opacity: 1; position: static" class="form-control" name="Status" id="Status" required>
                                                @if ($top->Status == 'Còn hàng')
                                                    <option value="Còn hàng" selected>Còn hàng</option>
                                                    <option value="Hết hàng">Hết hàng</option>
                                                @else
                                                    <option value="Còn hàng">Còn hàng</option>
                                                    <option value="Hết hàng" selected>Hết hàng</option>
                                                @endif
                                            </select>
                                            @if($errors->has('Status'))
                                                <div class="alert-box error"><span>Lỗi: </span> {{ $errors->first('Status') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" name="" class="btn btn-info">Lưu</button>
                                            <a href="/admin/topping" name="btnBack" class="btn back">Quay lại</a>
                                        </div>
                                    </div>
                                </div>

                            @else
                            <div>Hiển thị chi tiết topping không thành công
                                <p>Vui lòng kiểm tra lại topping.</p></div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
