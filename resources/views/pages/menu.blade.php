@extends('main_layout')
@section('content')

<div class="tm-main-section light-gray-bg">
    <div class="container-fluid" id="main">
        <!-- <section class="tm-section row">
          <div class="col-lg-9 col-md-9 col-sm-8">
            <h2 class="tm-section-header gold-text tm-handwriting-font">Variety of Menus</h2>
            <h2>Cafe House</h2>
            <p class="tm-welcome-description">This is free HTML5 website template from <span class="blue-text">template</span><span class="green-text">mo</span>. Fndimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Ettiam sit amet orci eget eros faucibus tincidunt.</p>
            <a href="#" class="tm-more-button margin-top-30">Read More</a>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-4 tm-welcome-img-container">
            <div class="inline-block shadow-img">
              <img src="img/1.jpg" alt="Image" class="img-circle img-thumbnail">
            </div>
          </div>
        </section>        -->
        <section class="tm-section row">
            <div class="col-lg-12 tm-section-header-container margin-bottom-30">
                <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="{{asset("Page/img/logo.png")}}" alt="Logo" class="tm-site-logo"> Our Menus</h2>
                <div class="tm-hr-container">
                    <hr class="tm-hr">
                </div>
            </div>
                <div class="col-lg-3 col-sm-2">
                    <div class="tm-position-relative margin-bottom-30">
                    @foreach($all_category as $cate)
                        <nav class="tm-side-menu">
                            <ul>                      
                                    <li><a href="/menu/{{$cate->Id}}" class="active">{{$cate->Name}}</a></li>                                
                            </ul>                          
                        </nav>
                        @endforeach
                        <img src="{{asset("Page/img/vertical-menu-bg.png")}}" alt="Menu bg" class="tm-side-menu-bg">
                    </div>
                </div>
                <!-- <div class="tm-menu-product-content col-lg-9 col-md-9"> -->
                <!-- menu content -->

                 <a class="menu-item" href="{{URL::to('/product-detail')}}">
                 @foreach($all_product as $pro)
                    <div class="card card-menu col-sm-3 ml-4 mb-4 " style="width: 25.1rem;">
                        <img class="card-img-top img-menu" src="/ProductImages/Products/{{$pro -> Image}}" alt="Card image cap" >
                        <div class="card-body mt-1">
                            <h5 class="card-title"><a href="/product-detail/{{$pro->Id}}">{{$pro->Name}}</a></h5>
                            <p class="card-text">{{$pro->Description}}</p>
                            <div class="d-flex">
                                <a href="#" class="btn btn-primary add-to-cart mr-4">ADD TO CART</a>
                                <a href="#" class="btn btn-primary more-info ">{{$pro->Price}}</span>$</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </a>   
                </div>
            </div> 
            </div> 
        </section>
    </div>
</div>
@endsection
