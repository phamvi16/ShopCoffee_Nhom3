@extends('main_layout')
@section('content')
<?php 
  Session::forget('cart');
  $item = [
    'id'=>'1',
    'name'=>'Espresso / Americano',
    'image'=>'product-20201012134003.jpeg',
    'id_product_size'=>'2',
    'size'=>'M',
    'price_buy'=>'40000', // = sale_price
    'sugar'=>'30',
    'ice'=>'50',
    'hot'=>'70',
    'topping'=>[
        "2"=>"5000"
    ]
  ];
  Session::push('cart', $item);
  $item = [
    'id'=>'5',
    'name'=>'Cà Phê Sữa',
    'image'=>'product-20201012134003.jpeg',
    'id_product_size'=>'13',
    'size'=>'S',
    'price_buy'=>'25000', // = sale_price
    'sugar'=>'30',
    'ice'=>'50',
    'hot'=>'70',
    'topping'=>[
        "2"=>"5000",
        "3"=>"1000"
    ]
  ];
  Session::push('cart', $item);

 ?>

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
        <form id="verify_form" method="post">
        {{ csrf_field() }}
            <h3  class="cre-acc" >Xác Nhận Thông Tin <small style="font-size:50%;"> (* Truy xuất thông tin cũ - tiết kiệm thời gian) </small> </h3>
            <hr>
            <label class="lab-2" for="phone">
                <input class="form-control in-mail in-add" type="text" placeholder="Nhập Số Điện Thoại.." onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="phone" required>
            </label>
            <hr>
            <label class="lab-2" for="isbought">
                <input type="radio" name="isbought" value="first_time">Mua Lần Đầu</input>
                <input type="radio" name="isbought" value="n_time">Đã Từng Mua</input>
            </label>
            <input  name="_token" type="hidden" value="{{csrf_token()}}">
            <label class="lab-2">
                <button class="btn btn-success" id="verifyBtn" type="submit">Xác Nhận</button>
            </label>
            
        </form>

        <div id="result">
        </div>

    </div> <!--end form-->

    <div class="col-sm-5 wrapper-checkout-right pr-0">
        <div class="d-flex align-items-center">
            <div class="order-sum mt-4">Order Summary</div>
            <div class="edit mt-4"><a href="/gio-hang">Edit</a></div>
        </div>

        <?php
            $data = Session::get('cart');

            $totalPrice_Topping=0;

            $totalPrice_Product=0;

            for($i=0; $i < Count($data);$i++){
                
                $totalPrice_Product += $data[$i]['price_buy'];
        echo '<div class="hr mt-4"></div>
                <div class="d-flex align-items-center">
                    <img class="img-order-sum" src="/ProductImages/Products/'.$data[$i]['image'].'" alt="">
                    <div class="flex-column" style="flex-grow: 1">
                        <div class="ml-4 mb-2 name-sum">'.$data[$i]['name'].'</div>
                        <div class="ml-4">Topping:';
                       
            // $list_topping = collect($data[$i]['topping'])->keys();
            // forea($y=0;$y<Count($list_topping);$y++){
            //     $item = collect($all_topping)->where('Id',$list_topping[$y])->first();
            //     echo  '<div><small><i>'.$item->Name.'</i></small></div>';
            //     $totalPrice_Topping+=$item->Price;
            // }
            
            foreach($data[$i]['topping'] as $id => $gia){
                $item = collect($all_topping)->where('Id',$id)->first();
                echo  '<div><small><i>'.$item->Name.'</i></small></div>';
                $totalPrice_Topping+=$item->Price;
            }
            echo'</div>
                    </div>
                    <div class="mr-4">'.number_format($data[$i]['price_buy']).' VNĐ</div>
                    
                </div>
                ';
            }

        ?>

        <div class="hr mt-4"></div>

        <h3 class="cre-acc">Mã Giảm Giá</h3>
        <div class="hr-small"></div>
        <div class="hr"></div>
        <div>
            <input class="form-control in-coupon" style="display: inline;" type="text" placeholder="nhập mã giảm giá..">
            <button class="btn btn-primary btn-apply ml-2">Apply</button>
        </div>

        <div class="hr mt-5"></div>


        <div class="d-flex">
            <div class="subtotal mb-2">Tiền Topping</div>
            <div class="mr-4">{{number_format($totalPrice_Topping)}} VNĐ</div>
        </div>

        <div class="d-flex">
            <div class="subtotal mb-2">Shipping</div>
            <div class="mr-4">Free Ship</div>
        </div>

        <div class="hr mt-4 mb-4"></div>

        <div class="d-flex wrapper-total">
            <div class="total-w">Tổng Cộng</div>
            <div class="mr-4 total">{{number_format($totalPrice_Topping + $totalPrice_Product)}} VNĐ</div>
        </div>


    </div>
</div>


@endsection
