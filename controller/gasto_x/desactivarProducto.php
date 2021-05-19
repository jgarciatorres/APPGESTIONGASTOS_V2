<?php
include("../shared/xheader.php");

$result = array(
    "estado" => "3",
    "mensaje" => "Ingresar sku",
);
if(isset($_POST["entidad"]) && isset($_POST["valor"]) ){

    require_once('../../model/gasto_x.php');
    require_once('../../component/database.php');

    $mi_conexion = new database();
    $mi_area=new gasto_x($mi_conexion->getCurrentConnection());

    $indicador = strval(isset($_POST["entidad"]) == true ? str_replace("pro_identity_","",$_POST["entidad"]) : 0);
    $valor = strval($_POST["valor"]);

    if($indicador > 0){
        $IDproducto = $indicador;
       
        $resultado =  $mi_area->desactivarPresupuesto($IDproducto, $valor);

        $result = array(
            "estado" => "1",
            "mensaje" =>  ($resultado == true ? "Se guardo con exito": "Error al guardar"),
        );
    }else{
        $result = array(
            "estado" => "2",
            "mensaje" =>  "Error",
        );
    }
    echo json_encode($result);
}else{
    echo json_encode($result);
}
?>