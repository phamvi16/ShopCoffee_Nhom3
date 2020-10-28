@extends('main_layout')
@section('content')

<div class="tm-main-section light-gray-bg">
    <div class="container-fluid" id="main">

        <section class="tm-section row">
            <div class="col-lg-12 tm-section-header-container margin-bottom-30">
                <h2 class="tm-section-header gold-text tm-handwriting-font"><img src={{asset("Page/img/logo.png")}} alt="Logo" class="tm-site-logo"> Our Menus</h2>
                <div class="tm-hr-container">
                    <hr class="tm-hr">
                </div>
            </div>
                <div class="col-lg-3 col-md-3 col-sm-2 mr-4">
                    <div class="tm-position-relative margin-bottom-30">
                    @foreach($all_category as $cate)
                      <div >
                        <nav class="tm-side-menu">
                            <ul>
                                    <li><a href="/menu/{{$cate->Id}}" class="active">{{$cate->Name}}</a></li>
                            </ul>
                        </nav>
                      </div>

                        @endforeach

                            <img src={{asset("Page/img/vertical-menu-bg.png")}} alt="Menu bg" class="tm-side-menu-bg " >
                    </div>
                </div>
                 <a class="menu-item" href="{{URL::to('/product-detail')}}">
                 @foreach($all_product as $pro)

                    <div class="card card-menu col-sm-3 ml-4 mb-4 m-5 ">
                        <img class="card-img-top img-menu " src="/ProductImages/Products/{{$pro -> Image}}" alt="Card image cap" >
                        <div class="card-body mt-1">
                            <h5 class="card-title">{{$pro->Name}}</h5>
                            <p class="card-text">{{$pro->Description}}</p>
                            <div class="d-flex">
                                <a href="#" data-toggle="modal" data-target="#exampleModal"class="btn btn-primary add-to-cart mr-4">ADD TO CART</a>
                                <a href="#"  class="btn btn-primary more-info ">{{$pro->Price}}</span>$</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </a>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title text-black" id="exampleModalLabel">Get A Quote</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body p-5">
                          <form action="#" method="post">
                                <div class="form-group row">
                                  <div class="col-md-6 mb-4 mb-lg-0">
                                    <input type="text" class="form-control border" placeholder="First name">
                                  </div>
                                  <div class="col-md-6">
                                    <input type="text" class="form-control border" placeholder="First name">
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <div class="col-md-12">
                                    <input type="text" class="form-control border" placeholder="Email address">
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <div class="col-md-12">
                                    <textarea name="" id="" class="form-control border" placeholder="Write your message." cols="30" rows="10"></textarea>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <div class="col-md-6 ml-auto">
                                    <input type="submit" class="btn btn-block btn-primary text-white py-3 px-5" value="Send Message">
                                  </div>
                                </div>
                              </form>
                        </div>
                      </div>
                    </div>
                  </div>
        </section>
    </div>
</div>
@endsection
