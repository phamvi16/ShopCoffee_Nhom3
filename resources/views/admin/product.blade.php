@extends('admin_layout')
@section('title', 'Sản phẩm')
@section('content')
<div class="panel-header panel-header-sm"></div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header d-flex">
                    <h4 class="card-title">Danh sách sản phẩm</h4>
                    <a href="product/create"class="btn btn-primary btn--icon add-btn">
                    <i class="card-title">Creatr Category </i></a>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Stt</th>
                                <th>Tên</th>
                                <th>Hình ảnh</th>
                                <th>Size</th>
                                <th>Giá</th>
                                <th>Giá giảm</th>
                                <th>Danh mục</th>
                                <th>Tác vụ</th>
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
                                            <td><img src="/ProductImages/Products/{{$pro -> Image}}" height="90" width="100"></td>

                                            <td>
                                            @foreach($pro -> product_size as $cate)
                                            <P><br>{{ $cate-> Size }}</p>
                                            @endforeach
                                            </td>

                                            <td>
                                            @foreach($pro -> product_size as $cate)
                                            <p><br>{{ $cate-> Price }}đ</p>
                                            @endforeach
                                            </td>

                                            <td>
                                            @foreach($pro -> product_size as $cate)
                                            <p><br>{{ $cate-> Sale_Price }}đ</p>
                                            @endforeach
                                            </td>

                                            <td>
                                            @foreach($pro -> category as $cate)
                                            <p><br>{{ $cate-> Name }}</p>
                                            @endforeach

                                            <td>
                                                <a href="{{URL::to('/admin/product/edit/' . $pro -> Id)}}" class="active styling-edit">
                                                    <i class="fas fa-edit icon"></i></a>
                                                <a onclick="return confirm('Are you sure to delete this product?')" href="{{URL::to('/admin/product/delete/' . $pro -> Id)}}" class="active styling-edit">
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
