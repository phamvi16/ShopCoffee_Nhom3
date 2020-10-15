@extends('admin_layout')
@section('title', 'Product')
@section('content')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('Admins/css/add-pro.css') }}">
@endsection
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
                    <h4 class="card-title">Edit Product</h4>
                    </div>
                    <div class="card-body ">
                        <form action="/admin/product/update" id="edit-pro-form" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            @if ($pro != NULL)
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>ID</label>
                                            <input type="text" name="Id" class="form-control" value="{{$pro->Id ?? ""}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" class="form-control" name="Name" id="Name" value="{{$pro->Name ?? ""}}" required>
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
                                        @if (!$categories->isEmpty())
                                            @foreach ($categories as $item)
                                                <label class="checkbox-container">{{ $item->Name ?? ""}}
                                                @if (in_array($item->Id, $commonCategories))
                                                    <input type="checkbox" class="Category" name="Category[]" value="{{ $item->Id ?? ""}}" checked>
                                                    <span class="checkmark"></span>
                                                @else
                                                    <input type="checkbox" class="Category" name="Category[]" value="{{ $item->Id ?? "" }}">
                                                    <span class="checkmark"></span>
                                                @endif
                                                </label>
                                                
                                            @endforeach
                                        @endif
                                        @if($errors->has('Category'))
                                            <div class="alert-box error"><span>error: </span> {{ $errors->first('Category') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea style="resize: none; border:1px solid #E3E3E3; border-radius: 30px;" rows="8" class="form-control" name="Description" id="Description" required>{{$pro->Description ?? ""}}</textarea>
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
                                            @foreach ($pro->product_size as $product_size)
                                                {{-- SIZE --}}
                                                <label class="checkbox-container">{{ $product_size->getSizeName() }}
                                                  <input type="checkbox" name="Size[]" id="{{ $product_size->Size }}" value="{{ $product_size->Size }}" checked>
                                                  <span class="checkmark"></span>
                                                </label>

                                                <div class="Size{{ $product_size->Size }}">
                                                    {{-- PRICE --}}
                                                    <label class="lbPrice"> Price
                                                        <input type="number" class="form-control price" name="Price{{ $product_size->Size }}" min="0" value="{{ $product_size->Price }}" required>   
                                                    </label>
                                                    @if($errors->has('Price' . $product_size->Size))
                                                        <div class="alert-box error"><span>error: </span> {{ $errors->first('Price' . $product_size->Size) }}</div>
                                                    @endif

                                                    {{-- SALE PRICE --}}
                                                    <label class="lbPrice"> Sale Price
                                                        <input type="number" min="0" class="form-control price" name="SalePrice{{ $product_size->Size }}" value="{{ $product_size->Sale_Price }}" required>
                                                    </label>
                                                    @if($errors->has('SalePrice' . $product_size->Size))
                                                        <div class="alert-box error"><span>error: </span> {{ $errors->first('SalePrice' . $product_size->Size) }}</div>
                                                    @endif
                                                </div>
                                                <hr>
                                            @endforeach
                                            @foreach ($restSize as $size)
                                                {{-- SIZE --}}
                                                <label class="checkbox-container">{{ $AllSizeName[$size] }}
                                                  <input type="checkbox" name="Size[]" id="{{ $size }}" value="{{ $size }}">
                                                  <span class="checkmark"></span>
                                                </label>
                                                <div class="Size{{ $size }}">
                                                    {{-- PRICE --}}
                                                    <label class="lbPrice"> Price
                                                        <input type="number" class="form-control price" name="Price{{ $size }}" min="0" value="" required>   
                                                    </label>
                                                    @if($errors->has('Price' . $size))
                                                        <div class="alert-box error"><span>error: </span> {{ $errors->first('Price' . $size) }}</div>
                                                    @endif

                                                    {{-- SALE PRICE --}}
                                                    <label class="lbPrice"> Sale Price
                                                        <input type="number" min="0" class="form-control price" name="SalePrice{{ $size }}" value="" required>
                                                    </label>
                                                    @if($errors->has('SalePrice' . $size))
                                                        <div class="alert-box error"><span>error: </span> {{ $errors->first('SalePrice' . $size) }}</div>
                                                    @endif
                                                </div>
                                                
                                                <hr>
                                            @endforeach
                                            @if($errors->has('Size'))
                                            <div class="alert-box error"><span>error: </span> {{ $errors->first('Size') }}</div>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input style="opacity: 1; position: static" type="file" class="form-control" name="Image" id="Image">
                                            <img src="{{asset('ProductImages/Products/').'/'.$pro->Image}}" width="400px" height="400px" alt="{{$pro->Name ?? ""}}">
                                            @if($errors->has('Image'))
                                                <div class="alert-box error"><span>error: </span> {{ $errors->first('Image') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Visibility</label>
                                        <input type="text" class="form-control" name="Visibility" id="Visibility" value="{{$pro->Visibility ?? ""}}" required>
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
                            @else
                            <div>An unexpected error occurred. Failed to show product detail. 
                                <p>Please checks if this product exists.</p></div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
<script type="text/javascript" src="{{ asset('Admins/js/addpro.js') }}"></script>
@endsection
