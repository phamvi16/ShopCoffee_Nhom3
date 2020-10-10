@extends('main_layout')
@section('content')


<div class="container">
    <div class="col-xs-12 col-sm-6">
        <img class="img-detail" src="https://media3.s-nbcnews.com/j/newscms/2019_33/2203981/171026-better-coffee-boost-se-329p_67dfb6820f7d3898b5486975903c2e51.fit-760w.jpg" alt="">
    </div>
    <div class="col-sm-6 product-right">
        <h2 class="product-name">Name of drink</h2>
        <div>
            <span class="price">Amount of sugar: </span>
            <input class="input pl-3" type="text">
        </div>


        <div>
            <span class="price">Ice: </span>
            <input class="input pl-3" type="text">
        </div>


        <div>
            <span class="price">Price: </span>
            <span>30.000 VNĐ</span>
        </div>


    </div>
</div>


@endsection
