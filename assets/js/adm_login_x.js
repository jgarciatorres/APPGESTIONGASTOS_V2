
$("#f_login_usuario").submit(function (event) {
    event.preventDefault();
    var parametros = $(this).serialize();
    $.ajax({
        url: "controller/admin_x/login_admin.php",
        data: parametros,
        type: "post",
        dataType: "json",
        beforeSend: function () {
        },
        success: function (data) {
            console.log(data);
            console.log(data.estado);
            if (data.estado == 1) {
                window.location.href = "views/home.php";
            }
            else{
               alert(data.mensaje);
            }
        },
        error: function () {
        }
    });
});