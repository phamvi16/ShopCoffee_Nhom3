@extends('main_layout')
@section('content')
<div class="tm-main-section light-gray-bg">
    <div class="container-fluid" id="main">
        <section class="tm-section row">
            <div class="col-lg-12 tm-section-header-container margin-bottom-30">
                <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="{{asset("Page/img/logo.png")}}" alt="Logo" class="tm-site-logo"> {{(Request::is('tim-kiem')) ? 'Kết quả tìm kiếm cho "' . ($keywords??"") . '"': "Our Menus"}}</h2>
                <div class="tm-hr-container">
                    <hr class="tm-hr">
                </div>
            </div>
            <div>
                <div>
                <div class="col-lg-3 col-md-3 col-sm-2 mr-4">
                    <div class="tm-position-relative margin-bottom-30">
                    @foreach($all_category as $cate)
                      <div >
                        <nav class="tm-side-menu">
                            <ul>
                                    <li><a href="/menu/{{$cate->Id}}" class="active">{{$cate->Name}}</a></li>
                            </ul>
                        </nav>
                      </div>

                        @endforeach
                        <img src="{{asset("Page/img/vertical-menu-bg.png")}}" alt="Menu bg" class="tm-side-menu-bg">

                    </div>
                </div>
                <div class=" hidden-sm hidden-xs " >
                    <div class="option browse-tags ">
                        <label class="lb-filter hide" for="sort-by">Sắp xếp theo:</label>
                        <span class="custom-dropdown custom-dropdown--grey ">
                            <select class="sort-by custom-dropdown__select btn btn-light dropdown-toggle mr-5" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" style="position: relative;right:-50%;">
                                <option value="manual">Sản phẩm mới nhất</option>
                                <option value="price-ascending" data-filter="">Giá: Tăng dần</option>
                                <option value="price-descending" data-filter="">Giá: Giảm dần</option>
                                <option value="title-descending" data-filter="">Sản phẩm bán chạy nhất</option>

                            </select>
                        </span>
                    </div>
                </div>
                @forelse($all_product as $pro)
                    @if ($pro->Visibility != 'Hidden' && $pro->Visibility != 'Delete')
                        <a class="menu-item" href="/product-detail/{{$pro->Id}}">
                        @csrf
                        <div class="card card-menu col-sm-3 ml-4 mb-4 m-5 ">
                        <input type="hidden" value="{{$pro->Id}}" class="cart_product_id_{{$pro->Id}}">
                        <input type="hidden" value="{{$pro->Name}}" class="cart_product_name_{{$pro->Id}}">
                        <input type="hidden" value="{{$pro->Image}}" class="cart_product_image_{{$pro->Id}}">

                        @foreach($pro->product_size as $size)
                        <input type="hidden" value="{{ $size->Sale_Price}}" class="cart_product_price_{{ $size->Id_Product}}">
                        <input type="hidden" value="{{ $size->Size}}" class="cart_product_size_{{ $size->Id_Product}}">
                        @endforeach
                            <img class="card-img-top img-menu " src="/ProductImages/Products/{{$pro -> Image}}" alt="Card image cap" >
                            <div class="card-body mt-1">
                                <h5 class="card-title"><a href="/product-detail/{{$pro->Id}}">{{$pro->Name}}</a></h5>
                                <p class="card-text">{{$pro->Description}}</p>
                                <div class="d-flex">

                                @if ($pro->Visibility == 'Publish')
                                    <button href="#" data-id="{{$pro->Id}}" name="add-to-cart" type="add-to-cart" data-toggle="modal" data-target="#exampleModal" data-pos="menu" class="btn btn-primary add-to-cart mr-4">THÊM GIỎ HÀNG</button>
                                @elseif ($pro->Visibility == 'Out-Stock')
                                    <button href="#" data-id="{{$pro->Id}}" name="add-to-cart" type="add-to-cart" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary add-to-cart mr-4" disabled>THÊM GIỎ HÀNG</button>
                                @endif

                                <p style="text-decoration: line-through" class="mt-4 mr-3 font-weight-bold ">{{number_format($pro->product_size->sortByDesc("Size")->first()->Sale_Price)}} đ</p>
                                <p class="mt-4 font-weight-bold ">{{number_format($pro->product_size->sortByDesc("Size")->first()->Price)}} đ</p>
                                </div>
                            </div>
                        </div>
                        </a>
                    @endif
                @empty
                    <div>Không có sản phẩm để hiển thị</div>
                @endforelse
            </div>
            </div>
        </section>
    </div>
</div>
@endsection
