@extends('main_layout')
@section('content')

<div class="tm-main-section light-gray-bg">
    <div class="container-fluid" id="main">

        <section class="tm-section row">
            <div class="col-lg-12 tm-section-header-container margin-bottom-30">
                <h2 class="tm-section-header gold-text tm-handwriting-font"><img src={{asset("Page/img/logo.png")}} alt="Logo" class="tm-site-logo"> Kết quả tìm kiếm</h2>
                <div class="tm-hr-container">
                    <hr class="tm-hr">
                </div>
            </div>
                <div class="col-lg-3 col-sm-2">
                    <div class="tm-position-relative margin-bottom-30">
                    @foreach($all_category as $cate)
                        <nav class="tm-side-menu">
                            <ul>
                                    <li><a href="/menu/{{$cate->Id}}" class="active">{{$cate->Name}}</a></li>
                            </ul>
                        </nav>
                        @endforeach
                        <img src={{asset("Page/img/vertical-menu-bg.png")}} alt="Menu bg" class="tm-side-menu-bg">
                    </div>
                </div>
                <div class="tm-menu-product-content col-lg-9 col-md-9">
                <!-- menu content -->

                 <a class="menu-item" href="{{URL::to('/product-detail')}}">
                 @foreach($search_product as $product)
                    <div class="card card-menu col-sm-3 ml-4 mb-4 " style="width: 25.1rem;">
                        <img class="card-img-top img-menu" src="/ProductImages/Products/{{$product -> Image}}" alt="Card image cap" >
                        <div class="card-body mt-1">
                            <h5 class="card-title">{{$product->Name}}</h5>
                            <p class="card-text">{{$product->Description}}</p>
                            <div class="d-flex">
                                <a href="#" class="btn btn-primary add-to-cart mr-4">ADD TO CART</a>
                                <a href="#" class="btn btn-primary more-info ">{{$product->Price}}</span>$</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </a>
                </div>
            </div>
            </div>
        </section>
    </div>
</div>
@endsection
