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
                            <div class="alert-box success"><span>Success: </span> {{ \Session::get('success') }}</div>
                            
                        @elseif(\Session::has('error'))
                            <div class="alert-box error"><span>Error: </span> {{ \Session::get('error') }}</div>
                        @endif
                        <h4 class="card-title"> Add Topping</h4>
                    </div>
                    <div class="card-body ">
                            <form action="/admin/topping/insert" id="add-cat-form" method="post" enctype="multipart/form-data">
                                @csrf
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Topping Name</label>
                                                <input type="text" class="form-control" name="Name" id="Name" value="{{ old('Name') }}" required>
                                                @if($errors->has('Name'))
                                                    <div class="alert-box error"><span>error: </span> {{ $errors->first('Name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="number" class="form-control" name="Price" id="Price" value="{{ old('Price') }}" required>
                                                @if($errors->has('Price'))
                                                    <div class="alert-box error"><span>error: </span> {{ $errors->first('Price') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select style="opacity: 1; position: static" class="form-control" name="Status" id="Status" required>
                                                    <option value="Còn hàng">Còn hàng</option>
                                                    <option value="Hết hàng">Hết hàng</option>
                                                </select>
                                                @if($errors->has('Status'))
                                                    <div class="alert-box error"><span>error: </span> {{ $errors->first('Status') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" name="" class="btn btn-info">Save</button>
                                                <a href="/admin/topping" name="btnBack" class="btn back">Back</a>
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
