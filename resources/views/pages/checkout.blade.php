@extends('main_layout')
@section('content')
<?php 
//   Session::forget('cart');
//   $item = [
//     'product_id'=>'1',
//     'product_name'=>'Espresso / Americano',
//     'product_image'=>'product-20201012134003.jpeg',
//     'product_size'=>'M',
//     'product_price'=>'40000', // = sale_price
//     'sugar'=>'30',
//     'ice'=>'50',
//     'hot'=>'70',
//     'topping'=>[
//         "2"=>"5000",
//         "3"=>"8000"
//     ]
//   ];
//   Session::push('cart', $item);
//   $item = [
//     'product_id'=>'5',
//     'product_name'=>'Cà Phê Sữa',
//     'product_image'=>'product-20201012134003.jpeg',
//     'product_size'=>'S',
//     'product_price'=>'25000', // = sale_price
//     'sugar'=>'30',
//     'ice'=>'50',
//     'hot'=>'70',
//     'topping'=>[
//         "2"=>"5000"
//     ]
//   ];
//   Session::push('cart', $item);
//   echo dd( Session::get('cart'));
$data = Session::get('cart');
if(session()->has('coupon')){
    session()->forget('coupon');
}
 ?>

<div class="container checkout mb-4">

    <div class="col-xs-12 col-sm-7 wrapper-checkout-left" id="left">

        <form id="verify_form" method="post">
        {{ csrf_field() }}
            <h3  class="cre-acc" >Xác Nhận Thông Tin <small style="font-size:50%;"> (* Truy xuất thông tin cũ - tiết kiệm thời gian) </small> </h3>
            <hr>
            <label class="lab-2" for="phone">
            Nhập Số Điện Thoại 
                <input class="form-control in-mail in-add" type="text" placeholder="Nhập Số Điện Thoại.." onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="phone" maxlength="11" required 
                @unless (!session()->has('user'))
                    value={{session()->get('user')}}
                    disabled
                @endunless
                >
            </label>
            <hr>
            <label class="lab-2" for="isbought">
                @if(!session()->has('user'))
                    <input type="radio" name="isbought" value="first_time" checked>Mua Lần Đầu</input>
                    <input type="radio" name="isbought" value="n_time">Đã Từng Mua</input>
                @else
                    <input type="radio" name="isbought" value="first_time" checked>Nhập Thông Tin Mới</input>
                    <input type="radio" name="isbought" value="n_time">Sử Dụng Thông Tin Cũ</input>
                @endif
            </label>
            <label class="lab-2">
                <button class="btn btn-success" id="verifyBtn">Xác Nhận</button>
            </label>
            
        </form>

        <div id="result">
        </div>

    </div> <!--end form-->

    <div class="col-sm-5 wrapper-checkout-right pr-0" id="right">
        <div class="d-flex align-items-center">
            <div class="order-sum mt-4">Order Summary</div>
            <div class="edit mt-4"><a href="/gio-hang">Chỉnh Sửa</a></div>
        </div>

        <?php
            $totalPrice_Topping=0;

            $totalPrice_Product=0;

            foreach($data as $key =>$value){
                $totalPrice_Product += $value['product_price'];
        echo '<div class="hr mt-4"></div>
                <div class="d-flex align-items-center">
                    <img class="img-order-sum" src="/ProductImages/Products/'.$value['product_image'].'" alt="">
                    <div class="flex-column" style="flex-grow: 1">
                        <div class="ml-4 mb-2 name-sum"><a href="./product-detail/'.$value['product_id'].'">'.$value['product_name'].'</a></div>
                        <div class="ml-4">Size: '.$value["product_size"].'</div>
                        <div class="ml-4">Topping:';
                       
            // $list_topping = collect($data[$i]['topping'])->keys();
            // forea($y=0;$y<Count($list_topping);$y++){
            //     $item = collect($all_topping)->where('Id',$list_topping[$y])->first();
            //     echo  '<div><small><i>'.$item->Name.'</i></small></div>';
            //     $totalPrice_Topping+=$item->Price;
            // }
            if(Count($value['topping']) == 0) echo'none';
            else
            foreach($value['topping'] as $id => $gia){
                $item = collect($all_topping)->where('Id',$id)->first();
                echo  '<div><small><i>'.$item->Name.'</i></small></div>';
                $totalPrice_Topping+=$gia;
            }
            echo'</div>
                    </div>
                    <div class="mr-4">'.number_format($value['product_price']).' VNĐ</div>
                    
                </div>
                ';
            }

        ?>

        <div class="hr mt-4"></div>
        
        <h3 class="cre-acc">Mã Giảm Giá</h3>
        <div class="hr-small"></div>
        <div class="hr"></div>
        <div class="input-group" id="coupon-form">
            <input class="form-control in-coupon" style="display: inline;" type="text" placeholder="nhập mã giảm giá.." id="couponValue">
            <span class="input-group-btn">
                <button class="btn btn-primary btn-apply ml-2" id="applyBtn">Áp Dụng</button>
            </span>
        </div>
        <div id="alertApply"></div>

        <div class="hr mt-5"></div>


        <div class="d-flex">
            <div class="subtotal mb-2">Tiền Topping</div>
            <div class="mr-4">{{number_format($totalPrice_Topping)}}</div><span class="mr-4">VNĐ</span>
        </div>

        <div class="d-flex">
            <div class="subtotal mb-2">Shipping</div>
            <div class="mr-4" id="ShipCost">0</div><span class="mr-4">VNĐ</span>
        </div>

        <div class="hr mt-4 mb-4"></div>

        <div class="d-flex wrapper-total">
            <div class="total-w">Tổng Cộng</div>
            <div class="mr-4 total" id="SumCost" data-total="{{$totalPrice_Topping + $totalPrice_Product}}" data-discount="0">{{number_format($totalPrice_Topping + $totalPrice_Product)}}</div><span class="mr-4 total">VNĐ</span>
        </div>


    </div>
</div>


@endsection
