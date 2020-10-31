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

});
