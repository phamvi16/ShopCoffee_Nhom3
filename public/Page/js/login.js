$(document).ready(function () {

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
        if (phone.length < 9 || phone.length > 11) {
            $("#alert_mess").html("<h4 style='color:red'><b>Số Điện Thoài dài 9 - 11 số</b></h4>");
        } else if (password.length < 5 || password.length > 20) {
            $("#alert_mess").html("<h4 style='color:red'><b>Mật Khẩu dài 5 - 20 kí tự</b></h4>");
        } else if (!email_regex.test(email)) {
            $("#alert_mess").html("<h4 style='color:red'><b>Email Sai Định dạng</b></h4>");
        } else {
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

                    if (data == 0) {
                        $('#result').empty();

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

            
                        <textarea class="textarea pt-2 mt-3 form-group" name="note" id="note" cols="83" rows="5"
                            placeholder="Lời Nhắn.."></textarea>
            
                        <button class="btn btn-primary chkout-sub mt-4" id="checkoutBtn" >Thanh Toán</button>
                     </form>`).
                        ready(function () {
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
                                            email: email
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
                            <label class="mt-3" style="width: 40%">
                                <input class="form-control in-mail" type="text" placeholder="Họ Tên" name="name" value="` + data['name'] + `"required>
                            </label>
                            <label class="lab-2 lab-city">
                                <input class="form-control in-mail in-phone" type="date" placeholder="Ngày Sinh" name="birthday" value ="` + data['birthday'] + `"required>
                            </label>
            
                
                            <label class="mt-4 lab-address">
                                <input class="form-control in-mail in-add" type="email" placeholder="Email.." name="email" value ="` + data['email'] + `"required>
                            </label>
                            <input class="form-control in-com mt-3" type="text" placeholder="Địa Chỉ.." name="address" value="` + data['address'] + `" required>

                
                            <textarea class="textarea pt-2 mt-3 form-group" name="note" id="note" cols="83" rows="5"
                                placeholder="Lời Nhắn.."></textarea>
                
                            <button class="btn btn-primary chkout-sub mt-4" id="checkoutBtn" >Thanh Toán</button>
                        </form>
                        `).ready(function (e) {
                            $('#infor_form').submit(function (e) {
                                e.preventDefault();
                                if (!$("#infor_form").validate()) {
                                    return false;
                                };
                                // alert("cec");
                            });
                        });
                    }
                }
            });
        }
    });
    // end get thong tin -check out
    function PostCheckout(event) {
        // alert('wtf');
        event.preventDefault();

        var phone = $('input[name="getPhone"]').val();
        var name = $('input[name="name"]').val();
        var birthday = $('input[name="birthday"]').val();
        var address = $('input[name="address"]').val();
        var email = $('input[name="email"]').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        alert(phone);
        console.log("cac");
        $.ajax({
            url: "/processcheckout",
            type: 'POST',
            data: {
                name: name,
                phone: phone,
                birthday: birthday,
                address: address,
                email: email,
                test: "1"
            },
            success: function (data) {
                alert(data);
            }
        });
    };
});
