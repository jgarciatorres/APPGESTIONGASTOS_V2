<?php
include("../shared/xheader.php");
require_once('../../model/xresponse.php');

$xresponse = new xresponse();

if (isset($_POST['usuario']) && isset($_POST['clave']) ) {
    
    require_once('../../component/database.php');
    require_once('../../model/admin_x.php');

    $mi_conexion = new database();
    $mi_admin = new admin_x($mi_conexion->getCurrentConnection());

    $resultado = $mi_admin->getLogin($_POST['usuario'], $_POST['clave']);

    $xresponse->setEstado($resultado);
    $xresponse->setMensaje($resultado);

    if(is_array($resultado)){
        $_SESSION['session_admin'] = array(
            "id_usuario" => $resultado['id_usuario'],
        );
    }

}

print $xresponse->getResponseAllJson();

?>