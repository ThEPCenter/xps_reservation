$(function () {
    $("#check_email").click(function () {

        $(document).ajaxStart(function () {
            $("#check_result").html("<img src=\"../images/indicator_big.gif\">");
        });

        $.ajax({
            url: 'register/check_email',
            data: {
                register_email: $(".register_email").val()
            },
            success: function (data) {
                $("#check_result").html(data);
            }
        });

    });
    
    $(".register_email").focusout(function () {

        $(document).ajaxStart(function () {
            $("#check_result").html("<img src=\"../images/indicator_big.gif\">");
        });

        $.ajax({
            url: 'register/check_email',
            data: {
                register_email: $(".register_email").val()
            },
            success: function (data) {
                $("#check_result").html(data);
            }
        });

    });

});

