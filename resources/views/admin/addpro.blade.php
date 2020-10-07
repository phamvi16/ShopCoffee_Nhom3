@extends('admin_layout')
@section('title', 'Product')
@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                    <h4 class="card-title">Add Product</h4>
                    </div>
                    <div class="card-body ">
                            <form>

                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input type="text" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select name="" class="form-control input-sm m-bot15">
                                            <option value="">kwciwk</option>

                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea style="resize: none; border:1px solid #E3E3E3; border-radius: 30px;" rows="8" class="form-control" name=""  id=""></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="text" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input style="opacity: 1; position: static" type="file" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <button type="submit" name="" class="btn btn-info">Save</button>
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
