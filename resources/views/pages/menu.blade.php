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
                <h2 class="tm-section-header gold-text tm-handwriting-font"><img src={{asset("Page/img/logo.png")}} alt="Logo" class="tm-site-logo"> Our Menus</h2>
                <div class="tm-hr-container">
                    <hr class="tm-hr">
                </div>
            </div>
            <div>
                <div class="col-lg-3 col-sm-2">
                    <div class="tm-position-relative margin-bottom-30">
                        <nav class="tm-side-menu">
                            <ul>
                                <li><a href="#" class="active">Affogato</a></li>
                                <li><a href="#">Caffè Americano</a></li>
                                <li><a href="#">Caffè latte</a></li>
                                <li><a href="#">Coffee milk</a></li>
                                <li><a href="#">Café mocha</a></li>
                                <li><a href="#">Cappuccino</a></li>
                                <li><a href="#">Espresso</a></li>
                                <li><a href="#">Iced coffee</a></li>
                                <li><a href="#">Instant coffee</a></li>
                                <li><a href="#">Mocha</a></li>
                                <li><a href="#">black coffee</a></li>
                            </ul>
                        </nav>
                        <img src={{asset("Page/img/vertical-menu-bg.png")}} alt="Menu bg" class="tm-side-menu-bg">
                    </div>
                </div>
                <!-- <div class="tm-menu-product-content col-lg-9 col-md-9"> -->
                <!-- menu content -->


                <!-- <a class="menu-item" href="{{URL::to('/product-detail')}}">
                        <div class="tm-product wrapper-item">
                            <img src={{asset("Page/img/menu-1.jpg")}} alt="Product">
                            <div class="tm-product-text ml-4">
                                <h3 class="tm-product-title">Americano 1</h3>
                                <p class="tm-product-description">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque. Red ipsum.</p>
                            </div>
                            <div class="tm-product-price">
                                <a href="#" class="tm-product-price-link tm-handwriting-font"><span class="tm-product-price-currency">$</span>30</a>
                            </div>
                        </div>
                    </a> -->
                <a class="menu-item" href="{{URL::to('/product-detail')}}">
                    <div class="card card-menu col-sm-3 ml-4 mb-4" style="width: 25.1rem;">
                        <img class="card-img-top img-detail img-menu" src={{asset("Page/img/special-1.jpg")}} alt="Card image cap">
                        <div class="card-body mt-1">
                            <h5 class="card-title">Name of drink</h5>
                            <p class="card-text">Some quick example text to build on the card title</p>
                            <div class="d-flex">
                                <a href="#" class="btn btn-primary add-to-cart mr-4">ADD TO CART</a>
                                <a href="#" class="btn btn-primary more-info">MORE INFO</a>
                            </div>

                        </div>
                    </div>
                </a>


                <a class="menu-item" href="{{URL::to('/product-detail')}}">
                    <div class="card card-menu col-sm-3 ml-4 mb-4" style="width: 25.1rem;">
                        <img class="card-img-top img-detail img-menu" src={{asset("Page/img/special-1.jpg")}} alt="Card image cap">
                        <div class="card-body mt-1">
                            <h5 class="card-title">Name of drink</h5>
                            <p class="card-text">Some quick example text to build on the card title</p>
                            <div class="d-flex">
                                <a href="#" class="btn btn-primary add-to-cart mr-4">ADD TO CART</a>
                                <a href="#" class="btn btn-primary more-info">MORE INFO</a>
                            </div>

                        </div>
                    </div>
                </a>
                <a class="menu-item" href="{{URL::to('/product-detail')}}">
                    <div class="card card-menu col-sm-3 ml-4 mb-4" style="width: 25.1rem;">
                        <img class="card-img-top img-detail img-menu" src={{asset("Page/img/special-1.jpg")}} alt="Card image cap">
                        <div class="card-body mt-1">
                            <h5 class="card-title">Name of drink</h5>
                            <p class="card-text">Some quick example text to build on the card title</p>
                            <div class="d-flex">
                                <a href="#" class="btn btn-primary add-to-cart mr-4">ADD TO CART</a>
                                <a href="#" class="btn btn-primary more-info">MORE INFO</a>
                            </div>

                        </div>
                    </div>
                </a>
                <a class="menu-item" href="{{URL::to('/product-detail')}}">
                    <div class="card card-menu col-sm-3 ml-4 mb-4" style="width: 25.1rem;">
                        <img class="card-img-top img-detail img-menu" src={{asset("Page/img/special-1.jpg")}} alt="Card image cap">
                        <div class="card-body mt-1">
                            <h5 class="card-title">Name of drink</h5>
                            <p class="card-text">Some quick example text to build on the card title</p>
                            <div class="d-flex">
                                <a href="#" class="btn btn-primary add-to-cart mr-4">ADD TO CART</a>
                                <a href="#" class="btn btn-primary more-info">MORE INFO</a>
                            </div>

                        </div>
                    </div>
                </a>
                <!-- </div> -->
            </div>
        </section>
    </div>
</div>
@endsection
