@extends('admin_layout')
@section('title', 'Category')
@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                    <h4 class="card-title"> Add Category</h4>
                    </div>
                    <div class="card-body ">
                            <form>

                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Category Name</label>
                                                <input type="text" class="form-control" value="">
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
