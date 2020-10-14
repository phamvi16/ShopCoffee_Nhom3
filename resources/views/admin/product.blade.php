@extends('admin_layout')
@section('title', 'Product')
@section('content')
<div class="panel-header panel-header-sm"></div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header d-flex">
                    <h4 class="card-title"> All Category</h4>
                    <a href="product/create"class="btn btn-primary btn--icon add-btn">
                    <i class="card-title">Creatr Category </i></a>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Stt</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Size</th>
                                <th>Category</th>
                                <th>Action</th>

                            </thead>
                            <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                    
                                    @foreach($all_product as $pro)
                                    @php
                                        $i++;
                                    @endphp

                                        <tr>
                                        <td>{{$i}}</td>                       
                                        <td>{{ $pro -> Name }}</td>
                                        <td><img src="/ProductImages/Products/{{$pro -> Image}}" height="100" width="100"></td>
                                        <td>{{$pro ->Price }}</td>
                                        <td>{{$pro ->Size }}</td>
                                        @foreach($pro -> category as $cate)
                                        <td>{{ $cate-> Name }}</td>
                                        @endforeach
                                        <td>
                                    <td>
                                        <a href="{{URL::to('/edit-product')}}" class="active styling-edit">
                                            <i class="fas fa-edit icon"></i></a>
                                        <a onclick="return confirm('Are you sure to delete this category?')" href="{{URL::to('/delete-product')}}" class="active styling-edit">
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
