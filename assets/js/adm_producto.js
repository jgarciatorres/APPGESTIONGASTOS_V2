const IMG_RUTA_P01 = `../../assets/upload/producto/`;
const IMG_RUTA_P02 = `../../assets/upload/textura/`;

function miOpenAndClosedContent(objeto){
    var closeado = document.getElementById(objeto).style;
    if(closeado.display === 'none'){
      closeado.display = 'block';
    }else{
      closeado.display = 'none';
    }
}

function getProductsList(desde = 0, hasta = 100){
    let tabla_body = document.getElementById("tbody_cargar");
    $.ajax({
        type: "POST",
        url: "../controller/producto/getProductsList.php",
        data: {desde: desde, hasta: hasta},
        beforeSend: function () {
            miOpenAndClosedContent("my_capa_negra_tabla");
        },
        success: function (info) {
            //console.log(info);
            tabla_body.innerHTML = ``;
            let mi_json = JSON.parse(info);
            console.log(mi_json);
            if(mi_json.estado == 1 ){
                //<i class="fas fa-check-square"></i>
                window.ns_contador.paginacion(mi_json.paginacion);
                mi_json.lista.forEach(mi_sku => {
                    tabla_body.innerHTML += `
                    <tr id="pro_identity_` + mi_sku.IDproducto + `"  ` + ( mi_sku.vitrina == 0 ? ` style="color:gray;" ` : ``) + `  >
                        <td class="mi_celda_boton p-1">
                            <button type="button" class="btn btn-sm btn-theme-plane" title="Editar" onclick="onProductEditable(this)" ><i class="fas fa-pencil-alt"></i></button>
                            <button type="button" class="btn btn-sm btn-` + ( mi_sku.vitrina == 1 ? `danger` : `success`) + `" 
                                title="` + ( mi_sku.vitrina == 1 ? `Desactivar` : `Activar`) + `" onclick="onProductDelete(this,` + (mi_sku.vitrina == 1 ? 0 : 1) + `)" >
                                <i class="fas ` + ( mi_sku.vitrina == 1 ? `fa-minus-circle` : `fa-check-circle`) + `"></i></button>
                        </td>
                        <td class="p-1">` + (mi_sku.imagen != null ? `<img width="30" src="` + IMG_RUTA_P01 + mi_sku.imagen + `"/>` : `<a href="adm_imagen.php?sku=`+ mi_sku.sku +`">Subir Imagen</a>` ) + `</td>
                        <td class="p-1">` + (mi_sku.textura != "" && mi_sku.textura != null ? `<img width="30" src="` + IMG_RUTA_P02 + mi_sku.textura + `"/>` : `<a href="adm_textura.php?sku=`+ mi_sku.sku +`">Cortar Textura</a>` ) +`</td>
                        <td class="p-1">` + mi_sku.subcategoria + `</td>
                        <td class="p-1">` + (mi_sku.modelo == null ? '- ' : mi_sku.modelo) + `</td>
                        <td class="p-1">` + mi_sku.linea + `</td>
                        <td class="p-1 sticky-table-column">` + mi_sku.sku + `</td>
                        <td class="p-1">` + mi_sku.tallero + `</td>
                        <td class="p-1 mi_celda_nombre">` + mi_sku.nombre + `</td>
                        <td class="p-1 mi_celda_nombre">` + mi_sku.nombreurl + `</td>
                        <td class="p-1 texto_sobrecargado"><div class="mi_contenedor">` + mi_sku.descripcion  + `</div></td>
                        <td class="p-1">` + mi_sku.precio + `</td>
                        <td class="p-1">` + mi_sku.dcto + `</td>
                        <td class="p-1">` + mi_sku.precio_c_dcto + `</td>
                        <td class="p-1">` + (mi_sku.fecha_comercial == null ? '-' : mi_sku.fecha_comercial)+ `</td>
                        <td class="p-1">` + (mi_sku.bota == null ? '- ' : mi_sku.bota) + `</td>
                        <td class="p-1">` + (mi_sku.manga == null ? '- ' : mi_sku.manga) + `</td>
                        <td class="p-1">` + (mi_sku.entalle == null ? '- ' : mi_sku.entalle) + `</td>
                        <td class="p-1">` + (mi_sku.color == null ? '-' : mi_sku.color)  + `</td>
                        <td class="p-1">` + (mi_sku.color_referencia == null ? '-' : mi_sku.color_referencia)  + `</td>
                        <td class="p-1">` + (mi_sku.new == "1" ? "Si" : "No") + `</td>
                        <td class="p-1">` + (mi_sku.cuero == "1" ? "Si" : "No") + `</td>
                    </tr>`;
                
                });
                $('.table-responsive').doubleScroll({
                    resetOnWindowResize: true
                });
            }else if(mi_json.estado == 2 ){
                tabla_body.innerHTML = ``;
            }
            miOpenAndClosedContent("my_capa_negra_tabla");
        },
        error: function () {
            console.log("Error");
        }
    });
}

document.getElementById("btn_producto_importar").onclick = function(event){
    console.log("i");
    $("#mi_modal_importar_productos").modal('show');
};

document.getElementById("btn_producto_exportar").onclick = function(event){
    console.log("e");
    //$("#mi_modal_importar_productos").modal('show');
    window.location.href = "../controller/producto/exportarProducto.php";
};

document.getElementById("btn_producto_nuevo").onclick = function(event){
    //let objeto = event.target;
    $("#btn_producto_nuevo").attr("disabled", true);
    $("#btn_producto_guardar").attr("disabled", false);
    $("#btn_producto_cancelar").attr("disabled", false);
    $("#btn_producto_importar").attr("disabled", true);
    $("#btn_producto_exportar").attr("disabled", true);
};

document.getElementById("btn_producto_cancelar").onclick = function(){
    $("#btn_producto_nuevo").attr("disabled", false);
    $("#btn_producto_guardar").attr("disabled", true);
    $("#btn_producto_cancelar").attr("disabled", true);
    $("#btn_producto_importar").attr("disabled", false);
    $("#btn_producto_exportar").attr("disabled", false);

    onResetFormulario();
};

document.getElementById("mi_btn_anterior").onclick = function(){
    window.ns_contador.anterior(); 
};

document.getElementById("mi_btn_siguiente").onclick = function(){
    window.ns_contador.siguiente(); 
};


document.getElementById("btn_producto_importar_excel").onclick = function(){
    let archivos = dropzone.files.length;
    let mi_mensaje_importacion = document.getElementById("pro_mensaje_importacion");
    if(archivos > 0 ){
       
        let mi_form_data = new FormData();

        for (let i = 0; i < archivos; i++) {
            mi_form_data.append('files[]', dropzone.files[i]);
        }
        $.ajax({
            type: "POST",
            url: "../controller/producto/importarProducto.php",
            contentType: false,
            processData: false,
            data: mi_form_data,
            beforeSend: function () {
            },
            success: function (info) {
                console.log(info);
                dropzone.removeAllFiles();
                mi_mensaje_importacion.innerText = info;
            },
            error: function () {
                console.log("Error");
            }
        });
    }else{
        console.log("No contiene archivos, seleccione un archivo .xls");
        mi_mensaje_importacion.innerText = "No contiene archivos, seleccione un archivo .xls";
    }
};

function seleccionarComboPorTexto(id, texto){
    var eid = document.getElementById(id);
    var devolucion = false;
    for (var i = 0; i < eid.options.length; ++i) {
        if(eid.options[i].text === texto){
          eid.options[i].selected = true;
          devolucion = true;
          break;
        }
    }
    return devolucion;
}

function seleccionarComboPorTextoNuevo(id, texto){
    var eid = document.getElementById(id);
    var devolucion = false;
    for (var i = 0; i < eid.options.length; ++i) {
        //console.log(eid.options[i].text + "-" + texto + "-" + eid.options[i].text.indexOf(texto));
        if(eid.options[i].text.indexOf(texto) > -1){
          eid.options[i].selected = true;
          devolucion = true;
          break;
        }
    }
    return devolucion;
}

function validacionEspecial(e){
    var tecla = (document.all) ? e.keyCode : e.which;
    tecla = String.fromCharCode(tecla)
    return /^\d|\-|\*|\/$/.test(tecla);
  }
  
  function validacionNumero(e){
    var tecla = (document.all) ? e.keyCode : e.which;
    tecla = String.fromCharCode(tecla)
    return /^\d$/.test(tecla);
  }
  
  function validacionLetra(e){
    var tecla = (document.all) ? e.keyCode : e.which;
    tecla = String.fromCharCode(tecla)
    return /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]$/.test(tecla);
  }
  


function onProductDelete(objeto, value){
    let mensaje_modal = "";
    if(value==1){
        mensaje_modal ="¿Deseas activar el producto?";
    }else{
        mensaje_modal ="¿Deseas desactivar el producto?";
    }

    alertify.confirm(mensaje_modal, function (param1) {
        console.log("si");
        let entidad = $(objeto).parent().parent().attr('id');
        $.ajax({
            type: "POST",
            url: "../controller/producto/desactivarProducto.php",
            data: { entidad: entidad, valor: value},
            beforeSend: function () {
            },
            success: function (info) {
                console.log(info);
                let mi_json = JSON.parse(info);
                if (mi_json.estado == "1"){
                    alertify.success(mi_json.mensaje);
                }else{
                    alertify.error(mi_json.mensaje);
                }
            },
            error: function () {
                alertify.error('Error');
            }
        });
    },function(param2){
        console.log("no");
    }).set({title:"Producto"}).set({labels:{ok:'SI', cancel: 'NO'}});
}

function onProductEditable(objeto){
    let registro = $(objeto).parent().parent();
    let entidad = $(registro).attr('id');
    let fila = $(registro).find("td");

    $("#pro_producto").val(entidad);

    let sumar_columna = 2;

    seleccionarComboPorTexto("pro_subcategoria",$(fila[1 + sumar_columna]).text());
    $("#pro_subcategoria").selectpicker("refresh");
    $('#pro_subcategoria').trigger('change');

    seleccionarComboPorTexto("pro_modelo",$(fila[2 + sumar_columna]).text());
    $("#pro_modelo").selectpicker("refresh");

    seleccionarComboPorTexto("pro_linea",$(fila[3 + sumar_columna]).text());
    $("#pro_linea").selectpicker("refresh");

    $("#pro_sku").val($(fila[4 + sumar_columna]).text());

    //console.log($(fila[6]).text());
    seleccionarComboPorTextoNuevo("pro_tallero",$(fila[5 + sumar_columna]).text());
    $("#pro_tallero").selectpicker("refresh");

    $("#pro_nombre").val($(fila[6 + sumar_columna]).text());
    $("#pro_descripcion").val($(fila[8 + sumar_columna]).text());

    $("#pro_precio").val($(fila[9 + sumar_columna]).text());
    $("#pro_descuento").val($(fila[10 + sumar_columna]).text());
    

    let fecha_comercial = ($(fila[12 + sumar_columna]).text() != "-" ? $(fila[12 + sumar_columna]).text() : null);
    $("#pro_fecha_comercial").val(fecha_comercial);


    let bota = ($(fila[13 + sumar_columna]).text() != "-" ? $(fila[13 + sumar_columna]).text() : "0");
    seleccionarComboPorTexto("pro_tipobota",bota);
    $("#pro_tipobota").selectpicker("refresh");

    let manga = ($(fila[14 + sumar_columna]).text() != "-" ? $(fila[14 + sumar_columna]).text() : "0");
    seleccionarComboPorTexto("pro_tipomanga",manga);
    $("#pro_tipomanga").selectpicker("refresh");

    let entalle = ($(fila[15 + sumar_columna]).text() != "-" ? $(fila[15 + sumar_columna]).text() : "0");
    seleccionarComboPorTexto("pro_tipoentalle",entalle);
    $("#pro_tipoentalle").selectpicker("refresh");

    let color = ($(fila[16 + sumar_columna]).text() != "-" ? $(fila[16 + sumar_columna]).text() : "0");
    seleccionarComboPorTexto("pro_color",color);
    $("#pro_color").selectpicker("refresh");

    let color_referencia = ($(fila[17 + sumar_columna]).text() != "-" ? $(fila[17 + sumar_columna]).text() : "0");
    seleccionarComboPorTexto("pro_colorreferencia",color_referencia);
    $("#pro_colorreferencia").selectpicker("refresh");

    seleccionarComboPorTexto("pro_nuevo",$(fila[18 + sumar_columna]).text());
    seleccionarComboPorTexto("pro_cuero",$(fila[19 + sumar_columna]).text());

    $("#btn_producto_nuevo").attr("disabled", true);
    $("#btn_producto_guardar").attr("disabled", false);
    $("#btn_producto_cancelar").attr("disabled", false);
    $("#btn_producto_importar").attr("disabled", true);
    $("#btn_producto_exportar").attr("disabled", true);

    $('#collapseOne').collapse();
    $('#pro_sku').focus();
    alertify.success('Registro listo para editar.');
}

function onResetFormulario(){
    $("#pro_producto").val("0");

    $('#pro_subcategoria').val("0");
    $("#pro_subcategoria").selectpicker("refresh");
    $('#pro_subcategoria').trigger('change');

    $('#pro_modelo').val("0");
    $("#pro_modelo").selectpicker("refresh");

    $('#pro_linea').val("0");
    $("#pro_linea").selectpicker("refresh");

    $('#pro_sku').val("");

    $('#pro_tallero').val("0");
    $("#pro_tallero").selectpicker("refresh");
    
    $("#pro_nombre").val("");

    $("#pro_descripcion").val("");

    $("#pro_precio").val("");

    $("#pro_descuento").val("");

    $("#pro_fecha_comercial").val("null");

    $('#pro_tipobota').val("0");
    $("#pro_tipobota").selectpicker("refresh");
    

    $('#pro_tipomanga').val("0");
    $("#pro_tipomanga").selectpicker("refresh");

    $('#pro_tipoentalle').val("0");
    $("#pro_tipoentalle").selectpicker("refresh");

    $('#pro_color').val("0");
    $("#pro_color").selectpicker("refresh");

    $('#pro_colorreferencia').val("0");
    $("#pro_colorreferencia").selectpicker("refresh");

    $('#pro_nuevo').val("0");
    $("#pro_nuevo").selectpicker("refresh");

    $('#pro_cuero').val("0");
    $("#pro_cuero").selectpicker("refresh");

    $("#btn_producto_nuevo").attr("disabled", false);
    $("#btn_producto_guardar").attr("disabled", true);
    $("#btn_producto_cancelar").attr("disabled", true);
    $("#btn_producto_importar").attr("disabled", false);
    $("#btn_producto_exportar").attr("disabled", false);
}

$("#producto_gruardar").submit(function (event) {
    event.preventDefault();
    let parametros = $(this).serialize();
    saverOrUpdateProduct(parametros);
});

function saverOrUpdateProduct(parametros){
    $.ajax({
        type: "POST",
        url: "../controller/producto/saveOrUpdateProduct.php",
        data: parametros,
        beforeSend: function () {
        },
        success: function (info) {
            console.log(info);
            let mi_json = JSON.parse(info);
            if (mi_json.estado == "1"){
                onResetFormulario();
                alertify.success(mi_json.mensaje);
            }else{
                alertify.success(mi_json.mensaje);
            }
        },
        error: function () {
            console.log("Error");
        }
    });
}

function selectFactoryList(componente = "", url = "", paramametro = 100){
    let mi_select = document.getElementById(componente);
    $.ajax({
        type: "POST",
        url: "../controller/" + url,
        data: {numero:paramametro},
        beforeSend: function () {
        },
        success: function (info) {
            mi_select.innerHTML = `<option value="0" selected disabled>-- Seleccione --</option>`; 
            let mi_json = JSON.parse(info);
            if(mi_json.estado == 1 ){
                mi_json.lista.forEach(mi_dato_select => {
                    mi_select.innerHTML += `<option value="`+mi_dato_select.id+`">`+mi_dato_select.nombre+`</option>`;
                });
                $(mi_select).selectpicker("refresh");
            }
        },
        error: function () {
            console.log("Error");
        }
    });
}

function cargarGeneral(){
    selectFactoryList("pro_linea","linea/getListSelect.php");
    selectFactoryList("pro_subcategoria", "subcategoria/getListSelect.php");
    selectFactoryList("pro_modelo","modelo/getListSelect.php");
    selectFactoryList("pro_tallero","tallero/getListSelect.php");
    selectFactoryList("pro_color","color/getListSelect.php");
    selectFactoryList("pro_tipobota","tipobota/getListSelect.php");
    selectFactoryList("pro_tipomanga","tipomanga/getListSelect.php");
    selectFactoryList("pro_tipoentalle","tipoentalle/getListSelect.php");
    selectFactoryList("pro_colorreferencia","colorreferencia/getListSelect.php");
}


// DROPZONE NEW - INI
Dropzone.autoDiscover = false;

 var dropzone = new Dropzone('#upload-image', {
    previewTemplate: document.querySelector('#preview-template').innerHTML,
    dictDefaultMessage: '<div class="select-image">Arrastre y suelte su archivo aquí </br> <i class="fa fa-upload" aria-hidden="true"></i></div>',
    acceptedFiles: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel',
    url: "../controller/producto/importarProducto.php",
    autoProcessQueue: false,
    maxFiles: 1,
    init: function() {
        
    },
    thumbnail: function(file, dataUrl) {
        if (file.previewElement) {
            file.previewElement.classList.remove("dz-file-preview");
            var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
            for (var i = 0; i < images.length; i++) {
            var thumbnailElement = images[i];
            thumbnailElement.alt = file.name;
            thumbnailElement.src = dataUrl;
            }
            setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
        }
    },
    maxfilesexceeded: function (files) {
        this.removeAllFiles();
        this.addFile(files);
    }
});

// Now fake the file upload, since GitHub does not handle file uploads
// and returns a 404
var minSteps = 1,
    maxSteps = 1,
    timeBetweenSteps = 100,
    bytesPerStep = 100000;

dropzone.uploadFiles = function(files) {
    var self = this;
    for (var i = 0; i < files.length; i++) {

    var file = files[i];
    totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

    for (var step = 0; step < totalSteps; step++) {
        var duration = timeBetweenSteps * (step + 1);
        setTimeout(function(file, totalSteps, step) {
            return function() {
                file.upload = {
                    progress: 100 * (step + 1) / totalSteps,
                    total: file.size,
                    bytesSent: (step + 1) * file.size / totalSteps
                };

                self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
                if (file.upload.progress == 100) {
                    file.status = Dropzone.SUCCESS;
                    self.emit("success", file, 'success', null);
                    self.emit("complete", file);
                }
            };
        }(file, totalSteps, step), duration);
    }
    }
}
$('#remove-image').on('click',function(file) {
    dropzone.removeFile(file);
});

// DROPZONE NEW - FIN

$(document).ready(function () {
    window.ns_contador = {
        mostrado: 1,
        desde: 0,
        hasta: 1,
        total: 1,
        pagina_actual: 1,
        pagina_total: 1,
        primera_vez: 0,
        primer_siguiente:  0,
        paginacion: function(mi_paginacion){
            if (this.primera_vez == 0){
                this.mostrado = mi_paginacion.mostrado;
                this.total = mi_paginacion.total;
                this.pagina_actual = mi_paginacion.pagina_actual;
                this.hasta = mi_paginacion.mostrado;
                this.pagina_total = mi_paginacion.pagina_total;
                this.primera_vez = 1;
                this.mi_pagina_actual();
                console.log("E Primera");
                this.valores();
            }else{
                this.pagina_total = mi_paginacion.pagina_total;
            }
        },
        siguiente: function(){
            if(this.pagina_total > this.pagina_actual){
                this.pagina_actual += 1; 
                this.desde += (this.mostrado);
                this.hasta += ( this.mostrado); 
                this.valores();
                getProductsList(this.desde, this.hasta);
                this.mi_pagina_actual();
            }
        },
        anterior: function(){
            if(this.pagina_actual  > 1){
                this.pagina_actual -= 1; 
                this.desde -= (this.mostrado );
                this.hasta -= ( this.mostrado ); 
                this.valores();
                getProductsList(this.desde, this.hasta);
                this.mi_pagina_actual();
            }
        },
        mi_pagina_actual: function(){
            document.getElementById("mi_pagina_actual").innerText = this.pagina_actual + " / " + this.pagina_total;
        },
        valores: function(){
            console.log("de: " + this.mostrado);
            console.log("desde: " + this.desde);
            console.log("hasta: " + this.hasta);
            console.log("total: " +this.total);
            console.log("pag. actual: " + this.pagina_actual);
            console.log("pag. total: " + this.pagina_total);
        }
    }
    cargarGeneral();
    getProductsList();
});