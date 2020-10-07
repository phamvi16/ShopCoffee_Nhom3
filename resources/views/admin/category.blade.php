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
                    <button class="btn btn-primary btn--icon add-btn"></button>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    STT
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Image
                                </th>
                                <th>
                                    Action
                                </th>


                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        1
                                    </td>
                                    <td>
                                        Dakota Rice
                                    </td>
                                    <td>
                                        Niger
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/edit-category')}}" class="active styling-edit">
                                            <i class="fas fa-edit icon"></i></a>
                                        <a onclick="return confirm('Are you sure to delete this category?')" href="{{URL::to('/delete-category')}}" class="active styling-edit">
                                            <i class="fa fa-times icon text-danger text"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
