//funcion de logueo
$("#form-login-user").submit(function (event) {
    event.preventDefault();
    var parametros = $(this).serialize();
    var option ='';

    if(document.getElementById('login-email-btn')){
        var option ='login_send_code';
    }else if(document.getElementById('login-code-btn')){
        var option ='login_admin';
    }else if(document.getElementById('login-volver-btn')){
        var option ='login_volver';
    }
    
    $.ajax({
        url: "controller/user-control.php",
        data: parametros+"&option="+option,
        type: "post",
        dataType: "json",
        beforeSend: function () {
            if(option=='login_send_code'){
                $("#login-input-email").attr('readonly','readonly');
                $("#login-email-btn").html('<div class="div-spinner"><div class="spinner-border"></div></div>');
                $("#login-email-btn").attr('disabled','disabled');
            }
            if(option=='login_admin'){
                $("#login-input-code").attr('readonly','readonly');
                $("#login-code-btn").html('<div class="div-spinner"><div class="spinner-border"></div></div>');
                $("#login-code-btn").attr('disabled','disabled');
            }
            if(option=='login_volver'){
                $("#login-volver-btn").html('<div class="div-spinner"><div class="spinner-border"></div></div>');
                $("#login-volver-btn").attr('disabled','disabled');
            }
        },
        success: function (data) {
            if (data.msj == 1) {
                if(option=='login_admin'){
                    window.location.href = "views/home.php";
                }else{
                    $("#form-login-user").html(data.new_form);
                }
            }
            else if(data.msj == 2) {
                if(option=='login_admin'){
                    $("#login-msj-code").html(data.msj_form);
                    $("#login-code-btn").html('Reintentar');
                    $("#login-code-btn").prop("disabled", false);;
                }else{
                    $("#form-login-user").html(data.new_form);
                }
            }
            else if(data.msj == 3) {
                $("#form-login-user").html(data.new_form);
            }
        },
        error: function () {

        }
    });
});