$(function () {
    
});

$("#menu-toggle").click(function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

$("#user-opc-logout").click(function (e) {
    e.preventDefault();
    var parametros = {
        'x_key': 'x_key_x_idhaskjd'
    };
    $.ajax({
        url: '../controller/admin_x/logout_admin.php',
        data: parametros,
        type: "post",
        dataType: 'json',
        beforeSend: function () {
            $('#div-modals').html(`<div class="modal fade" id="Modal-Close-Session" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-md modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="row mt-5 mb-5">
                                        <div class="col-12 text-center mb-2">
                                            <div class="spinner-border text-theme"></div>
                                        </div>
                                        <div class="col-12 text-center text-modal-logout">CERRANDO SESSION...</div>
                                    </div>
                                </div>
                            </div>
                        </div>`);
            $('#Modal-Close-Session').modal('show');
        },
        success: function (data) {
            console.log(data);
            if (data.estado == 1) {
                setTimeout(function () {
                    $('#Modal-Close-Session').modal('hide');
                    window.location.href = "../";
                }, 3000);
            }
            else if (data.estado == -1) {
                alert("No se pudo cerrar session correctamente, intentelo otra vez");
            }
        },
        error: function () {
        }
    });
});

//EVALUAR SI VA

function btp_input_img_file(contenedor='.input-img-file',defaultImg,maxSize=1048576.54,widthImg=0,heightImg=0) {
    $(contenedor).before(
        function () {
            if (!$(this).prev().hasClass('input-ghost')) {
                let element = $("<input type='file' id='"+contenedor.slice(1)+"-imgfile' name='"+contenedor.slice(1)+"-imgfile' class='d-none input-ghost' accept='image/gif,image/png,image/jpeg,image/jpg'>");
                let preview = $(this).find('.img-thumbnail_container');
                let reset = $(this).find("button.btn-reset-file");

                element.attr("name", $(this).attr("name"));
                element.change(function (e) {
                    let fileName = e.target.files[0].name;
                    let fileSize = e.target.files[0].size;

                    let img = new Image();
                    img.onload = function () {
                        if (fileSize > maxSize) {
                            alertify.error('Imagen no debe exceder de: <br>'+formatBytes(maxSize));
                            reset.click();
                        }else if (this.width.toFixed(0) != widthImg && this.height.toFixed(0) != heightImg) {
                            alertify.error('Las medidas deben ser: <br>'+widthImg+'px * '+heightImg+'px');
                            reset.click();
                        }else {
                            element.next(element).find('input').val(fileName);
                            preview.find('img.img-thumbnail').attr("src", this.src);
                            // preview.show();
                            // alertify.success('Imagen cargada');
                        }
                    };
                    img.src = URL.createObjectURL(this.files[0]);
                });

                reset.click(function () {
                    element.val(null);
                    $(this).parents(contenedor).find('input').val('');
                    preview.find('img.img-thumbnail').attr("src", defaultImg);
                    // preview.hide();
                });

                $(this).find('input').css("cursor", "pointer");
                $(this).find('input').focus(function () {
                    $(this).blur();
                });
                $(this).find('input').mousedown(function () {
                    $(this).parents(contenedor).prev().click();
                    return false;
                });
                return element;
            }
        }
    );
}

function btp_set_input_img_thumbnail(contenedor='.input-img-file',urlImg,imgName){
    $(contenedor).find('input').val(imgName);
    $(contenedor).find('.img-thumbnail_container').find('img.img-thumbnail').attr("src", urlImg+imgName);
}

function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';

    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}