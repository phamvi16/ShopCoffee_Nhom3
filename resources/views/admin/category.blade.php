@extends('admin_layout')
@section('title', 'Category')
@section('content')
<div class="panel-header panel-header-sm"></div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header d-flex">
                    <h4 class="card-title"> All Category</h4>
                    <a href="category/add" class="btn btn-primary btn--icon add-btn"></a>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>STT</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Count</th>
                                <th>Action</th>
                            </thead>
                            <tbody>

                            @php
                                $i=0;
                            @endphp
                                    
                            @foreach($all_category as $cat)
                                    
                                @php
                                    $i++;
                                @endphp

                                    <tr>
                                        <td>
                                            {{$i}}
                                        </td>
                                        <td>
                                            {{$cat->Name}}
                                        </td>
                                        <td>
                                            <img src="/CategoryImages/Categories/{{$cat -> Image}}" height="100" width="100">
                                        </td>
                                        <td>
                                            {{$cat->Count}}
                                        </td>
                                        <td>
                                            <a href="{{URL::to('/admin/category/edit/' . $cat->Id)}}" class="active styling-edit">
                                                <i class="fas fa-edit icon"></i></a>
                                            <a onclick="return confirm('Are you sure to delete this category?')" href="{{URL::to('/delete-category')}}" class="active styling-edit">
                                                <i class="fa fa-times icon text-danger text"></i>
                                            </a>
                                        </td>
                                    </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
