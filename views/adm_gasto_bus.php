<?php
session_start();
define("BASE", "../");
if (isset($_SESSION['session_admin'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include(BASE . 'commons/head.php'); ?>
        <title>Busqueda Gastos</title>
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
                                <h4>Busqueda de Gastos</h4>
                            </div>
                            <hr>
                            <div class="accordion">
                                <div class="card">
                                    <button class="btn btn-block btn-block-collapse text-left" type="button" data-toggle="collapse" data-target="#collapseOne">
                                        Busqueda de Gastos
                                    </button>
                                    <div id="collapseOne" class="collapse">
                                        <form id="producto_gruardar" name="producto_gruardar" action="#" method="post" autocomplete="off" enctype="multipart/form-data">
                                            <div class="row collapse-body">
                                                <input type="hidden" id="pro_producto" name="pro_producto" value="0" style="display:none" class="d-none" />

                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Fecha Desde</span>
                                                        </div>
                                                        <input type="date" id="pro_fecha_desde" name="pro_fecha_desde" class="form-control form-control-sm">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Fecha Hasta</span>
                                                        </div>
                                                        <input type="date" id="pro_fecha_hasta" name="pro_fecha_hasta" class="form-control form-control-sm">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Proyecto</span>
                                                        </div>
                                                        <select id="pro_presupuesto" name="pro_presupuesto" 
                                                            class="form-control form-control-sm selectpicker" data-container="body" 
                                                            data-size="10" data-live-search="true" data-style="border"
                                                            >
                                                            <option value="0" disabled>-- Seleccione --</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Área</span>
                                                        </div>
                                                        <select id="pro_area" name="pro_area" 
                                                            class="form-control form-control-sm selectpicker" data-container="body" 
                                                            data-size="10" data-live-search="true" data-style="border"
                                                            >
                                                            <option value="0" disabled>-- Seleccione --</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Usuario</span>
                                                        </div>
                                                        <select id="pro_usuario" name="pro_usuario" 
                                                            class="form-control form-control-sm selectpicker" data-container="body" 
                                                            data-size="10" data-live-search="true" data-style="border"
                                                            >
                                                            <option value="0" disabled>-- Seleccione --</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            
                                            </div>
                                            <div class="row">
                                                <div class="col-12 pb-4 text-center btns-actions-form">
                                                    <button type="submit" id="btn_producto_guardar" class="btn btn-sm btn-theme" title="Filtrar"><i class="fas fa-filter"></i> Filtrar</button>
                                                    <button type="reset" id="btn_producto_cancelar" class="btn btn-sm btn-theme-3" title="Limpiar"><i class="fas fa-undo"></i> Limpiar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
                                            <th>Acciones</th>
                                            <th class="sticky-table-column">Razón Social</th>
                                            <th>Monto</th>
                                            <th>Fecha</th>
                                            <th>Documento</th>
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

        <?php include BASE . 'commons/footer.php'; ?>

        <script type="text/javascript" src="<?php echo BASE; ?>assets/js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE; ?>assets/doubleScroll/doubleScroll.js"></script>
        <script src="<?= BASE ?>assets/js/adm_gasto_bus_x.js?v=<?= time(); ?>" type="text/javascript"></script>
    </body>

    </html>

<?php
} else {
    header('Location: ' . BASE . 'index.php');
}
?>