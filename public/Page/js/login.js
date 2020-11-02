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

                    $('#result').append(` <form id="info_form" class="append">
                    <h3 class="cre-acc">BILLING INFORMATION</h3>
                    <div class="hr-small"></div>
                    <div class="hr" style="width: 120%"></div>
                    <label>
                        <input class="form-control in-mail" type="text" placeholder="Frist Name">
                        <span class="required"></span>
                    </label>
                    <label class="lab-2">
                        <input class="form-control in-mail in-ln" type="text" placeholder="Last Name">
                        <span class="required"></span>
                    </label>
        
                    <input class="form-control in-com mt-3" type="text" placeholder="Company">
        
                    <label class="mt-4 lab-address">
                        <input class="form-control in-mail in-add" type="text" placeholder="Address">
                        <span class="required req-add"></span>
                    </label>
                    <label class="lab-2 lab-city">
                        <input class="form-control in-city" type="text" placeholder="City">
                        <span class="required req-city"></span>
                    </label>
        
                    <label class="mt-3" style="width: 40%">
                        <input class="form-control in-mail" type="text" placeholder="Email">
                    </label>
                    <label class="lab-2 lab-city">
                        <input class="form-control in-mail in-phone" type="text" placeholder="Phone">
                        <span class="required req-phone"></span>
                    </label>
        
                    <textarea class="textarea pt-2 mt-3 form-group" name="note" id="note" cols="83" rows="5"
                        placeholder="Note.."></textarea>
        
                    <button class="btn btn-primary chkout-sub mt-4">CHECK OUT</button>
                </form>`);
                }
                else{
                    $('#result').empty();
                    $('#result').append('<h4>Đang xử lý. đi tập gym cái</h4>')
                }
            }
        });
    });

});
