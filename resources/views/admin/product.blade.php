@extends('admin_layout')
@section('title', 'Sản phẩm')
@section('content')
<div class="panel-header panel-header-sm"></div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header d-flex">
                    <h4 class="card-title"> Danh sách Sản phẩm</h4>
                    <a href="product/create"class="btn btn-primary btn--icon add-btn">
                    <i class="card-title">Create Product </i></a>
                </div>
                <div>
                    <div class="col-md-4 hidden-sm hidden-xs mb-4">
                        <div class="option browse-tags">
                            <label class="lb-filter hide" for="sort-by">Sắp xếp theo:</label>
                            <span class="custom-dropdown custom-dropdown--grey d-flex justify-content-around">
                                <form action="" id="filter" method="get" enctype="multipart/form-data">
                                    <select class="sort-by custom-dropdown__select">
                                        @if ($sort == 'all')
                                            <option name="filter" value="all" data-filter="" selected>All</option>
                                        @else
                                            <option name="filter" value="all" data-filter="">All</option>
                                        @endif
                                        @if ($sort == 'asc')
                                            <option name="filter" value="price-ascending" data-filter="" selected>Giá: Tăng dần</option>
                                        @else
                                            <option name="filter" value="price-ascending" data-filter="">Giá: Tăng dần</option>
                                        @endif
                                        @if ($sort == 'desc')
                                            <option name="filter" value="price-descending" data-filter="" selected>Giá: Giảm dần</option>
                                        @else
                                            <option name="filter" value="price-descending" data-filter="">Giá: Giảm dần</option>
                                        @endif
                                    </select>
                                </form>
                                <form action="" id="cate-filter" method="get" enctype="multipart/form-data">
                                    <select class="sort-by custom-dropdown__select">
                                        @if ($catnow == 0)
                                            <option name="cate-filter" value="0" data-filter="" selected>All</option>
                                        @else 
                                            <option name="cate-filter" value="0" data-filter="">All</option>
                                        @endif
                                        @foreach ($cate as $cat)
                                            @if ($catnow == $cat->Id)
                                                <option name="cate-filter" value="{{$cat->Id}}" data-filter="" selected>{{$cat->Name}}</option>
                                            @else
                                                <option name="cate-filter" value="{{$cat->Id}}" data-filter="">{{$cat->Name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </form>
                            </span>
                        </div>
                    </div>
                </div>


                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Hình ảnh</th>
                                <th>Size</th>
                                <th>Giá gốc</th>
                                <th>Giá giảm</th>
                                <th>Danh mục</th>
                                <th>Tác vụ</th>
                            </thead>
                            <tbody>
                                    @php
                                        $i=0;
                                    @endphp

                                    @foreach($all_product as $pro)

                                        @if ($pro->Visibility != 'Delete')

                                            @php
                                                $i++;
                                            @endphp

                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{ $pro -> Name }}</td>
                                                <td><img src="/ProductImages/Products/{{$pro -> Image}}" height="100" width="100"></td>

                                                <td class="px-4">
                                                @foreach($pro -> product_size as $cate)
                                                <P><br>{{ $cate-> Size }}</p>
                                                @endforeach
                                                </td>

                                                <td class="px-3">
                                                @foreach($pro -> product_size as $cate)
                                                <p><br>{{ $cate-> Price }} VNĐ</p>
                                                @endforeach
                                                </td>

                                                <td class="px-4">
                                                @foreach($pro -> product_size as $cate)
                                                <p><br>{{ $cate-> Sale_Price }} VNĐ</p>
                                                @endforeach
                                                </td>

                                                <td class="px-4">
                                                @foreach($pro -> category as $cate)
                                                <p><br>{{ $cate-> Name }}</p>
                                                @endforeach
                                                <td>

                                                <td >
                                                    <a href="{{URL::to('/admin/product/edit/' . $pro -> Id)}}" class="active styling-edit icon-edit" >
                                                        <i class="fas fa-edit icon"></i></a>
                                                    <a onclick="return confirm('Are you sure to delete this product?')" href="{{URL::to('/admin/product/delete/' . $pro -> Id)}}" class="active styling-edit">
                                                        <i class="fa fa-times icon text-danger text"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                        @endif

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
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#filter").change(function(){
            if (document.getElementsByName('filter')[0].selected == true)
            {
                //$(location).attr('href', '/admin/product');
                $("option[name='cate-filter']").each(function(i, arr){
                    if (arr.selected == true)
                    {
                        $(location).attr('href', '/admin/product/sort/all/filter/category/' + arr.getAttribute('value'));
                    }
                });
            }
            else if (document.getElementsByName('filter')[1].selected == true)
            {
                //$(location).attr('href', '/admin/product/sort/priceasc');
                $("option[name='cate-filter']").each(function(i, arr){
                    if (arr.selected == true)
                    {
                        $(location).attr('href', '/admin/product/sort/priceasc/filter/category/' + arr.getAttribute('value'));
                    }
                });
            }
            else if (document.getElementsByName('filter')[2].selected == true)
            {
                //$(location).attr('href', '/admin/product/filter/pricedesc');
                $("option[name='cate-filter']").each(function(i, arr){
                    if (arr.selected == true)
                    {
                        $(location).attr('href', '/admin/product/sort/pricedesc/filter/category/' + arr.getAttribute('value'));
                    }
                });
            }
        });

        $("#cate-filter").change(function(){
            if (document.getElementsByName('filter')[0].selected == true)
            {
                //$(location).attr('href', '/admin/product');
                $("option[name='cate-filter']").each(function(i, arr){
                    if (arr.selected == true)
                    {
                        $(location).attr('href', '/admin/product/sort/all/filter/category/' + arr.getAttribute('value'));
                    }
                });
            }
            else if (document.getElementsByName('filter')[1].selected == true)
            {
                //$(location).attr('href', '/admin/product/sort/priceasc');
                $("option[name='cate-filter']").each(function(i, arr){
                    if (arr.selected == true)
                    {
                        $(location).attr('href', '/admin/product/sort/priceasc/filter/category/' + arr.getAttribute('value'));
                    }
                });
            }
            else if (document.getElementsByName('filter')[2].selected == true)
            {
                //$(location).attr('href', '/admin/product/filter/pricedesc');
                $("option[name='cate-filter']").each(function(i, arr){
                    if (arr.selected == true)
                    {
                        $(location).attr('href', '/admin/product/sort/pricedesc/filter/category/' + arr.getAttribute('value'));
                    }
                });
            }
        });
    });
</script>
@endsection
