$(document).ready(function () {
    list_categorias();

    $('#product-sku').keypress(function(event) {
        var keyCode = event.keyCode || event.which;
        var regex = /^[0-9]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        
        if(this.value.length==10){ return false; }
        else{
            if(isValid){ return true; }
            else{ return false; }
        }
    });

    $('#close-alert').click(function() {
        $('#form-msj').hide();
    });
});

function list_categorias() {
    var parametros = {
        'option': "list_categorias"
    };
    $.ajax({
        url: '../controller/stock-controller.php',
        data: parametros,
        type: "post",
        dataType: 'json',
        beforeSend: function () {
            $("#product-categoria").html('<option value="0"> Cargando... </option>').fadeIn('slow');
        },
        success: function (data) {
            if (data.msj == 1) {
                $("#product-categoria").html(data.select_cat).fadeIn('slow');
            }else if (data.msj == 2) {
                $("#product-categoria").html(data.select_cat).fadeIn('slow');
                $("#product-categoria").attr('disabled','disabled');
            }
        },
        error: function () {
        }
    });
}

$("#form-search-inventario").submit(function (event) {
    event.preventDefault();
    var product_sku = document.getElementById('product-sku').value;
    var product_nombre = document.getElementById('product-nombre').value;
    var product_categoria = document.getElementById('product-categoria').value;
    var in_sku = product_sku.replace(/\s/g, '');
    var in_nombre = product_nombre.replace(/\s/g, '');

    if(in_sku=='' && in_nombre=='' && product_categoria==0){
        $('#form-msj').addClass('alert-info');
        $('#form-msj-text').html('Inserte por lo menos un parametro de filtrado.');
        $('#form-msj').show();
        setInterval(function(){
            $('#form-msj').hide();
        }, 5000);
    }else{
        var parametros = $(this).serialize();
        var option ='search_stock';

        $.ajax({
            url: '../controller/stock-controller.php',
            data: parametros+"&option="+option,
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $('#submit-filtrar').attr('disabled','disabled');
                $('#submit-filtrar').html('<span>Buscando...</span>');
                $('#sec-table-result').html(`<div class="row mt-5 mb-5">
                                                <div class="col-12 text-center mb-2">
                                                    <div class="spinner-border text-theme"></div>
                                                </div>
                                                <div class="col-12 text-center">Cargando...</div>
                                            </div>`);
                $('#sec-table-result').show();
            },
            success: function (data) {
                $('#submit-filtrar').attr('disabled', false);
                $('#submit-filtrar').html('<span>Buscar Productos</span>');
                if (data.msj == 1) {
                    $("#sec-table-result").html(data.table_results);
                    submit_export_table_stock();
                    checkbox_listener();
                }
                else if(data.msj == 2) {
                    $("#sec-table-result").html(data.result);
                }
            },
            error: function () {
            }
        });
    }
});

function checkbox_listener(){
    $('.checkbox-status').change(function() {
        var IDstock=$(this).attr('value');
        var identificadores = IDstock.split('-');
        
        var checked=this.checked;
        var estado=1;
        if(!checked){estado=0;}
        // alert("IDtienda: "+identificadores[0]+" codigoERP: "+identificadores[1]+" IDtallero: "+identificadores[2]+" IDtipo: "+identificadores[3]);
        var parametros = {
            "option": "change_status_stock",
            "IDtienda": identificadores[0],
            "codigoERP": identificadores[1],
            "IDtallero": identificadores[2],
            "IDtipo": identificadores[3],
            "estado": estado,
        };
        $.ajax({
            url: '../controller/stock-controller.php',
            data: parametros,
            type: "post",
            dataType: "json",
            beforeSend: function () {
            },
            success: function (data) {
                if (data.msj == 1) {
                }
                else if(data.msj == 2) {
                }
                else if(data.msj == 3) {
                }
            },
            error: function () {
            }
        });
    });
}

function submit_export_table_stock(){
    $("#form-table-stock").submit(function (event) {
        event.preventDefault();
        var filtros = document.getElementById('filters-results').value;
        var identificadores = filtros.split('|');
        window.location.href = "../controller/export_stock.php?codigoERP="+identificadores[0]+"&nombre="+identificadores[1]+"&categoria="+identificadores[2];

    });
}

$("#export-all-stock").click(function () {
    window.location.href = "../controller/export_stock.php";
});

$("#form-importar-status-stock").on('submit', function(event){
    event.preventDefault();
    $.ajax({
        url: '../controller/import_stock.php',
        type: "post",
        dataType: "json",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function () {
            $('#input-file-import').attr('disabled','disabled');
            $('.btn-import-modal').attr('disabled','disabled');
            $('#submit-import').html('<span>Importando...</span>');
        },
        success: function (data) {
            $('#msj-import').html(data.output);
            $('#form-importar-status-stock')[0].reset();
            $('#input-file-import').attr('disabled', false);
            $('.btn-import-modal').attr('disabled', false);
            $('#submit-import').html('<span>Importar</span>');
        },
        error: function () {
        }
    });
    // setInterval(function(){
    //     $('#msj-import').html('');
    // }, 5000);
});