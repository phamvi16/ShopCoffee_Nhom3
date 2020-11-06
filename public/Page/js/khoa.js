$(document).ready(function () {
    function formatNumber (num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }

    $Ship1Name="Giao Tận Nơi";
    $Ship1Cost="15,000 VNĐ";
    $Ship2Name="Khách Đến Nhận";
    $Ship2Cost="0 VNĐ";
    let timeLeft = 10;
    // sign up 
    $("#signupBtn").click(function (e) {
        e.preventDefault();

        var name = $("input[name='name']").val();
        var birthday = $("input[name='birthday']").val();
        var phone = $("input[name='sphone']").val();
        var password = $("input[name='spassword']").val();
        var email = $("input[name='email']").val();
        var email_regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        if(name.length==0){
            $("#alert_mess").html("<h4 style='color:red'><b>Bạn Chưa nhập Tên</b></h4>");
        }
        else if(birthday.length==0){
            $("#alert_mess").html("<h4 style='color:red'><b>Vui Lòng Chọn Ngày Sinh</b></h4>");
        }
        else if (phone.length < 9 || phone.length > 11) {
            $("#alert_mess").html("<h4 style='color:red'><b>Số Điện Thoài dài 9 - 11 số</b></h4>");
        } else if (password.length < 5 || password.length > 20) {
            $("#alert_mess").html("<h4 style='color:red'><b>Mật Khẩu dài 5 - 20 kí tự</b></h4>");
        } else if (!email_regex.test(email)) {
            $("#alert_mess").html("<h4 style='color:red'><b>Email Sai Định dạng</b></h4>");
        } 
        else {
            $.ajax({
                url: "/signup",
                type: 'POST',
                data: {
                    name: name,
                    birthday: birthday,
                    phone: phone,
                    password: password,
                    email: email,
                },
                success: function (data) {
                    if (data == "Đăng Ký Thành Công") {
                        swal("Thành Công!", "Bạn Đã Đăng Ký Thành Công!", "success");
                        $("#alert_mess").html("<h4 style='color:green'><b>" + data + "</b></h4>");
                    } else {
                        $("#alert_mess").html("<h4 style='color:red'><b>" + data + "</b></h4>");
                    }
                }
            });

        }

    });
    // end sign up

    // validate phone in checkout
    $('input[name="phone"]').change(function () {
        if (!($('input[name="getPhone"]').val() == null)) {
            $('input[name="getPhone"]').val($('input[name="phone"]').val());
        } else {
            console.log('chua co bang');
        }
    });
    // end validate phone
    // get thong tin - checkout
    $("#verifyBtn").click(function (e) {
        e.preventDefault();

        var phone = $("input[name='phone']").val();
        var isbought = $("input[name='isbought']:checked").val();

        if (phone == null || phone == "") {
            $('#result').empty();
            $('#result').append('<h4 style="color:red">Bạn Chưa Nhập Số điện thoại</h4>');
        }
        if (phone.length < 9 || phone.length > 11) {
            $('#result').empty();
            $('#result').append('<h4 style="color:red">Số Điện Thoài dài 9 - 11 số</h4>');
        } else {
            $.ajax({
                url: "/verify",
                type: 'POST',
                data: {
                    phone: phone,
                    isbought: isbought
                },
                success: function (data) {

                    if (data['isBought'] == 0) {
                        $('#result').empty(); 
                        // console.log(data['all_paymentmethod']);
                        if(data['TryGetVal']==1){
                            $("#result").append("<p style='color:red'>Không Thể Tìm Thấy Dữ Liệu</p>");
                        }
                        $('#result').append(` 
                        <h3 class="cre-acc">BILLING INFORMATION</h3>
                    <form id="info_form" class="append" method="post" action="/processcheckout">
                       
                        <div class="hr-small"></div>
                        <div class="hr" style="width: 120%"></div>
                        <input name="getPhone" type="hidden" value="` + phone + `" >
                        <label class="mt-4">
                            <input class="form-control in-mail" type="text" placeholder="Họ Tên" name="name" required>
                        </label>

                        <label class="mt-4 lab-address">
                            <input class="form-control in-mail in-add" type="date" placeholder="Ngày Sinh" name="birthday" required>
                        </label>
        
            
                        <label class="mt-4 lab-address">
                            <input class="form-control in-mail in-add" type="email" placeholder="Email.." name="email" required>
                        </label>

                        <input class="form-control in-com mt-3" type="text" placeholder="Địa Chỉ.." name="address" required>

                        <select class="form-control in-com mt-3" id="select_PaymentMethod" name="payment">
                        </select>

                        <select class="form-control in-com mt-3" id="select_ShippingMethod" name="shipping">
                            <option vale="Giao Tận nơi" >Giao Tận Nơi</option>
                            <option value="Khách Đến Nhận">Khách Đến Nhận</option>
                        </select>


                        <textarea class="textarea pt-2 mt-3 form-group" name="note" id="note" cols="83" rows="5"
                            placeholder="Lời Nhắn.."></textarea>
            
                        <button class="btn btn-primary chkout-sub mt-4" id="checkoutBtn" >Thanh Toán</button>
                     </form>`).
                        ready(function () {
                            $sum = $('#SumCost').data('value');
                            if($('#select_ShippingMethod').children('option:selected').val()==$Ship1Name){
                                $('#ShipCost').text($Ship1Cost);
                                $('#SumCost').text(formatNumber( $sum + 15000) + "VNĐ");
                            }
                            else{
                                $('#ShipCost').text($Ship2Cost);
                                $('#SumCost').text(formatNumber($sum) + "VNĐ");
                            }

                            $('#select_ShippingMethod').change(function() {
                                if(this.value==$Ship1Name){
                                    $('#ShipCost').text($Ship1Cost);
                                    $('#SumCost').text(formatNumber($sum + 15000) + "VNĐ");
                                }
                                else{
                                    $('#ShipCost').text($Ship2Cost);
                                    $('#SumCost').text(formatNumber($sum) + "VNĐ");
                                }
                              });

                            for(var i = 0;i<data['all_paymentmethod'].length;i++){
                                $('#select_PaymentMethod').append(`<option value="`+data['all_paymentmethod'][i].Id+`">`+data['all_paymentmethod'][i].Name+`</option>`);
                            }
                            $('#checkoutBtn').click(function (e) {
                                e.preventDefault();
                                if ($('#info_form').validate({
                                        rules: {
                                            name: {
                                                required: true
                                            },
                                            email: {
                                                required: true,
                                                email: true
                                            },
                                            address: {
                                                required: true
                                            },
                                            birthday: {
                                                required: true
                                            }
                                        },
                                        messages: {
                                            name: {
                                                required: "Vui Lòng Nhập họ Tên"
                                            },
                                            email: {
                                                required: "vui Lòng nhập email",
                                                email: "Email sai định dạng"
                                            },
                                            address: {
                                                required: "Vui Lòng nhập Địa Chỉ"
                                            },
                                            birthday: {
                                                required: "Vui Lòng Nhập Ngày"
                                            }
                                        },
                                        highlight: function (element) {
                                            $(element).parent().addClass('errorLog')
                                        },
                                        unhighlight: function (element) {
                                            $(element).parent().removeClass('errorLog')
                                        }
                                    }).form()) {
                                    var phone = $('input[name="getPhone"]').val();
                                    var name = $('input[name="name"]').val();
                                    var birthday = $('input[name="birthday"]').val();
                                    var address = $('input[name="address"]').val();
                                    var email = $('input[name="email"]').val();
                                    var payment = $('#select_PaymentMethod').children("option:selected").val();
                                    var shipping = $('#select_ShippingMethod').children("option:selected").val();
  
                                    $.ajax({
                                        url: "/processcheckout",
                                        type: 'POST',
                                        data: {
                                            name: name,
                                            phone: phone,
                                            birthday: birthday,
                                            address: address,
                                            email: email,
                                            payment:payment,
                                            shipping:shipping

                                        },
                                        success: function (data) {
                                            alert(data);
                                        }
                                    });
                                } else {
                                    return false;
                                }
                            });
                        });
                    } else {
                        $('#result').empty();
                        $('#result').append(`
                        <form id="info_form" class="append" method="post" >
                            <h3 class="cre-acc">BILLING INFORMATION</h3>
                            <div class="hr-small"></div>
                            <div class="hr" style="width: 120%"></div>
                            <input name="getPhone" type="hidden" value="` + phone + `" ">
                            <label class="mt-4" for="name">
                                <input class="form-control in-mail" type="text" placeholder="Họ Tên" name="name" value="` + data['name'] + `"required style="background:#a5e8c1">
                            </label>
                            <label class="mt-4 lab-address" for="birthday">
                                <input class="form-control in-mail in-add" type="date" placeholder="Ngày Sinh" name="birthday" value ="` + data['birthday'] + `"required style="background:#a5e8c1">
                            </label>
            
                        
                            <label class="mt-4 lab-address" for="email">
                                <input class="form-control in-mail in-add" type="email" placeholder="Email.." name="email" value ="` + data['email'] + `" style="background:#a5e8c1" >
                            </label>
                            <input class="form-control in-com mt-3" type="text" placeholder="Địa Chỉ.." name="address" value="` + data['address'] + `" required style="background:#a5e8c1">

                            <select class="form-control in-com mt-3" id="select_PaymentMethod">
                            </select>    

                            <select class="form-control in-com mt-3" id="select_ShippingMethod">
                                <option vale="Giao Tận nơi" >Giao Tận Nơi</option>
                                <option value="Khách Đến Nhận">Khách Đến Nhận</option>
                            </select>
                            
                            <textarea class="textarea pt-2 mt-3 form-group" name="note" id="note" cols="83" rows="5"
                                placeholder="Lời Nhắn.."></textarea>
                
                            <button class="btn btn-primary chkout-sub mt-4" id="checkoutBtn" >Thanh Toán</button>
                        </form>
                        `).ready(function () {

                            $sum = $('#SumCost').data('value');
                            if($('#select_ShippingMethod').children('option:selected').val()==$Ship1Name){
                                $('#ShipCost').text($Ship1Cost);
                                $('#SumCost').text(formatNumber( $sum + 15000) + "VNĐ");
                            }
                            else{
                                $('#ShipCost').text($Ship2Cost);
                                $('#SumCost').text(formatNumber($sum) + "VNĐ");
                            }

                            $('#select_ShippingMethod').change(function() {
                                if(this.value==$Ship1Name){
                                    $('#ShipCost').text($Ship1Cost);
                                    $('#SumCost').text(formatNumber($sum + 15000) + "VNĐ");
                                }
                                else{
                                    $('#ShipCost').text($Ship2Cost);
                                    $('#SumCost').text(formatNumber($sum) + "VNĐ");
                                }
                              });

                            for(var i = 0;i<data['all_paymentmethod'].length;i++){
                                $('#select_PaymentMethod').append(`<option value="`+data['all_paymentmethod'][i].Id+`">`+data['all_paymentmethod'][i].Name+`</option>`);
                            }
                            
                            $('#checkoutBtn').click(function (e) {
                                e.preventDefault();
                                if ($('#info_form').validate({
                                        rules: {
                                            name: {
                                                required: true
                                            },
                                            email: {
                                                required: true,
                                                email: true
                                            },
                                            address: {
                                                required: true
                                            },
                                            birthday: {
                                                required: true
                                            }
                                        },
                                        messages: {
                                            name: {
                                                required: "Vui Lòng Nhập họ Tên"
                                            },
                                            email: {
                                                required: "vui Lòng nhập email",
                                                email: "Email sai định dạng"
                                            },
                                            address: {
                                                required: "Vui Lòng nhập Địa Chỉ"
                                            },
                                            birthday: {
                                                required: "Vui Lòng Nhập Ngày"
                                            }
                                        },
                                        highlight: function (element) {
                                            $(element).parent().addClass('errorLog')
                                        },
                                        unhighlight: function (element) {
                                            $(element).parent().removeClass('errorLog')
                                        }
                                    }).form()) {
                                    var phone = $('input[name="getPhone"]').val();
                                    var name = $('input[name="name"]').val();
                                    var birthday = $('input[name="birthday"]').val();
                                    var address = $('input[name="address"]').val();
                                    var email = $('input[name="email"]').val();
                                    var payment = $('#select_PaymentMethod').children("option:selected").val();
                                    var shipping = $('#select_ShippingMethod').children("option:selected").val();
                                    $('#left').empty();
                                    $('#right').empty();
                                    localStorage.setItem('time',120);
                                    $('#left').append(`<h4><b><i id="timmer">Bạn Cón <span style="color:red">`+localStorage.getItem('time')+` </span>Giây Để Xác Nhận Đơn Hàng </i></b></h4>
                                                        <button class="btn btn-danger" id="CancelOrder_Btn">Hủy Đơn Hàng</button>
                                                        <button class="btn btn-success" id="SubmitOrder_Btn">Xác Nhận Đơn Hàng </button>
                                                        
                                                        <div class="container">
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div class="invoice-title">
                                                                    <h2>Cafe House</h2><h3 class="pull-right">New Order</h3>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-xs-6">
                                                                        <address>
                                                                        <strong>Khách Hàng :</strong><br>
                                                                            `+name+`<br>
                                                                            `+address+`
                                                                        </address>
                                                                    </div>
                                                                    <div class="col-xs-6 text-right">
                                                                        <address>
                                                                        <strong>Giao Tới:</strong><br>
                                                                            `+name+`<br>
                                                                            `+address+`
                                                                        </address>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-6">
                                                                        <address>
                                                                            <strong>Hình Thức Giao Hàng:</strong><br>
                                                                            `+shipping+`<br>
                                                                        </address>
                                                                    </div>
                                                                    <div class="col-xs-6 text-right">
                                                                        <address>
                                                                            <strong>Order Date:</strong><br>
                                                                            March 7, 2014<br><br>
                                                                        </address>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <h3 class="panel-title"><strong>Order summary</strong></h3>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-condensed">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <td><strong>Item</strong></td>
                                                                                        <td class="text-center"><strong>Price</strong></td>
                                                                                        <td class="text-center"><strong>Quantity</strong></td>
                                                                                        <td class="text-right"><strong>Totals</strong></td>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                                                    <tr>
                                                                                        <td>BS-200</td>
                                                                                        <td class="text-center">$10.99</td>
                                                                                        <td class="text-center">1</td>
                                                                                        <td class="text-right">$10.99</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>BS-400</td>
                                                                                        <td class="text-center">$20.00</td>
                                                                                        <td class="text-center">3</td>
                                                                                        <td class="text-right">$60.00</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>BS-1000</td>
                                                                                        <td class="text-center">$600.00</td>
                                                                                        <td class="text-center">1</td>
                                                                                        <td class="text-right">$600.00</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="thick-line"></td>
                                                                                        <td class="thick-line"></td>
                                                                                        <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                                                                        <td class="thick-line text-right">$670.99</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="no-line"></td>
                                                                                        <td class="no-line"></td>
                                                                                        <td class="no-line text-center"><strong>Shipping</strong></td>
                                                                                        <td class="no-line text-right">$15</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="no-line"></td>
                                                                                        <td class="no-line"></td>
                                                                                        <td class="no-line text-center"><strong>Total</strong></td>
                                                                                        <td class="no-line text-right">$685.99</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        `).ready(function(){
                                        $('#CancelOrder_Btn').click(function(){
                                            clearInterval(interval);
                                            $('#left').empty();
                                            $('#left').append(`<h4>Hủy Đơn Hàng Thành Công!</h4><a href="/menu">Tiếp Tục Mua Sắm</a>`);
                                        });
                                        $('#SubmitOrder_Btn').click(function(){
                                            localStorage.setItem('time',0);
                                        });

                                    });
                                

                                    // $('#timmer').html("cec");
                                    
                                    var interval =setInterval(CountDown,1000);
                                    function CountDown(){
                                        let timeLeft = localStorage.getItem('time');
                                            localStorage.setItem('time',timeLeft-1);
                                            $('#timmer').html("Bạn Cón <span style='color:red'>"+(timeLeft>0?timeLeft:0)+" </span> Giây Để Xác Nhận Đơn Hàng");
                                            if(timeLeft<=0){
                                                
                                                clearInterval(interval);
                                                $.ajax({
                                                    url: "/processcheckout",
                                                    type: 'POST',
                                                    data: {
                                                        name: name,
                                                        phone: phone,
                                                        birthday: birthday,
                                                        address: address,
                                                        email: email,
                                                        payment:payment,
                                                        shipping:shipping
                                                    },
                                                    success: function (data) {
                                                        if(data['result']=="success"){
                                                            swal("Thành Công!", "Đặt Hàng Thành Công! Chuyển Hướng Về Menu", "success");
                                                            setTimeout(function(){
                                                                window.location.href = '/menu';
                                                             }, 1000);
                                                        }
                                                        else{
                                                            swal("Thất Bại!", "Đặt Hàng Thất Bại!", "error");
                                                        }
                                                       
                                                    }
                                                });
                                            }    
                                        }
                                        // $.ajax({
                                        //     url: "/processcheckout",
                                        //     type: 'POST',
                                        //     data: {
                                        //         name: name,
                                        //         phone: phone,
                                        //         birthday: birthday,
                                        //         address: address,
                                        //         email: email,
                                        //         payment:payment,
                                        //         shipping:shipping
                                        //     },
                                        //     success: function (data) {
                                        //         alert(data);
                                        //     }
                                        // });
                                    
                                } else {
                                    return false;
                                }
                            });
                        });
                    }
                }
            });
        }
    });
    
    // end get thong tin -check out
    //login ajax
    $('#loginBtn').click(function(e){
        e.preventDefault();
        var phone = $("input[name='phone']").val();
        var password = $("input[name='password']").val();

        $.ajax({
            url: "/login",
            type: 'POST',
            data: {
                phone: phone,
                password: password,
            },
            success: function (data) {
                if(data==0){
                    $('#warning_mess').text("Đăng Nhập Thất Bại! vui Lòng Kiểm Tra Lại Tài Khoản/Mật Khẩu");
                }
                else{
                    $('#warning_mess').text("");
                    alert("success + redirect");
                }
            }
        });
    });
});
