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
        <div class="hr"></div>
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
            <input class="form-control in-mail" type="text" placeholder="City">
            <span class="required req-city"></span>
        </label>

        <label class="mt-3" style="width: 45%">
            <input class="form-control in-mail" type="text" placeholder="Email">
            <!-- <span class="required req-mail"></span> -->
        </label>
        <label class="lab-2 lab-city">
            <input class="form-control in-mail in-phone" type="text" placeholder="Phone">
            <span class="required req-phone"></span>
        </label>

        <textarea class="textarea pt-2 mt-3" name="note" id="note" cols="68.5" rows="5" placeholder="Note.."></textarea>

        <button class="btn btn-primary chkout-sub mt-4">CHECK OUT</button>

    </div>

    <div class="col-sm-5">
        Right
    </div>
</div>


@endsection
