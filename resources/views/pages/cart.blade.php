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
                <!-- <input type="hidden" name="colid0" value="2633"> -->
                <!-- <span class="mt-2">
                    <button type="button" class="qty-up" data-target="#qtyItem2632">+</button>
                    <button type="button" class="qty-up qty-down" data-target="#qtyItem2632">-</button>
                </span> -->
            </span>
            <span class="col-sm-2 mt-4 total">30.000 VNĐ</span>
            <div class="hr mt-4"></div>
        </div>
    </div>
    <div class="right">Right</div>
</div>



@endsection
