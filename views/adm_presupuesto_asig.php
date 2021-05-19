<?php
session_start();
define("BASE", "../");
if (isset($_SESSION['session_admin'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include(BASE . 'commons/head.php'); ?>
        <title>Asignar Presupuesto</title>
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
                                <h4>Gestor de Asignacion de Presupuesto</h4>
                            </div>
                            <hr>
                            <div class="accordion">
                                <div class="card">
                                    <button class="btn btn-block btn-block-collapse text-left" type="button" data-toggle="collapse" data-target="#collapseOne">
                                        Asignar Presupuesto
                                    </button>
                                    <div id="collapseOne" class="collapse">
                                        <form id="producto_gruardar" name="producto_gruardar" action="#" method="post" autocomplete="off" enctype="multipart/form-data">
                                            <div class="row collapse-body">
                                                <input type="hidden" id="pro_producto" name="pro_producto" value="0" style="display:none" class="d-none" />

                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Presupuesto</span>
                                                        </div>
                                                        <select id="pro_presupuesto" name="pro_presupuesto" 
                                                            class="form-control form-control-sm selectpicker" 
                                                            data-container="body" data-size="10" 
                                                            data-live-search="true" data-style="border" required
                                                            >
                                                            <option value="0" disabled>-- Seleccione --</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Colaborador</span>
                                                        </div>
                                                        <select id="pro_colaborador" name="pro_colaborador" 
                                                            class="form-control form-control-sm selectpicker" 
                                                            data-container="body" data-size="10" 
                                                            data-live-search="true" data-style="border" required
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
                                                            class="form-control form-control-sm selectpicker" 
                                                            data-container="body" data-size="10" 
                                                            data-live-search="true" data-style="border" required 
                                                            >
                                                            <option value="0" disabled>-- Seleccione --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                               
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Fecha Inicial</span>
                                                        </div>
                                                        <input type="date" id="pro_fecha_inicial" name="pro_fecha_inicial" 
                                                        class="form-control form-control-sm" required>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Fecha Final</span>
                                                        </div>
                                                        <input type="date" id="pro_fecha_final" name="pro_fecha_final" 
                                                        class="form-control form-control-sm" required>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-12 pb-4 text-center btns-actions-form">
                                                    <button type="button" id="btn_producto_nuevo" class="btn btn-sm btn-theme" title="Nuevo"><i class="fas fa-plus"></i> Nuevo</button>
                                                    <button type="submit" id="btn_producto_guardar" class="btn btn-sm btn-theme" title="Guardar" disabled><i class="fas fa-save"></i> Guardar</button>
                                                    <button type="reset" id="btn_producto_cancelar" class="btn btn-sm btn-theme-3" title="Cancelar" disabled><i class="fas fa-window-close"></i> Cancelar</button>
                                                   
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
                                            <th rowspan="2">Acciones</th>
                                            <th rowspan="2" class="sticky-table-column">Presupuesto</th>
                                            <th rowspan="2">Colaborador</th>
                                            <th rowspan="2">Área</th>
                                            <th colspan="2">Fecha Vigencia</th>
                                        </tr>
                                        <tr>
                                            <th >Inicial</th>
                                            <th >Final</th>
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
        <script src="<?= BASE ?>assets/js/adm_presupuesto_asig_x.js?v=<?= time(); ?>" type="text/javascript"></script>
    </body>

    </html>

<?php
} else {
    header('Location: ' . BASE . 'index.php');
}
?>