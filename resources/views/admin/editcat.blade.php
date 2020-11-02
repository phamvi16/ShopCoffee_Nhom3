@extends('admin_layout')
@section('title', 'Category')
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
                        <h4 class="card-title">Edit Category</h4>
                    </div>
                    <div class="card-body ">
                        <form action="/admin/category/update" id="add-cat-form" method="post" enctype="multipart/form-data">

                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            @if ($cat != NULL)

                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>ID</label>
                                            <input type="text" name="Id" class="form-control" value="{{$cat->Id ?? ""}}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <input type="text" class="form-control" name="Name" id="Name" value="{{$cat->Name ?? ""}}" required>
                                            @if($errors->has('Name'))
                                                <div class="alert-box error"><span>error: </span> {{ $errors->first('Name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input style="opacity: 1; position: static" type="file" class="form-control" name="Image" id="Image">
                                            <img src="{{asset('CategoryImages/Categories/').'/'.$cat->Image}}" width="400px" height="400px" alt="{{$cat->Name ?? ""}}">
                                            @if($errors->has('Image'))
                                                <div class="alert-box error"><span>error: </span> {{ $errors->first('Image') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Count</label>
                                            <input type="text" name="Count" class="form-control" value="{{$cat->Count ?? ""}}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" name="" class="btn btn-info">Save</button>
                                            <a href="/admin/category" name="btnBack" class="btn back">Back</a>
                                        </div>
                                    </div>
                                </div>

                            @else
                            <div>An unexpected error occurred. Failed to show category detail. 
                                <p>Please checks if this category exists.</p></div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
