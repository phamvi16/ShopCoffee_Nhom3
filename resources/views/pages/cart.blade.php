@extends('main_layout')
@section('content')

    <div class="container wrapper-cart">
        <div class="row">
            <div class="col-md-8 left mt-5 container w-100">
                <h2 class="title">GIỎ HÀNG</h2>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {!! session()->get('message') !!}
                    </div>
                @elseif(session()->has('error'))
                    <div class="alert alert-danger">
                        {!! session()->get('error') !!}
                    </div>
                @endif

                <div class="hr mt-4 w-100"></div>
                <div class="wrapper-title row">
                    <span class="col-md-6">MÓN</span>
                    <span class="col-md-2 total">GIÁ</span>
                    <span class="col-md-2">TỔNG TIỀN</span>
                </div>
                <div class="hr w-100"></div>


                @if (Session::get('cart') == true)
                    @php
                    $total = 0;
                    @endphp
                    @foreach (Session::get('cart') as $key => $cart)
                        @php
                        $subtotal = $cart['product_price'];
                        $total+=$subtotal;
                        @endphp

                        <div class="row items">
                            <span class="col-sm-1 my-5 icon-dlt">
                                <a href="{{ url('/del-pro-cart/' . $cart['session_id']) }}">
                                    <i class="fas fa-times text-danger"></i>
                                </a>
                            </span>
                            <span class="col-xs-12 col-sm-6 d-flex align-items-center">
                                <img id="img-cart" class="item-img"
                                    src="/ProductImages/Products/{{ $cart['product_image'] }}">
                                <div class="item-content">
                                    <div class="mt-3" style="font-weight: 600; font-size: 16px">{{ $cart['product_name'] }}
                                    </div>
                                    <div class="text mt-4">
                                        <div> Size: {{ $cart['product_size'] }}</div>
                                        <div>Topping: ..</div>
                                    </div>
                                </div>
                            </span>
                            <span class="col-sm-2 mt-5 price-cart">{{ number_format($cart['product_price'], 0, ',', '.') }}
                                VNĐ</span>

                            <span data-id_form="{{ $cart['product_id'] }}" name="add-to-cart" type="add-to-cart"
                                data-toggle="modal" data-target="#exampleModal"
                                class="col-sm-2 mt-5 show-form">{{ number_format($cart['product_price'], 0, ',', '.') }}
                                VNĐ
                            </span>
                            <span class="col-sm-2 btn btn-success btn-update text-white">
                                <a href="#" data-id_form="{{ $cart['product_id'] }}" name="add-to-cart" type="add-to-cart"
                                    data-toggle="modal" data-key="{{ $key }}" data-target="#exampleModal{{ $key }}" class="mt-5 text-white">
                                    Cập nhật
                                </a>
                            </span>
                            <div class="hr mt-4 w-100"></div>
                        </div>
                    @endforeach
            </div>
            <div class="col-md-4 right mb-4 container w-100">
                <h4 class="pl-5 pt-4 title">TỔNG ĐƠN</h4>
                <div class="hr"></div>
                <div class="d-flex">
                    <div class="pl-5 pt-4 sub">GIÁ</div>
                    <div class="pl-5 pt-4 mr-5">30.000 VNĐ</div>
                </div>
                <div class="d-flex total">
                    <div class="pl-5 pt-4" style="flex-grow: 1">TỔNG TIỀN</div>
                    <div class="pl-5 pt-4 mr-5"> {{ number_format($total, 0, ',', '.') }}VNĐ</div>
                </div>
                <a href="{{ URL::to('/checkout') }}" class="btn btn-primary btn-checkout mt-5">THANH TOÁN</a>
                <div class="hr mt-4"></div>

                <div id="open-coup">
                    <div class="d-flex" onclick="showCoupon()">
                        <div class="pl-5 pt-4 total app-coup mr-4">Thêm Coupon</div>
                        <i class="fas fa-chevron-down pr-5 down-icon"></i>
                    </div>
                </div>

                <div id="close-coup" style="display: none;">
                    <div class="d-flex" onclick="closeCoupon()">
                        <div class="pl-5 pt-4 total app-coup mr-4">Thêm Coupon</div>
                        <i class="fas fa-chevron-up pr-5 down-icon"></i>
                    </div>
                </div>

                <div id="coupon" style="display: none;">
                    <div class="pl-5 pt-4">Nhập Coupon nếu có..</div>
                    <input class="input-coup mt-4" type="text" placeholder="Coupon..">
                    <button class="btn btn-primary btn-apply">THÊM COUPON</button>
                </div>
                <div class="hr mt-4"></div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="" id="image"
                        style="height: 100px;width:100px" />
                    <h4 class="modal-title text-black m-5 name" id="exampleModalLabel"></h4>
                    <h4 class="modal-title text-black m-5 size" id="Size_click">Size: <span></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-5">
                    <form>
                        <div class="form-group row modal-header" id="size_form">
                            <div class="mb-4 mb-lg-0 mr-5"> Size:</div>
                            <div class="form-check form-check-inline mr-5 size-radio">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="click_radio"
                                    value="option1">
                                <label class="form-check-label" for="inlineRadio1">{{ $cart['product_size'] }}</label>
                            </div>
                        </div>

                        <div class="form-group row modal-header">
                            <div class="col-md-12">
                                <h4 class="m-4 font-weight-bold">Topping:</h4>
                                <div class="text-center row">
                                    @foreach (App\Models\Topping::All() as $topi)
                                        <ul style="list-style: none" class="text-left col-md-6">
                                            <li class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label font-weight-normal ml-5" for="exampleCheck1">
                                                    {{ $topi->Name }}
                                                    <span style="font-size: 1.3rem">
                                                        &nbsp;&nbsp;&nbsp;{{ number_format($topi->Price, 0, ',', '.') }}đ</span>
                                                </label>
                                            </li>
                                        </ul>
                                        <ul style="list-style: none" class="text-left col-md-6">
                                            <li class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label font-weight-normal ml-5" for="exampleCheck1">
                                                    {{ $topi->Name }}
                                                    <span style="font-size: 1.3rem">
                                                        &nbsp;&nbsp;&nbsp;{{ number_format($topi->Price, 0, ',', '.') }}đ</span>
                                                </label>
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                                <div class="hr"></div>
                                <h4 class="font-weight-bold">Lượng đường (%)</h4>
                                <div class="row mt-4">
                                    <div class="col col-2">
                                        <div class="row">
                                            <div class="col">
                                                <div class="custom-checkbox">
                                                    <input id="269920" name="sugar" type="radio" value="269920" checked="checked">
                                                    <label for="269920" class="font-weight-normal">100</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-2">
                                        <div class="row">
                                            <div class="col">
                                                <div class="custom-checkbox">
                                                    <input id="269921" name="sugar" type="radio" value="269921">
                                                    <label for="269921" class="font-weight-normal">70</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-2">
                                        <div class="row">
                                            <div class="col">
                                                <div class="custom-checkbox">
                                                    <input id="269922" name="sugar" type="radio" value="269922">
                                                    <label for="269922" class="font-weight-normal">50</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-2">
                                        <div class="row">
                                            <div class="col">
                                                <div class="custom-checkbox">
                                                    <input id="269923" name="sugar" type="radio" value="269923">
                                                    <label for="269923" class="font-weight-normal">0</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="hr mt-4"></div>

                                <h4 class="font-weight-bold">Lượng đá (%)</h4>
                                <div class="row mt-4">

                                    <div class="col col-2">
                                        <div class="row">
                                            <div class="col">
                                                <div class="custom-checkbox">
                                                    <input id="100" name="ice" type="radio" value="100" checked="checked">
                                                    <label for="100" class="font-weight-normal">100</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-2">
                                        <div class="row">
                                            <div class="col">
                                                <div class="custom-checkbox">
                                                    <input id="70" name="ice" type="radio" value="70">
                                                    <label for="70" class="font-weight-normal">70</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-2">
                                        <div class="row">
                                            <div class="col">
                                                <div class="custom-checkbox">
                                                    <input id="50" name="ice" type="radio" value="50">
                                                    <label for="50" class="font-weight-normal">50</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-2">
                                        <div class="row">
                                            <div class="col">
                                                <div class="custom-checkbox">
                                                    <input id="0" name="ice" type="radio" value="0">
                                                    <label for="0" class="font-weight-normal">0</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-2">
                                        <div class="row">
                                            <div class="col">
                                                <div class="custom-checkbox">
                                                    <input id="hot" name="ice" type="radio" value="">
                                                    <label for="hot" class="font-weight-normal">Nóng</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="ml-auto modal-title btn m-5 update-topping-btn" id="Size_click">
                                OK: + {{ number_format($total, 0, ',', '.') }} đ
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    <script>
        function showCoupon() {
            document.getElementById("open-coup").style.display = "none";
            document.getElementById("close-coup").style.display = "block";
            document.getElementById("coupon").style.display = "block";
        }

        function closeCoupon() {
            document.getElementById("open-coup").style.display = "block";
            document.getElementById("close-coup").style.display = "none";
            document.getElementById("coupon").style.display = "none";
        }

        // var width = window.innerWidth;
        // // console.log(width);
        // if(width <= 540) {
        //     document.getElementById("img-cart").style.display = "none";
        // }

    </script>


@endsection
@section('script')
<script type="text/javascript" src="{{ asset('Page/js/cart.js') }}"></script>
@endsection
