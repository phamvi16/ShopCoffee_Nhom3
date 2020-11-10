<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shop Coffee</title>

  <link href="{{asset('Page/fonts/font_googleapis.css')}}" rel='stylesheet' type='text/css' async>
  <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel='stylesheet'  integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
  <link href="{{asset('Page/css/boostrap-4.5.2.min.css')}}" rel='stylesheet'  async>
  <!-- <link href='http://fonts.googleapis.com/css?family=Damion' rel='stylesheet' type='text/css'> -->
  <link href="{{asset('Page/css/bootstrap.min.css')}}" rel="stylesheet" async>
  <link href="{{asset('Page/css/font-awesome.min.css')}}" rel="stylesheet" async>
  <link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" rel="stylesheet">
  <link href="{{asset('Page/css/templatemo-style.css')}}" rel="stylesheet"async>
  <link href="{{asset('Page/css/main_layout.css')}}" rel="stylesheet"async>
  <link href="{{asset('Page/css/cart.css')}}" rel="stylesheet"async>
  <link href="{{asset('Page/css/menu.css')}}" rel="stylesheet"async>
  <link href="{{asset('Page/css/product-detail.css')}}" rel="stylesheet"async>
  <link href="{{asset('Page/css/checkout.css')}}" rel="stylesheet"async>
  <link href="{{asset('Page/css/sweetalert.css')}}" rel="stylesheet"async>
  <link href="{{asset('Page/css/login.css')}}" rel="stylesheet"async>
  <link href="{{asset('Page/css/myaccount.css')}}" rel="stylesheet"async>

  <link rel="shortcut icon" href="{{asset('Page/img/favicon.ico')}}" type="image/x-icon" async/>
  <!-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet"> -->


  @yield('style', '')

  </head>
  <body>
    <!-- Preloader -->
    <!-- <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div> -->
    <!-- End Preloader -->
    <div class="tm-top-header " >
      <div class="container">
        <div class="row">
          <div class="tm-top-header-inner ">
            <div class="tm-logo-container">
              <img src="{{asset('Page/img/logo.png')}}" alt="Logo" class="tm-site-logo">
              <h1 class="tm-site-name tm-handwriting-font">Cafe House</h1>
            </div>
            <div class="mobile-menu-icon">
              <i class="fa fa-bars"></i>
            </div>
            <nav class="tm-nav  " >
              <ul >
                <li><a href="{{URL::to('/trang-chu')}}" class="active">TRANG CHỦ</a></li>
                <li><a href="{{URL::to('/menu')}}">THỰC ĐƠN</a></li>
                <li><a href="{{URL::to('/gio-hang')}}">GIỎ HÀNG</a></li>
                <li><a href="{{URL::to('/lien-he')}}">LIÊN HỆ</a></li>
                  {{--<li><a href="{{URL::to('/dang-nhap')}}">ĐĂNG NHẬP</a></li>--}}
                <li>
                <div class="dropdown show">
                    @if (!session()->has('user'))
                    <a href="{{URL::to('/dang-nhap')}}" role="button" >
                       Đăng Nhập
                    </a>
                    @else
                    <a class=" dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{session()->get('user')}}
                    </a>
                    <div class=" dropdown-menu " aria-labelledby="dropdownMenuLink">
                          <a class=" dropdown-menu-color dropdown-item" role="button" id="logoutBtn"> Đăng Xuất</a>
                        <hr/>
                          <a class=" dropdown-menu-color dropdown-item" href="{{URL::to('/tai-khoan')}}">Tài khoản của tôi</a>
                        <hr/>
                          <a class=" dropdown-menu-color dropdown-item" href="#">Cài đặt</a>
                      </div>
                    @endif
                  </div>
                </li>
                <li>
                 <form action="{{URL::to('/tim-kiem')}}" method="get" class="form-inline d-flex justify-content-center md-form form-sm active-cyan-2 mt-2">

                  <input class="form-control mr-sm-2  "  name="keywords_submit"  type="text" placeholder="Nhập nội dung..." aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0 fas fa-search" style="background-color:#140718" type="submit"></button>
                </form>

              </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>


      @yield('content')

    <footer>
      <div class="tm-black-bg">
        <div class="container">
          <div class="row margin-bottom-60">
            <nav class="col-lg-3 col-md-3 tm-footer-nav tm-footer-div">
              <h3 class="tm-footer-div-title">Main Menu</h3>
              <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Directory</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Our Services</a></li>
              </ul>
            </nav>
            <div class="col-lg-5 col-md-5 tm-footer-div">
              <h3 class="tm-footer-div-title">About Us</h3>
              <p class="margin-top-15">Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet.</p>
              <p class="margin-top-15">Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus.</p>
            </div>
            <div class="col-lg-4 col-md-4 tm-footer-div">
              <h3 class="tm-footer-div-title">Get Social</h3>
              <p>Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante.</p>
              <div class="tm-social-icons-container">
                <a href="#" class="tm-social-icon"><i class="fa fa-facebook"></i></a>
                <a href="#" class="tm-social-icon"><i class="fa fa-twitter"></i></a>
                <a href="#" class="tm-social-icon"><i class="fa fa-linkedin"></i></a>
                <a href="#" class="tm-social-icon"><i class="fa fa-youtube"></i></a>
                <a href="#" class="tm-social-icon"><i class="fa fa-behance"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="container">
          <div class="row tm-copyright">
           <p class="col-lg-12 small copyright-text text-center">Copyright &copy; 2020 Cafe House</p>
         </div>
       </div>
     </div>
   </footer> <!-- Footer content-->
   <!-- JS -->
   <script type="text/javascript" src="{{asset('Page/js/jquery-1.11.2.min.js')}}"></script>      <!-- jQuery -->
   <script type="text/javascript" src="{{asset('Page/js/templatemo-script.js')}}"></script>      <!-- Templatemo Script -->


   <script type="text/javascript" src="{{asset('Page/js/jquery-3.3.1.min.js')}}"></script>
   <script type="text/javascript" src="{{asset('Page/js/jquery-ui.js')}}" async></script>
   <script type="text/javascript" src="{{asset('Page/js/popper.min.js')}}"async></script>
   <script type="text/javascript" src="{{asset('Page/js/bootstrap.min.js')}}" async></script>
   <script type="text/javascript" src="{{asset('Page/js/owl.carousel.min.js')}}"async></script>
   <script type="text/javascript" src="{{asset('Page/js/jquery.magnific-popup.min.js')}}"async></script>
   <script type="text/javascript" src="{{asset('Page/js/jquery.sticky.js')}}"async></script>
   <script type="text/javascript" src="{{asset('Page/js/jquery.waypoints.min.js')}}">async</script>
   <script type="text/javascript" src="{{asset('Page/js/jquery.animateNumber.min.js')}}"async></script>
   <script type="text/javascript" src="{{asset('Page/js/aos.js')}}"async></script>
   <script type="text/javascript" src="{{asset('Page/js/main.js')}}"async></script>
   <script type="text/javascript" src="{{asset('Page/js/sweetalert.js')}}"async></script>
   <script>
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
   </script>
   <script type="text/javascript" src="{{ asset('Page/js/addcart.js') }}"async></script>
    <script type="text/javascript" src="{{asset('Page/js/khoa.js')}}" async></script>
    <script type="text/javascript" src="{{asset('Page/js/jquery.validate.js')}}"async></script>
    @yield('script', '')
 </body>
 </html>

