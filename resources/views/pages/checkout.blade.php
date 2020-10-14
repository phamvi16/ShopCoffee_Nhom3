@extends('main_layout')
@section('content')


<div class="container checkout mb-4">
    <div class="col-xs-12 col-sm-7 wrapper-checkout-left">
        <!-- <h1 class="name text-center">Cafe House</h1>
        <div class="mt-5">
            <h3 class="cre-acc">CREATE NEW ACCOUNT</h3>
            <div class="hr-small"></div>
            <div class="hr"></div>
            <label style="position: relative;">
                <input class="form-control in-mail" type="text" placeholder="Email">
                <span class="required"></span>
            </label>
            <label class="lab-2" style="position: relative;">
                <input class="form-control in-mail" type="text" placeholder="Password">
                <span class="required"></span>
            </label>
        </div> -->

        <h3 class="cre-acc">BILLING INFORMATION</h3>
        <div class="hr-small"></div>
        <div class="hr" style="width: 120%"></div>
        <label>
            <input class="form-control in-mail" type="text" placeholder="Frist Name">
            <span class="required"></span>
        </label>
        <label class="lab-2">
            <input class="form-control in-mail in-ln" type="text" placeholder="Last Name">
            <span class="required"></span>
        </label>

        <input class="form-control in-com mt-3" type="text" placeholder="Company">

        <label class="mt-4 lab-address">
            <input class="form-control in-mail in-add" type="text" placeholder="Address">
            <span class="required req-add"></span>
        </label>
        <label class="lab-2 lab-city">
            <input class="form-control in-city" type="text" placeholder="City">
            <span class="required req-city"></span>
        </label>

        <label class="mt-3" style="width: 40%">
            <input class="form-control in-mail" type="text" placeholder="Email">
            <!-- <span class="required req-mail"></span> -->
        </label>
        <label class="lab-2 lab-city">
            <input class="form-control in-mail in-phone" type="text" placeholder="Phone">
            <span class="required req-phone"></span>
        </label>

        <textarea class="textarea pt-2 mt-3 form-group" name="note" id="note" cols="83" rows="5" placeholder="Note.."></textarea>

        <button class="btn btn-primary chkout-sub mt-4">CHECK OUT</button>

    </div>

    <div class="col-sm-5 wrapper-checkout-right pr-0">
        <div class="d-flex align-items-center">
            <div class="order-sum mt-4">Order Summary</div>
            <div class="edit mt-4">Edit</div>
        </div>
        <div class="hr mt-4"></div>
        <div class="d-flex align-items-center">
            <img class="img-order-sum" src="https://media3.s-nbcnews.com/j/newscms/2019_33/2203981/171026-better-coffee-boost-se-329p_67dfb6820f7d3898b5486975903c2e51.fit-760w.jpg" alt="">
            <div class="flex-column" style="flex-grow: 1">
                <div class="ml-4 mb-2 name-sum">Tionem ullam corporis sample G</div>
                <div class="ml-4">30.000 VNĐ</div>
            </div>

            <div class="mr-4">30.000 VNĐ</div>
        </div>
        <div class="hr mt-4"></div>

        <div class="d-flex align-items-center">
            <img class="img-order-sum" src="https://media3.s-nbcnews.com/j/newscms/2019_33/2203981/171026-better-coffee-boost-se-329p_67dfb6820f7d3898b5486975903c2e51.fit-760w.jpg" alt="">
            <div class="flex-column" style="flex-grow: 1">
                <div class="ml-4 mb-2 name-sum">Tionem ullam corporis sample G</div>
                <div class="ml-4">30.000 VNĐ</div>
            </div>

            <div class="mr-4">30.000 VNĐ</div>
        </div>
        <div class="hr mt-4"></div>

        <h3 class="cre-acc">APPLY COUPON</h3>
        <div class="hr-small"></div>
        <div class="hr"></div>
        <div>
            <input class="form-control in-coupon" style="display: inline;" type="text" placeholder="Your coupon code..">
            <button class="btn btn-primary btn-apply ml-2">APPLY</button>
        </div>

        <div class="hr mt-5"></div>


        <div class="d-flex">
            <div class="subtotal mb-2">Subtotal</div>
            <div class="mr-4">30.000 VNĐ</div>
        </div>

        <div class="d-flex">
            <div class="subtotal mb-2">Shipping</div>
            <div class="mr-4">30.000 VNĐ</div>
        </div>

        <div class="hr mt-4 mb-4"></div>

        <div class="d-flex wrapper-total">
            <div class="total-w">TOTAL</div>
            <div class="mr-4 total">90.000 VNĐ</div>
        </div>


    </div>
</div>


@endsection
