@extends('main_layout')
@section('content')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('Page/css/prodetails.css') }}">
@endsection
    <!-- Caffeine - Coffee Store PrestaShop Theme -->
    <div class="container">
        <div id="content-wrapper">
            <div class="row">
                <div class="pp-left-column col-xs-12 col-sm-5 col-md-5">
                    <section class="page-content" id="content">
                        <div class="product-leftside">
                             <div class="images-container">
                                  <a href="/product-detail/{{ $pro->Id ?? '' }}">
                                  <img class="js-qv-product-cover" src="{{ asset('ProductImages/Products/') . '/' . ($pro->Image ?? '') }}" data-product-image = "{{ $pro->Image }}" alt="{{ $pro->Name ?? '' }}" style="width: 300px;height:300px;
                                  margin-left: 20%;">
                                  </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="pp-right-column col-sm-7 col-md-7">
                <h1 class="h1 productpage_title" id="name">{{ $pro->Name ?? '' }}</h1>
                <div class="product-reference">
                    <label class="label">Danh mục: </label>
                    <span id="category">
                        @foreach ($pro->category as $category)
                            <a href="/menu/{{ $category->Id }}">
                                @if ($loop->last)
                                    {{ $category->Name }}
                            </a>
                        @else
                            {{ $category->Name }}</a>,
                        @endif
                        @endforeach
                    </span>
                </div>

                <div class="product-information">
                    <div id="short-description">
                        <p>{!! Str::limit($pro->Description, 80, '... <a href="#description">More</a>') !!}</p>
                    </div>
                    <div class="product-actions">
                        <div class="product-variants">
                            <div class="clearfix product-variants-item">
                                <span class="control-label">Size</span>
                                <ul id="product-size-area">
                                    @foreach ($pro->product_size->sortByDesc('Size') as $size)
                                        @csrf
                                        <li class="input-container pull-xs-left">
                                            <input class="input-radio" type="radio"  name="Size" data-product-id="{{ $size->Id_Product ?? '' }}" data-buyprice="{{ $size->Sale_Price }}" data-saleprice="{{ number_format($size->Sale_Price, 0, '.', '.') ?? 0 }}" data-price="{{ number_format($size->Price, 0, '.', '.') ?? 0 }}" value="{{ $size->Id ?? '' }}" {{ ($loop->first) ? "checked" : "" }}>
                                            <span class="radio-label">{{ $size->Size ?? '' }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="product-prices">
                            <div class="product-price h5">
                                <div class="current-price">
                                    <span
                                        id="saleprice">{{ number_format($pro->product_size->sortByDesc('Size')->first()->Sale_Price, 0, '.', '.') ?? 0 }}
                                        VND</span>
                                </div>
                            </div>
                            <div class="tax-shipping-delivery-label" id="price">
                                {{ number_format($pro->product_size->sortByDesc('Size')->first()->Price, 0, '.', '.') ?? 0 }}
                                VND
                            </div>
                        </div>
                        <div class="product-add-to-cart">
                            <div class="add">
                               @if ($pro->Visibility == "Publish")
                                    <a href="#" data-id="{{$size->Id_Product}}" name="add-to-cart" type="add-to-cart" data-toggle="modal" data-target="#exampleModal" data-pos="prodetail" class="btn btn-primary add-to-cart mr-4">ADD TO CART</a>
                                @elseif ($pro->Visibility == "Out-Stock")
                                    <a href="#" name="add-to-cart" type="add-to-cart"
                                        class="btn btn-primary add-to-cart mr-4" disabled>THÊM GIỎ HÀNG</a>
                                @endif
                            </div>
                            <div class="clearfix"></div>
                            <span id="product-availability">
                                <span class="product-{{ $pro->Visibility == 'Publish' ? 'available' : 'unavailable' }}"
                                    id="status">
                                    @if ($pro->Visibility == 'Publish')
                                        Còn hàng
                                    @elseif ($pro->Visibility == "Out-Stock")
                                        Hết hàng
                                    @endif
                                </span>
                            </span>
                        </div>

                        <div class="product-additional-info">
                            <div class="social-sharing">
                                <span>Chia sẻ</span>
                                <ul>
                                    <li class="facebook icon-gray"><a href="" class="" title="Share"
                                            target="_blank">&nbsp;</a></li>
                                    <li class="twitter icon-gray"><a href="" class="" title="Tweet"
                                            target="_blank">&nbsp;</a></li>
                                    <li class="googleplus icon-gray"><a href="" class="" title="Google+"
                                            target="_blank">&nbsp;</a></li>
                                    <li class="pinterest icon-gray"><a href="" class="" title="Pinterest"
                                            target="_blank">&nbsp;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="product-tabcontent">
            <div class="tabs">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#description-tab" aria-expanded="true">Mô
                            tả</a>
                    </li>
                </ul>

                <div class="tab-content" id="tab-content">
                    <div class="tab-pane active in" id="description-tab" aria-expanded="true">
                        <div id="description">
                            {{ $pro->Description ?? '' }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript" src="{{ asset('Page/js/prodetails.js') }}"></script>
@endsection
