@extends('main_layout')
@section('content')

<div class="container-fluid wrapper-cart">
    <div class="left mt-5">
        <h2 class="title">SHOPPING CART</h2>
        @if(session()->has('message'))
                    <div class="alert alert-success">
                        {!! session()->get('message') !!}
                    </div>
                @elseif(session()->has('error'))
                     <div class="alert alert-danger">
                        {!! session()->get('error') !!}
                    </div>
                @endif

        <div class="hr mt-4"></div>
        <div class="wrapper-title row">
            <span class="col-xs-12 col-sm-6">ITEMS</span>
            <span class="col-sm-2 total">PRICE</span>
            <span class="col-sm-2 total">QTY</span>
            <span class="col-sm-2 total">TOTAL</span>
        </div>
        <div class="hr"></div>


      @if(Session::get('cart')==true)
						@php
								$total = 0;
						@endphp
						@foreach(Session::get('cart') as $key => $cart)
							@php
								$subtotal = $cart['product_price'];
								$total+=$subtotal;
							@endphp
          <div class="row items">
            <span class="col-xs-12 col-sm-6 d-flex align-items-center">
                <img class="item-img" src="/ProductImages/Products/{{$cart['product_image']}}" >
                <div class="item-content">
                    <div class="mt-5" style="font-weight: 600; font-size: 16px">{{$cart['product_name']}}</div>
                    <div class="text mt-4">
                        <div> Size: {{$cart['product_size']}}</div>
                        <div>Topping: ..</div>
                    </div>
                    <div class="mt-4 dlt">
                        <a href="{{url('/del-pro-cart/'.$cart['session_id'])}}"  class="btn btn-primary mr-4 mt-4">Delete</a>
                        <i >
                        </i>
                    </div>
                </div>
            </span>
            <span class="col-sm-2 pl-5 mt-4">{{number_format($cart['product_price'],0,',','.')}} VNĐ</span>
            <span class="col-sm-2 qty mt-4">
                <a href="#" data-id_form="{{$cart['product_id']}}" name="add-to-cart" type="add-to-cart" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary show-form mt-5">ADD TO CART</a>
            </span>
            <span class="col-sm-2 mt-4 total">{{number_format($cart['product_price'],0,',','.')}} VNĐ</span>
            <div class="hr mt-4"></div>
        </div>
        @endforeach
        </div>
        <div class="right ml-5 mb-4">
          <h4 class="pl-5 pt-4 title">ORDER SUMMARY</h4>
          <div class="hr"></div>
          <div class="d-flex">
              <div class="pl-5 pt-4 sub">Subtotal</div>
              <div class="pl-5 pt-4 mr-5">30.000 VNĐ</div>
          </div>
          <div class="d-flex total">
              <div class="pl-5 pt-4 mr-5">Total Money</div>
              <div class="pl-5 pt-4 ">	{{number_format($total,0,',','.')}}VNĐ</div>
          </div>

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



                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                            <img  src="/ProductImages/Products/{{$cart['product_image']}}" id="image" style="height: 100px;width:100px"/>
                          <h4 class="modal-title text-black m-5" id="exampleModalLabel">{{$cart['product_name']}}</h4>
                          <h4 class="modal-title text-black m-5" id="Size_click" >Size: {{$cart['product_size']}}</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body p-5">
                          <form>
                                <div class="form-group row modal-header" id="size_form">
                                  <div class="mb-4 mb-lg-0 mr-5"> Size:</div>
                                  <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="click_radio" value="option1">
                                    <label class="form-check-label" for="inlineRadio1">{{$cart['product_size']}}</label>
                                  </div>
                                </div>

                                <div class="form-group row modal-header">
                                  <div class="col-md-12">
                                    <div class="m-4">Topping:</div>
                                    <div class="text-center">
                                    @foreach(App\Models\Topping::All() as $topi)
                                    <div class="form-check form-check-inline mr-4">
                                        <input class="form-check-input" type="checkbox" name="topping[]"  id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">{{$topi->Name }} <p>{{$topi->Price }}</p> </a> </label>
                                      </div>
                                      @endforeach

                                      <!-- <div class="form-check form-check-inline mr-5">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Trân châu đen</label>
                                      </div>
                                      <div class="form-check form-check-inline mr-5">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Thạch trái cây</label>
                                      </div> -->
                                    </div>
                                  </div>
                                  </div>

                                <span class="col-sm-2 qty mt-4" >
                                    <input class="quant-input-modal pl-3" id="qty2632" type="number" min="1" value="1" placeholder="1" >
                                </span>
                                   <div class="form-group row ">
                                  <div class="col-md-6 ml-auto">
                                  <h4 class="modal-title text-black m-5" id="Size_click" >Giá: {{number_format($total,0,',','.')}}</h4>

                                  </div>
                                </div>
                                <div class="form-group row">
                                  <div class="col-md-6 ml-auto">
                                  <!-- <input type="text" hrf="#"   class="btn btn-block btn-primary text-white py-3 px-5 add-to-cart" value="Thêm vào giỏ" > -->
                                   <a href="{{URL::to('/add-cart/1')}}" class=" btn btn-block btn-primary text-white py-3 px-5 add-to-cart" type="text" name ="add-to-cart" id="iccart" > Add To Cart</a>
                                  </div>
                                </div>
                              </form>
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
</script>


@endsection
