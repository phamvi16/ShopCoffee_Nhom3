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
                                                {{-- SIZE SMALL --}}
                                                <label class="checkbox-container">Small
                                                  <input type="checkbox" name="Size[]" id="S" value="S" {{ ($product_size->Size == 'S') ? 'checked' : '' }}>
                                                  <span class="checkmark"></span>
                                                </label>

                                                {{-- PRICE SMALL --}}
                                                <label class="lbPrice"> Price
                                                    <input type="number" class="form-control price" name="PriceS" min="0" value="{{ old('PriceS') }}" required disabled>   
                                                </label>
                                                @if($errors->has('PriceS'))
                                                    <div class="alert-box error"><span>error: </span> {{ $errors->first('PriceS') }}</div>
                                                @endif

                                                {{-- SALE PRICE SMALL --}}
                                                <label class="lbPrice"> Sale Price
                                                    <input type="number" min="0" class="form-control price" name="SalePriceS" required disabled>
                                                </label>
                                                @if($errors->has('SalePriceS'))
                                                    <div class="alert-box error"><span>error: </span> {{ $errors->first('SalePriceS') }}</div>
                                                @endif
                                                
                                                <hr>
                                                {{-- SIZE MEDIUM --}}
                                                <label class="checkbox-container">Medium
                                                  <input type="checkbox" name="Size[]" id="M" value="M" {{ ($product_size->Size == 'M') ? 'checked' : '' }}>
                                                  <span class="checkmark"></span>
                                                </label>

                                                {{-- PRICE MEDIUM --}}
                                                <label class="lbPrice"> Price
                                                    <input type="number" class="form-control price" name="PriceM" min="0" value="{{ old('PriceM') }}" required disabled>
                                                </label>
                                                @if($errors->has('PriceM'))
                                                    <div class="alert-box error"><span>error: </span> {{ $errors->first('PriceM') }}</div>
                                                @endif

                                                {{-- SALE PRICE MEDIUM --}}
                                                <label class="lbPrice"> Sale Price
                                                    <input type="number" min="0" class="form-control price" name="SalePriceM" value="{{ old('SalePriceM') }}" required disabled>
                                                </label>
                                                @if($errors->has('SalePriceM'))
                                                    <div class="alert-box error"><span>error: </span> {{ $errors->first('SalePriceM') }}</div>
                                                @endif
                                                
                                                <hr>
                                                {{-- SIZE LARGE --}}
                                                <label class="checkbox-container">Large
                                                  <input type="checkbox" name="Size[]" id="L" value="L" {{ ($product_size->Size == 'L') ? 'checked' : '' }}>
                                                  <span class="checkmark"></span>
                                                </label>

                                                {{-- PRICE LARGE --}}
                                                <label class="lbPrice"> Price
                                                    <input type="number" class="form-control price" name="PriceL" min="0" value="{{ old('PriceL') }}" required disabled>   
                                                </label>
                                                @if($errors->has('PriceL'))
                                                    <div class="alert-box error"><span>error: </span> {{ $errors->first('PriceL') }}</div>
                                                @endif

                                                {{-- SALE PRICE LARGE --}}
                                                <label class="lbPrice"> Sale Price
                                                    <input type="number" min="0" class="form-control price" name="SalePriceL" value="{{ old('SalePriceL') }}" required disabled>
                                                </label>
                                                @if($errors->has('SalePriceL'))
                                                    <div class="alert-box error"><span>error: </span> {{ $errors->first('SalePriceL') }}</div>
                                                @endif
                                                
                                                <hr>
                                                {{-- SIZE NONE --}}
                                                <label class="checkbox-container">None
                                                  <input type="checkbox" name="Size[]" id="None" value="None" {{ ($product_size->Size == 'None') ? 'checked' : '' }}>
                                                  <span class="checkmark"></span>
                                                </label>

                                                {{-- PRICE NONE --}}
                                                <label class="lbPrice"> Price
                                                    <input type="number" min="0" class="form-control price" name="PriceNone" value="{{ old('PriceNone') }}" required disabled>
                                                </label>
                                                @if($errors->has('PriceNone'))
                                                    <div class="alert-box error"><span>error: </span> {{ $errors->first('PriceNone') }}</div>
                                                @endif

                                                {{-- SALE PRICE NONE --}}
                                                <label class="lbPrice"> Sale Price
                                                    <input type="number" min="0" class="form-control price" name="SalePriceNone" value="{{ old('SalePriceNone') }}" required disabled>
                                                </label>
                                                @if($errors->has('SalePriceNone'))
                                                    <div class="alert-box error"><span>error: </span> {{ $errors->first('SalePriceNone') }}</div>
                                                @endif
                                                
                                                @if($errors->has('Size'))
                                                    <div class="alert-box error"><span>error: </span> {{ $errors->first('Size') }}</div>
                                                @endif
                                            @endforeach
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input style="opacity: 1; position: static" type="file" class="form-control" name="Image" id="Image" value="{{$pro->Image ?? ""}}">
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
