@extends('main_layout') @section('content') <style>
    /* Full-width input fields */

</style>
<div class="mt-4">
    <div class="container">

         <div id="loginbox">
            <div class="panel panel-info">
               <div class="imgcontainer">
                    <h4>Đăng Nhập</h4>
               </div>
               <div style="padding-top:30px" class="panel-body">
                    <form id="loginform" method="post" action="/login">
                    <h4 style="color:red"><b id="warning_mess"></b></h4>
                        <div class="container">
                              <label for="phone"><b>Số Điện Thoại</b></label>
                              <input type="text" placeholder="Tài Khoản..." name="phone" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                              <label for="password"><b>Mật Khẩu</b></label>
                              <input type="password" placeholder="Mật Khẩu..." name="password" required>

                              <button type="submit" id="loginBtn">ĐĂNG NHẬP</button>
                         </div>
                    <!-- end input info -->
                    <div class="form-group">
                            <div class="col-md-12 control">
                                <div style="border-top: 1px solid#888;">
                                    <span class="psw" style="font-size:85%;padding-top:15px;">Chưa có tài khoản?
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()"> Đăng Ký Ngay!</a>
                                    </span>
                                </div>
                            </div>
                         </div>
                    </form>
               </div>
          </div>
     </div> <!-- end login box -->


        <div id="signupbox" style="display:none">
            <div class="panel panel-info">
               <div class="imgcontainer">
                    <h4>Đăng Ký</h4>
               </div>
               <div style="padding-top:30px" class="panel-body">
                    <form id="signupform" method="post" action="/signup">
                    <div id="alert_mess"></div>
                    {{ csrf_field() }}
                        <div class="container">
                              <label for="name"><b>Họ Tên</b></label>
                              <input type="text" placeholder="Họ Và Tên" name="name" required>

                              <label for="birthday"><b>Ngày Sinh</b></label>
                              <input type="date" placeholder="Ngày Sinh.." name="birthday" required>

                              <label for="sphone"><b>Số Điện Thoại</b></label>
                              <input type="text" placeholder="điện thoại..(9-11 số)" maxlength="11" minlength="9" name="sphone" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>

                              <label for="spassword"><b>Mật Khẩu</b></label>
                              <input type="password" maxlength="20" minlength="5" placeholder="Mật Khẩu (5-20 kí tự)" name="spassword" required>

                              <label for="email"><b>Email</b></label>
                              <input type="email" placeholder="Email.." name="email" required>

                              <input  name="_token" type="hidden" value="{{csrf_token()}}">

                              <button class="signup-submit" id="signupBtn" type="submit">ĐĂNG KÝ</button>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 control">
                                <div style="border-top: 1px solid#888;">
                                    <span class="psw" style="font-size:85%;padding-top:15px;">
                                        <a href="#" onClick="$('#signupbox').hide(); $('#loginbox').show()">Về Đăng Nhập!</a>
                                    </span>
                                </div>
                            </div>
                         </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
