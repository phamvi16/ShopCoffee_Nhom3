@extends('admin_layout')
@section('title', 'Product')
@section('content')
<div class="panel-header panel-header-sm"></div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header d-flex">
                    <h4 class="card-title"> All Product</h4>
                    <a href="product/create"class="btn btn-primary btn--icon add-btn">
                    <i class="card-title">Create Product </i></a>
                </div>
                <div>
                    <div class="col-md-4 hidden-sm hidden-xs mb-4">
                        <div class="option browse-tags">
                            <label class="lb-filter hide" for="sort-by">Sắp xếp theo:</label>
                            <span class="custom-dropdown custom-dropdown--grey">
                                @if ($catnow == null)
                                    <form action="/admin/product/filter/" id="filter" method="get" enctype="multipart/form-data">
                                        <select class="sort-by custom-dropdown__select">
                                            @if ($fil == 'stt')
                                                <option name="filter" value="stt" data-filter="" selected>STT</option>
                                            @else
                                                <option name="filter" value="stt" data-filter="">STT</option>
                                            @endif
                                            @if ($fil == 'asc')
                                                <option name="filter" value="price-ascending" data-filter="" selected>Giá: Tăng dần</option>
                                            @else
                                                <option name="filter" value="price-ascending" data-filter="">Giá: Tăng dần</option>
                                            @endif
                                            @if ($fil == 'desc')
                                                <option name="filter" value="price-descending" data-filter="" selected>Giá: Giảm dần</option>
                                            @else
                                                <option name="filter" value="price-descending" data-filter="">Giá: Giảm dần</option>
                                            @endif
                                        </select>
                                    </form>
                                    <form action="/admin/product/filter/category" id="cate-filter" method="get" enctype="multipart/form-data">
                                        <select class="sort-by custom-dropdown__select">
                                            @foreach ($cate as $cat)
                                                <option name="cate-filter" value="{{$cat->Id}}" data-filter="">{{$cat->Name}}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                @else
                                    <form action="/admin/product/filter/category" id="cate-filter" method="get" enctype="multipart/form-data">
                                        <select class="sort-by custom-dropdown__select">
                                            @foreach ($cate as $cat)
                                                @if ($catnow == $cat->Id)
                                                    <option name="cate-filter" value="{{$cat->Id}}" data-filter="" selected>{{$cat->Name}}</option>
                                                @else
                                                    <option name="cate-filter" value="{{$cat->Id}}" data-filter="">{{$cat->Name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </form>
                                @endif
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
                                <th>Price</th>
                                <th>Sale_Price</th>
                                <th>Category</th>
                                <th>Action</th>                             
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

                                                <td>
                                                @foreach($pro -> product_size as $cate)
                                                <P><br>{{ $cate-> Size }}</p>
                                                @endforeach
                                                </td>

                                                <td>
                                                @foreach($pro -> product_size as $cate)
                                                <p><br>{{ $cate-> Price }}$</p>
                                                @endforeach
                                                </td>

                                                <td>
                                                @foreach($pro -> product_size as $cate)
                                                <p><br>{{ $cate-> Sale_Price }}$</p>
                                                @endforeach
                                                </td>

                                                <td>
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
                $(location).attr('href', '/admin/product');
            }
            else if (document.getElementsByName('filter')[1].selected == true)
            {
                $(location).attr('href', '/admin/product/filter/priceasc');
            }
            else if (document.getElementsByName('filter')[2].selected == true)
            {
                $(location).attr('href', '/admin/product/filter/pricedesc');
            }
        });

        $("#cate-filter").change(function(){
            $("option[name='cate-filter']").each(function(i, arr){
                if (arr.selected == true)
                {
                    $(location).attr('href', '/admin/product/filter/category/' + arr.getAttribute('value'));
                }
            });

            
        });
    });
</script>
@endsection
