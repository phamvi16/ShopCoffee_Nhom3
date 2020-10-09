@extends('main_layout')
@section('content')

<div class="container-fluid wrapper-cart">
    <div class="left mt-5">
        <h2 class="title">SHOPPING CART</h2>

        <div class="hr mt-4"></div>
        <div class="wrapper-title row">
            <span class="col-xs-12 col-sm-6">ITEMS</span>
            <span class="col-sm-2 total">PRICE</span>
            <span class="col-sm-2 total">QTY</span>
            <span class="col-sm-2 total">TOTAL</span>
        </div>
        <div class="hr"></div>


        <div class="row items">
            <span class="col-xs-12 col-sm-6 d-flex align-items-center">
                <img class="item-img" src="https://upload.wikimedia.org/wikipedia/commons/4/45/A_small_cup_of_coffee.JPG">
                <div class="item-content">
                    <div class="mt-5" style="font-weight: 600; font-size: 16px">Tionem ullam corporis sample F</div>
                    <div class="text mt-4">
                        <div>Size: M</div>
                        <div>Topping: ..</div>
                    </div>
                    <div class="mt-4 dlt">
                        <i class="fas fa-times"></i>
                        Delete
                    </div>
                </div>
            </span>
            <span class="col-sm-2 pl-5 mt-4">30.000 VNĐ</span>
            <span class="col-sm-2 qty mt-4">
                <input class="quant-input pl-3" id="qty2632" type="number" min="1" value="1" placeholder="1">
                <div class="mt-4 dlt update">Update</div>
                <!-- <input type="hidden" name="colid0" value="2633"> -->
                <!-- <span class="mt-2">
                    <button type="button" class="qty-up" data-target="#qtyItem2632">+</button>
                    <button type="button" class="qty-up qty-down" data-target="#qtyItem2632">-</button>
                </span> -->
            </span>
            <span class="col-sm-2 mt-4 total">30.000 VNĐ</span>
            <div class="hr hr-2 mt-4"></div>
        </div>
        <div class="row items">
            <span class="col-xs-12 col-sm-6 d-flex align-items-center">
                <img class="item-img" src="https://upload.wikimedia.org/wikipedia/commons/4/45/A_small_cup_of_coffee.JPG">
                <div class="item-content">
                    <div class="mt-5" style="font-weight: 600; font-size: 16px">Tionem ullam corporis sample F</div>
                    <div class="text mt-4">
                        <div>Size: M</div>
                        <div>Topping: ..</div>
                    </div>
                    <div class="mt-4 dlt">
                        <i class="fas fa-times"></i>
                        Delete
                    </div>
                </div>
            </span>
            <span class="col-sm-2 pl-5 mt-4">30.000 VNĐ</span>
            <span class="col-sm-2 qty mt-4">
                <input class="quant-input pl-3" id="qty2632" type="number" min="1" value="1" placeholder="1">
                <div class="mt-4 dlt update">Update</div>

            </span>
            <span class="col-sm-2 mt-4 total">30.000 VNĐ</span>
            <div class="hr mt-4"></div>
        </div>
    </div>
    <div class="right ml-5 mb-4">
        <h4 class="pl-5 pt-4 title">ORDER SUMMARY</h4>
        <div class="hr"></div>
        <div class="d-flex">
            <div class="pl-5 pt-4 sub">SUBTOTAL</div>
            <div class="pl-5 pt-4 mr-5">30.000 VNĐ</div>
        </div>
        <div class="d-flex total">
            <div class="pl-5 pt-4 sub">TOTAL</div>
            <div class="pl-5 pt-4 mr-5">30.000 VNĐ</div>
        </div>
        <a href="{{URL::to('/checkout')}}" class="btn btn-primary btn-checkout mt-5">PROCEED TO CHECKOUT</a>
        <div class="hr mt-4"></div>


        <div id="open-coup">
            <div class="d-flex" onclick="showCoupon()">
                <div class="pl-5 pt-4 total app-coup mr-4">Apply Coupon</div>
                <i class="fas fa-chevron-down pr-5 down-icon"></i>
            </div>
        </div>

        <div id="close-coup" style="display: none;">
            <div class="d-flex" onclick="closeCoupon()">
                <div class="pl-5 pt-4 total app-coup mr-4">Apply Coupon</div>
                <i class="fas fa-chevron-up pr-5 down-icon"></i>
            </div>
        </div>

        <div id="coupon" style="display: none;">
            <div class="pl-5 pt-4">If you have a promotion code enter it here</div>
            <input class="input-coup mt-4" type="text" placeholder="Coupon..">
            <button class="btn btn-primary btn-apply">APPLY</button>
        </div>
        <div class="hr mt-4"></div>

    </div>
</div>

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
</script>


@endsection
