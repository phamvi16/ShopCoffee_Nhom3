$(document).ready(function() {

    $(function(){
        var dtToday = new Date();
        
        var month = dtToday.getMonth() + 1;
        var day_start = dtToday.getDate() + 1;
        var day_end = dtToday.getDate() + 2;
        var year = dtToday.getFullYear();
        var hour = dtToday.getHours();
        var minute = dtToday.getMinutes();

        if(month < 10)
            month = '0' + month.toString();
        if(day_start < 10)
            day_start = '0' + day_start.toString();
        if(day_end < 10)
            day_end = '0' + day_end.toString();
        if(minute < 10)
            minute = '0' + minute.toString();
        if(hour < 10)
            hour = '0' + hour.toString();
        
        var maxDate = year + '-' + month + '-' + day_start + 'T' + hour + ':' + minute;
        $('#Started_at').attr('min', maxDate);

        maxDate = year + '-' + month + '-' + day_end + 'T' + hour + ':' + minute;
        $('#Ended_at').attr('min', maxDate);
    });

    $("#Started_at").change(function(){
        var maxDate = $('#Started_at').val();
        if ($('#Ended_at').val() < $('#Started_at').val()) $('#Ended_at').val($('#Started_at').val());
        $('#Ended_at').attr('min', maxDate);
    });

    $("input[type='radio']").change(function()
    {
        var type = document.getElementsByName('Type')[0].checked;
        if (type == true)
        {
            document.getElementById('Value').setAttribute("Min", 0);
            document.getElementById('Value').setAttribute("Max", 50);
            $('#Value').val(50);
            $('#Value').attr('disabled', false);
        }
        else
        {
            document.getElementById('Value').setAttribute("Min", 0);
            document.getElementById('Value').setAttribute("Max", 30000);
            $('#Value').val(30000);
            $('#Value').attr('disabled', false);
        }
    });

    $(document).on("click", function()
    {
        $('#Value').attr('disabled', false);
    });

    $(document).on("change, mouseup, mousemove, keyup, keydown, keypress", function()
    {
        var maxVal = $('#Value').attr('max');
        var val = $('#Value').val();
        if (val.length >= maxVal.length)
        {
            if (val.length == maxVal.length)
            {
                if (val > maxVal)
                {
                    $('#Value').val($('#Value').attr('max'));
                    $('#Value').attr('disabled', true);
                }
            }
            else
            {
                $('#Value').val($('#Value').attr('max'));
                $('#Value').attr('disabled', true);
            }
        }
        
    });

    // $('#Value').on('keyup, keydown, keypress', function(){
    //     if ($('#Value').val() > $('#Value').attr('max').length)
    //     {
    //         $('#Value').val($('#Value').attr('max'));
    //     }
        
    // });

});