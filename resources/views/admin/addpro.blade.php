@extends('admin_layout')
@section('title', 'Product')
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
                            <div class="alert-box success"><span>Success: </span> {{ \Session::get('success') }}</div>
                            
                         @elseif(\Session::has('error'))
                            <div class="alert-box error"><span>Error: </span> {{ \Session::get('error') }}</div>
                        @endif
                    <h4 class="card-title">Add Product</h4>
                    </div>
                    <div class="card-body ">
                        <form action="store" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Product Name</label>
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
                                        <label>Category</label>
                                        <select name="Category" id="Category" class="form-control input-sm m-bot15">
                                            @if (!$categories->isEmpty())
                                                @foreach ($categories as $item)
                                                    @if (old('Category') == $item->Id)
                                                         <option selected value="{{ $item->Id }}">{{ $item->Name }}</option>
                                                    @else
                                                        <option value="{{ $item->Id }}">{{ $item->Name }}</option>
                                                    @endif
                                                    
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea style="resize: none; border:1px solid #E3E3E3; border-radius: 30px;" rows="8" class="form-control" name="Description" id="Description" required value="{{ old('Description') }}"></textarea>
                                        @if($errors->has('Description'))
                                            <div class="alert-box error"><span>error: </span> {{ $errors->first('Description') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Size</label>
                                        <label class="checkbox-container">Small
                                          <input type="checkbox" name="Size[]" value="S">
                                          <span class="checkmark"></span>
                                        </label>

                                        <label class="checkbox-container">Medium
                                          <input type="checkbox" name="Size[]" value="M">
                                          <span class="checkmark"></span>
                                        </label>

                                        <label class="checkbox-container">Large
                                          <input type="checkbox" name="Size[]" value="L">
                                          <span class="checkmark"></span>
                                        </label>

                                        <label class="checkbox-container">None
                                          <input type="checkbox" name="Size[]" value="None">
                                          <span class="checkmark"></span>
                                        </label>
                                        @if($errors->has('Size'))
                                            <div class="alert-box error"><span>error: </span> {{ $errors->first('Size') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" class="form-control" name="Price" id="Price" value="{{ old('Price') }}" required min="0">
                                        @if($errors->has('Price'))
                                            <div class="alert-box error"><span>error: </span> {{ $errors->first('Price') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Sale Price</label>
                                        <input type="number" class="form-control" name="Sale_Price" id="Sale_Price" value="{{ old('Sale_Price') }}" required min="0">
                                        @if($errors->has('Sale_Price'))
                                            <div class="alert-box error"><span>error: </span> {{ $errors->first('Sale_Price') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input style="opacity: 1; position: static" type="file" class="form-control" name="Image" id="Image" value="" required>
                                        @if($errors->has('Image'))
                                            <div class="alert-box error"><span>error: </span> {{ $errors->first('Image') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>Visibility</label>
                                    <input type="text" class="form-control" name="Visibility" id="Visibility" value="{{ old('Visibility') }}" required>
                                    @if($errors->has('Email'))
                                            <div class="alert-box error"><span>error: </span> {{ $errors->first('Email') }}</div>
                                        @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <button type="submit" name="btnSave" class="btn btn-info">Save</button>
                                    <a href="/admin/product" name="btnBack" class="btn back">Back</a>
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
