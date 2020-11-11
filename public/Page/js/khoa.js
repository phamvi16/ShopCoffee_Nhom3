$(document).ready(function () {
    function formatNumber (num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
    sessionStorage.setItem('percent','');
    $Ship1Name="Giao Tận Nơi";
    $Ship1Cost="15,000";
    $Ship2Name="Khách Đến Nhận";
    $Ship2Cost="0";
    // sign up 
    $("#signupBtn").click(function (e) {
        e.preventDefault();

        var name = $("input[name='name']").val();
        var birthday = $("input[name='birthday']").val();
        var phone = $("input[name='sphone']").val();
        var password = $("input[name='spassword']").val();
        var email = $("input[name='email']").val();
        var email_regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        
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
                        $("#alert_mess").html("<h4 style='color:red'><b>" + data + ", Liện Hệ Admin Để Biết Thêm Chi Tiết!</b></h4>");
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
        // sessionStorage.setItem('percent','');
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

                        <input class="form-control in-com mt-3" type="text" placeholder="Địa Chỉ.." name="address" required>`);
                        
                    } // end if data trống
                    else {
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

                            `);
                    } // end nếu có data

                    // --------------------- append các thông tin còn lại
                    $('#result').append(`<select class="form-control in-com mt-3" id="select_PaymentMethod">
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

                        $sum = parseInt($('#SumCost').attr('data-total'));
                        if($('#select_ShippingMethod').children('option:selected').val()==$Ship1Name){
                            $('#ShipCost').text($Ship1Cost);
                            // $('#SumCost').attr('data-total',$sum + 15000);
                            var shipcost = parseInt($('#ShipCost').text().replace(/\,/g, ''));
                            if(!sessionStorage.getItem('percent').length==0){
                                $('#SumCost').attr('data-discount',($sum+shipcost)*sessionStorage.getItem('percent')/100);
                            }
                            $('#SumCost').text(formatNumber( ($sum + shipcost  - $('#SumCost').attr('data-discount'))>0?$sum + 15000  - $('#SumCost').attr('data-discount'):0) );
                        }
                        else{
                            $('#ShipCost').text($Ship2Cost);
                            $('#SumCost').attr('data-total',$sum);
                            if(!sessionStorage.getItem('percent').length==0){
                                $('#SumCost').attr('discount',$sum*sessionStorage.getItem('percent')/100);
                            }
                            $('#SumCost').text(formatNumber($sum- $('#SumCost').attr('data-discount')));
                        }

                        $('#select_ShippingMethod').change(function() {
                            if(this.value==$Ship1Name){
                                $('#ShipCost').text($Ship1Cost);
                                var shipcost = parseInt($('#ShipCost').text().replace(/\,/g, ''));
                                $('#SumCost').attr('data-total',$sum + shipcost);
                                if(!sessionStorage.getItem('percent').length==0){
                                    $('#SumCost').attr('data-discount',($sum+shipcost)*sessionStorage.getItem('percent')/100);
                                }
                                // $('#SumCost').text(formatNumber($sum + 15000));
                            }
                            else{
                                $('#ShipCost').text($Ship2Cost);
                                $('#SumCost').attr('data-total',$sum);
                                if(!sessionStorage.getItem('percent').length==0){
                                    $('#SumCost').attr('data-discount',$sum*sessionStorage.getItem('percent')/100);
                                }
                            }
                            $('#SumCost').text(formatNumber(  ($('#SumCost').attr('data-total') - $('#SumCost').attr('data-discount'))>0?($('#SumCost').attr('data-total') - $('#SumCost').attr('data-discount')):0));
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
                                var currentdate = new Date();
                                var shipcost =0;
                                var totall = $('#SumCost').attr('data-total');
                                var discountt = $('#SumCost').attr('data-discount');
                                
                                var coupon = $('input[name="coupon"]').val();
                                
                                console.log(coupon);
                                var payment_name =$('#select_PaymentMethod').children("option:selected").text();
                                if(shipping =="Giao Tận Nơi"){
                                    shipcost=15000;
                                }

                                $('#left').empty();
                                $('#right').empty();
                                localStorage.setItem('time',120);
                                $('#left').append(`<div class="container">
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
                                                                        `+"Phone: "+phone +`
                                                                    </address>
                                                                </div>
                                                                <div class="col-xs-6 text-right">
                                                                    <address>
                                                                    `+(shipping=="Giao Tận Nơi"?`
                                                                    <strong>Giao Tới:</strong><br>
                                                                        `+address+`
                                                                    </address>'`:"")+
                                                                    `
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xs-6">
                                                                    <address>
                                                                        <strong>Hình Thức Giao Hàng:</strong><br>
                                                                        `+shipping+`<br>
                                                                    </address>
                                                                    <address>
                                                                        <strong>Hình Thức Thanh Toán:</strong><br>
                                                                        `+payment_name+`<br>
                                                                    </address>
                                                                </div>
                                                                    
                                                                <div class="col-xs-6 text-right">
                                                                    <address>
                                                                        <strong>Thời Gian Đặt Hàng:</strong><br>
                                                                        `+currentdate.toLocaleTimeString()+" Ngày "+currentdate.toLocaleDateString()+`<br><br>
                                                                    </address>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h3 class="panel-title"><strong>Chi Tiết Đơn Hàng</strong></h3>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-condensed">
                                                                            <thead>
                                                                                <tr>
                                                                                    <td><strong>Sản Phẩm</strong></td>
                                                                                    <td class="text-center"><strong>Giá</strong></td>
                                                                                    <td class="text-center"><strong>Topping</strong></td>
                                                                                    <td class="text-right"><strong>Tổng</strong></td>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="data">
                                                                                
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>`).ready(function(){
                                                    var totalCostTopping = 0;
                                                    var Total = 0;
                                                    // console.log(data);

                                                        $.each(data['cart'],function(key,value){
                                                            var subtopping =0;
                                                            var subcost = parseInt(data['cart'][key]['product_price']);
                                                            var showTopping =[];
                                                            $.each(data['cart'][key]['topping'], function( index, value ) {
                                                                subtopping+=parseInt(value);
                                                                var thistopping = data['alltopping'].find(p=>p.Id ==index);
                                                                showTopping.push(thistopping.Name);
                                                            });
                                                            subcost += subtopping;
                                                            totalCostTopping += subtopping;
                                                            Total+=subcost;
                                                            $('#data').append(`
                                                            <tr>
                                                                <td>`+data['cart'][key]['product_name']+`</td>
                                                                <td class="text-center">`+formatNumber(data['cart'][key]['product_price'])+`</td>
                                                                <td class="text-center" id="topping`+i+`">
                                                                </td>
                                                                <td class="text-right">`+formatNumber(subcost)+`</td>
                                                            </tr>
                                                            `);
                                                            for(var y = 0 ; y<showTopping.length;y++){
                                                                $('#topping'+i).append(`<div>`+showTopping[y]+`</div>`);
                                                            }
                                                        });
                                                        
                                                    
                                                    $('#data').append(`
                                                        <tr> 
                                                            <td class="thick-line"></td>
                                                            <td class="thick-line"></td>
                                                            <td class="thick-line text-center"><strong>Tổng Tiền Topping</strong><small>(đã tính vào tổng)</small></td>
                                                            <td class="thick-line text-right">`+formatNumber(totalCostTopping)+`</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line text-center"><strong>Phí Ship</strong></td>
                                                            <td class="no-line text-right">`+formatNumber(shipcost)+`</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line text-center"><strong>Coupon</strong></td>
                                                            <td class="no-line text-right">- `+formatNumber(discountt)+` VNĐ</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line text-center"><strong>Tổng Cộng</strong></td>
                                                            <td class="no-line text-right">`+formatNumber((parseInt(totall)+parseInt(shipcost)-parseInt(discountt))>0?(parseInt(totall)+parseInt(shipcost)-parseInt(discountt)):0)+` VNĐ</td>
                                                        </tr>`);
                                                });
                                $('#left').append(`<h4><b><i id="timmer">Bạn Có<span style="color:red">`+localStorage.getItem('time')+` </span> Giây Để Xác Nhận Lại Đơn Hàng. Bạn Có Muốn Hủy Đặt Hàng Không ? </i></b></h4>
                                    <button class="btn btn-danger" id="CancelOrder_Btn">Tôi Muốn Hủy</button>
                                    <button class="btn btn-success" id="SubmitOrder_Btn">Đã Xác Nhận <i class="fas fa-angle-double-right"></i> </button>`).ready(function(){
                                    $('#CancelOrder_Btn').click(function(){
                                        clearInterval(interval);
                                        $('#left').empty();
                                        $('#left').append(`<h4>Hủy Đơn Hàng Thành Công!</h4><a href="/menu">Tiếp Tục Mua Sắm</a>`);
                                    });
                                    $('#SubmitOrder_Btn').click(function(){
                                        localStorage.setItem('time',0);
                                    });

                                });
                            
                                // set count down Time
                                var interval =setInterval(CountDown,1000);
                                function CountDown(){
                                    let timeLeft = localStorage.getItem('time');
                                        localStorage.setItem('time',timeLeft-1);
                                        $('#timmer').html("Bạn Còn <span style='color:red'>"+(timeLeft>0?timeLeft:0)+" </span> Giây Để Xác Nhận Lại Đơn Hàng. Bạn Có Muốn Hủy Đơn Hàng Không ?");
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
                                                    shipping:shipping,
                                                    coupon:coupon,
                                                    discount:discountt
                                                },
                                                success: function (data) {
                                                    if(data['result']=="success"){
                                                        swal("Thành Công!", "Đặt Hàng Thành Công! Chuyển Hướng Về Menu", "success");
                                                        setTimeout(function(){
                                                            window.location.href = '/clearcart';
                                                        }, 1000);
                                                    }
                                                    else{
                                                        swal("Thất Bại!", "Đặt Hàng Thất Bại!", "error");
                                                    }
                                                }
                                            });
                                        }    
                                    }
                                
                            } else {
                                return false;
                            }
                        }); // End checkout button Event++
                    }); // -------------------------------------- ENd append các thông tin còn lại => end success (data)
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
                    if(data==1)
                        window.location.href="/menu";
                    else window.location.href="/checkout";
                }
            }
        });
    });

    $('#logoutBtn').click(function(){
        $.ajax({
            url: "/logout",
            type: 'GET',
            success: function (data) {
                if(data==1){
                    location.reload();
                }
            }
        });
    });  

    $('#applyBtn').click(function(){
        var coupon = $('input[id="couponValue"]').val();
        if(coupon==null || coupon==""){
            $('#alertApply').empty();
            $('#alertApply').append('<p style="color:red">Bạn Chưa Nhập Coupon</p>');
        }
        else{
            $.ajax({
                url: "/applycoupon",
                type: 'POST',
                data:{
                    coupon:coupon
                },
                success: function (data) {
                    if(data==0){
                        $('#alertApply').empty();
                        $('#alertApply').append('<p style="color:red">Coupon không có giá trị</p>');
                    }
                    else{
                        var currency ="";
                        // var sum  = parseInt($('#SumCost').text().replace(/\,/g, ''));
                        var sum= $('#SumCost').attr('data-total');
                        var shipcost = parseInt($('#ShipCost').text().replace(/\,/g, ''));

                        if(data['Type']=="Percent"){ // phantram
                            currency ="%";        
                            $('#SumCost').attr('data-discount',data['Value']*(parseInt(shipcost)+parseInt(sum))/100);
                            sessionStorage.setItem('percent',data['Value']);
                        }
                        else if(data['Type']=="Fixed"){ // tien
                            currency="VNĐ";
                            $('#SumCost').attr('data-discount',data['Value']);
                        }
                        $('input[name="coupon"]').val(data['Id']);
                        alert($('input[name="coupon"]').val());
                        $('#SumCost').text(formatNumber( ( parseInt(shipcost)+ $('#SumCost').attr('data-total') - $('#SumCost').attr('data-discount'))>0?(parseInt(shipcost)+ parseInt($('#SumCost').attr('data-total')) - parseInt($('#SumCost').attr('data-discount'))):0));

                        $('#coupon-form').hide();
                        $('#alertApply').empty();
                        $('#alertApply').append(`<p style="color:green">Áp Dụng Coupon Thành Công. <span style="color:#a86319">Được Giảm `+ formatNumber(data['Value'])+" "+currency+`</span></p>`);

                    }
                }
            });
        }
    });
});
