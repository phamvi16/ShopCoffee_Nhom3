$(document).ready(function () {
    function formatNumber (num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }

    $Ship1Name="Giao Tận Nơi";
    $Ship1Cost="15,000 VNĐ";
    $Ship2Name="Khách Đến Nhận";
    $Ship2Cost="0 VNĐ";
    // sign up 
    $("#signupBtn").click(function (e) {
        e.preventDefault();

        var name = $("input[name='name']").val();
        var birthday = $("input[name='birthday']").val();
        var phone = $("input[name='sphone']").val();
        var password = $("input[name='spassword']").val();
        var email = $("input[name='email']").val();
        var email_regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
                                $('#select_PaymentMethod').append(`<option value="`+data['all_paymentmethod'][i]+`">`+data['all_paymentmethod'][i].Name+`</option>`);
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
  
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });

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
                                $('#select_PaymentMethod').append(`<option value="`+data['all_paymentmethod'][i]+`">`+data['all_paymentmethod'][i].Name+`</option>`);
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

                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
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
