<?php
session_start();
define("BASE", "../");
if (isset($_SESSION['session_admin'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include(BASE . 'commons/head.php'); ?>
        <title>Catalogo Producto - Manager Norton</title>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>assets/css/bootstrap-select.min.css">
    </head>

    <body>
        <?php include BASE . 'commons/header.php'; ?>
        <div class="d-flex" id="wrapper">
            <?php include BASE . 'commons/sliderbar.php'; ?>
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <main class="p-1 p-sm-3">
                        <section class="m-2">
                            <div class="text-left">
                                <h4>Gestor de Productos</h4>
                            </div>
                            <hr>
                            <div class="accordion">
                                <div class="card">
                                    <button class="btn btn-block btn-block-collapse text-left" type="button" data-toggle="collapse" data-target="#collapseOne">
                                        Registro de Producto
                                    </button>
                                    <div id="collapseOne" class="collapse">
                                        <form id="producto_gruardar" name="producto_gruardar" action="#" method="post" autocomplete="off" enctype="multipart/form-data">
                                            <div class="row collapse-body">
                                                <input type="hidden" id="pro_producto" name="pro_producto" value="0" style="display:none" class="d-none" />
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">SKU</span>
                                                        </div>
                                                        <input type="number" id="pro_sku" name="pro_sku" class="form-control" min="0" placeholder="5000000000" minlength="10" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">L&iacute;nea</span>
                                                        </div>
                                                        <select id="pro_linea" name="pro_linea" class="form-control form-control-sm selectpicker" data-container="body" data-size="10" data-live-search="true" data-style="border" required>
                                                            <option value="0" disabled>-- Seleccione --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Subcategor&iacute;a</span>
                                                        </div>
                                                        <select id="pro_subcategoria" name="pro_subcategoria" class="form-control form-control-sm selectpicker" data-container="body" data-size="10" data-live-search="true" data-style="border" required>
                                                            <option value="0" disabled>-- Seleccione --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Modelo</span>
                                                        </div>
                                                        <select id="pro_modelo" name="pro_modelo" class="form-control form-control-sm selectpicker" data-container="body" data-size="10" data-live-search="true" data-style="border" required>
                                                            <option value="0" disabled>-- Seleccione --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Nombre</span>
                                                        </div>
                                                        <input type="text" id="pro_nombre" name="pro_nombre" class="form-control form-control-sm" placeholder="Polo Layita Azul Claro" minlength="8" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Descripci&oacute;n</span>
                                                        </div>
                                                        <input type="text" id="pro_descripcion" name="pro_descripcion" class="form-control form-control-sm" placeholder="Textura, Tipo de Tela, Medidas, Tipo de Lavado, etc." minlength="12" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Color</span>
                                                        </div>
                                                        <select id="pro_color" name="pro_color" class="form-control form-control-sm selectpicker" data-container="body" data-size="10" data-live-search="true" data-style="border" required>
                                                            <option value="0" disabled>-- Seleccione --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Color de Referencia</span>
                                                        </div>
                                                        <select id="pro_colorreferencia" name="pro_colorreferencia" class="form-control form-control-sm selectpicker" data-container="body" data-size="10" data-live-search="true" data-style="border" required>
                                                            <option value="0" disabled>-- Seleccione --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Precio</span>
                                                        </div>
                                                        <input type="number" id="pro_precio" name="pro_precio" class="form-control form-control-sm" min="0" maxlength="6" minlength="2" placeholder="000.00" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Descuento</span>
                                                        </div>
                                                        <input type="number" id="pro_descuento" name="pro_descuento" class="form-control form-control-sm" min="0" placeholder="100" maxlength="3" minlength="1" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Tallero</span>
                                                        </div>
                                                        <select id="pro_tallero" name="pro_tallero" class="form-control form-control-sm selectpicker" data-container="body" data-size="10" data-live-search="true" data-style="border" required>
                                                            <option value="0" disabled>-- Seleccione --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Fecha Comercial</span>
                                                        </div>
                                                        <input type="date" id="pro_fecha_comercial" name="pro_fecha_comercial" class="form-control form-control-sm" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Etiqueta Nuevo</span>
                                                        </div>
                                                        <select id="pro_nuevo" name="pro_nuevo" class="form-control form-control-sm selectpicker" data-style="border" required>
                                                            <option value="0">No</option>
                                                            <option value="1">Si</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Etiqueta Cuero</span>
                                                        </div>
                                                        <select id="pro_cuero" name="pro_cuero" class="form-control form-control-sm selectpicker" data-style="border" required>
                                                            <option value="0">No</option>
                                                            <option value="1">Si</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Tipo Bota</span>
                                                        </div>
                                                        <select id="pro_tipobota" name="pro_tipobota" 
                                                        class="form-control form-control-sm selectpicker" 
                                                        data-container="body" data-size="10" 
                                                        data-live-search="true" data-style="border" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Tipo Manga</span>
                                                        </div>
                                                        <select id="pro_tipomanga" name="pro_tipomanga" class="form-control form-control-sm selectpicker" data-container="body" data-size="10" data-live-search="true" data-style="border" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Tipo Entalle</span>
                                                        </div>
                                                        <select id="pro_tipoentalle" name="pro_tipoentalle" class="form-control form-control-sm selectpicker" data-container="body" data-size="10" data-live-search="true" data-style="border" required>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 pb-4 text-center btns-actions-form">
                                                    <button type="button" id="btn_producto_nuevo" class="btn btn-sm btn-theme" title="Nuevo"><i class="fas fa-plus"></i> Nuevo</button>
                                                    <button type="submit" id="btn_producto_guardar" class="btn btn-sm btn-theme" title="Guardar" disabled><i class="fas fa-save"></i> Guardar</button>
                                                    <button type="reset" id="btn_producto_cancelar" class="btn btn-sm btn-theme-3" title="Cancelar" disabled><i class="fas fa-window-close"></i> Cancelar</button>
                                                    <button type="reset" id="btn_producto_importar" class="btn btn-sm btn-theme-2" title="Importar"><i class="fas fa-file-upload"></i> Importar</button>
                                                    <button type="reset" id="btn_producto_exportar" class="btn btn-sm btn-theme-2" title="Exportar"><i class="fas fa-file-download"></i> Exportar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- <div class="card">
                                    <button class="btn btn-block btn-block-collapse text-left" type="button" data-toggle="collapse" data-target="#collapseTwo">
                                        Filtrar Resultados
                                    </button>
                                    <div id="collapseTwo" class="collapse">
                                        <div class="collapse-body">
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </section>
                        <section class="m-2">
                            <nav class="mt-4">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item"><a id="mi_btn_anterior" class="page-link">Anterior</a></li>
                                    <li class="page-item"><a id="mi_pagina_actual" class="page-link">1 / 1</a></li>
                                    <li class="page-item"><a id="mi_btn_siguiente" class="page-link">Siguiente</a></li>
                                </ul>
                            </nav>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th rowspan="2">Acciones</th>
                                            <th rowspan="2">Imagen</th>
                                            <th rowspan="2">Textura</th>
                                            <th rowspan="2">Sub Categoria</th>
                                            <th rowspan="2">Modelo</th>
                                            <th rowspan="2">Linea</th>
                                            <th rowspan="2" class="sticky-table-column">Sku</th>
                                            <th rowspan="2">Tallero</th>
                                            <th rowspan="2">Nombre</th>
                                            <th rowspan="2">Nombre Url</th>
                                            <th rowspan="2">Descripción</th>
                                            <th rowspan="2">Precio</th>
                                            <th rowspan="2">Descuento</th>
                                            <th rowspan="2">Precio con Descuento</th>
                                            <th rowspan="2">Fecha Comercial</th>
                                            <th rowspan="2">Bota</th>
                                            <th rowspan="2">Manga</th>
                                            <th rowspan="2">Entalle</th>
                                            <th rowspan="2">Color</th>
                                            <th rowspan="2">Color Referencia</th>
                                            <th colspan="2">Etiqueta</th>
                                        </tr>
                                        <tr>
                                            <th>Nuevo</th>
                                            <th>Cuero</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_cargar" class="text-center">
                                    </tbody>
                                </table>
                                <div id="my_capa_negra_tabla" class="my_capa_negra" style="display: none;">
                                    <div class="my_contenido_cargando">
                                        <div class="spinner-border text-theme"></div>
                                        <p class="my_texto_cargando">Cargando...</p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </main>
                </div>
            </div>
        </div>

        <?php include BASE . 'commons/files/importFiles.php'; ?>
        <?php include BASE . 'commons/footer.php'; ?>

        <div class="modal fade" id="mi_modal_importar_productos" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title">Importar Productos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="col-12 pro_mensaje_importacion" id="pro_mensaje_importacion">
                    </div>
                    <div class="modal-body p-0">
                        <div class="col-12  p-1">
                            <form action="s" method="post" class="dropzone dropzone-docs p-1" enctype="multipart/form-data" id="upload-image">
                                <div class="fallback">
                                    <input name="file" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="file" multiple="true" /> <br>
                                    <div class="dz-message needsclick">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" id="btn_producto_importar_excel" class="btn btn-sm btn-theme" title="Importar">Importar</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo BASE; ?>assets/js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE; ?>assets/doubleScroll/doubleScroll.js"></script>
        <script src="<?= BASE ?>assets/js/adm_producto.js?v=<?= time(); ?>" type="text/javascript"></script>
    </body>

    </html>

<?php
} else {
    header('Location: ' . BASE . 'index.php');
}
?>