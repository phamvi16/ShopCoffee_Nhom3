$(document).ready(function () {
    $("#signupBtn").click(function (e) {
        e.preventDefault();

        var name = $("input[name='name']").val();
        var birthday = $("input[name='birthday']").val();
        var phone = $("input[name='sphone']").val();
        var password = $("input[name='spassword']").val();
        var email = $("input[name='email']").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/signup",
            type: 'POST',
            data: {
                name:name,
                birthday:birthday,
                phone:phone,
                password:password,
                email:email,
            },
            success: function (data) {
                if(data =="Đăng Ký Thành Công"){
                    $("#alert_mess").html("<h4 style='color:green'><b>"+data+"</b></h4>");
                }
                else{
                    $("#alert_mess").html("<h4 style='color:red'><b>"+data+"</b></h4>");
                }
            }
        });


    });

    $("#verifyBtn").click(function (e) {
        e.preventDefault();

        var phone = $("input[name='phone']").val();
        var isbought = $("input[name='isbought']:checked").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if(phone ==null || phone ==""){
            $('#result').empty();
            $('#result').append('<h4 style="color:red">Bạn Chưa Nhập Số điện thoại</h4>');
        }
        else{
            $.ajax({
                url: "/verify",
                type: 'POST',
                data: {
                    phone:phone,
                    isbought:isbought
                },
                success: function (data) {
    
                    if(data == 0){
                        $('#result').empty();
    
                        $('#result').append(` 
                    <form id="info_form" class="append">
                        <h3 class="cre-acc">BILLING INFORMATION</h3>
                        <div class="hr-small"></div>
                        <div class="hr" style="width: 120%"></div>
                        <label class="mt-3" style="width: 40%">
                            <input class="form-control in-mail" type="text" placeholder="Họ Tên" name="name" required>
                        </label>
                        <label class="lab-2 lab-city">
                            <input class="form-control in-mail in-phone" type="date" placeholder="Ngày Sinh" name="birthday" required>
                        </label>
        
            
                        <label class="mt-4 lab-address">
                            <input class="form-control in-mail in-add" type="email" placeholder="Email.." name="email" required>
                        </label>
                        <input class="form-control in-com mt-3" type="text" placeholder="Địa Chỉ.." name="address" required>

            
                        <textarea class="textarea pt-2 mt-3 form-group" name="note" id="note" cols="83" rows="5"
                            placeholder="Lời Nhắn.."></textarea>
            
                        <button class="btn btn-primary chkout-sub mt-4">CHECK OUT</button>
                     </form>`);
                    }
                    else{
                        $('#result').empty();
                        $('#result').append(`
                        <form id="info_form" class="append">
                            <h3 class="cre-acc">BILLING INFORMATION</h3>
                            <div class="hr-small"></div>
                            <div class="hr" style="width: 120%"></div>
                            <label class="mt-3" style="width: 40%">
                                <input class="form-control in-mail" type="text" placeholder="Họ Tên" name="name" value="`+data['name']+`"required>
                            </label>
                            <label class="lab-2 lab-city">
                                <input class="form-control in-mail in-phone" type="date" placeholder="Ngày Sinh" name="birthday" value ="`+data['birthday']+`"required>
                            </label>
            
                
                            <label class="mt-4 lab-address">
                                <input class="form-control in-mail in-add" type="email" placeholder="Email.." name="email" value ="`+data['email']+`"required>
                            </label>
                            <input class="form-control in-com mt-3" type="text" placeholder="Địa Chỉ.." name="address" value="`+data['address']+`" required>

                
                            <textarea class="textarea pt-2 mt-3 form-group" name="note" id="note" cols="83" rows="5"
                                placeholder="Lời Nhắn.."></textarea>
                
                            <button class="btn btn-primary chkout-sub mt-4">CHECK OUT</button>
                        </form>
                        `);
                    }
                }
            });
        } 
    });

});
