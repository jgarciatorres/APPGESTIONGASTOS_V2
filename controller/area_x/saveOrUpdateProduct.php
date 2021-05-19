<?php
include("../shared/xheader.php");

$result = array(
    "estado" => "3",
    "mensaje" => "Ingresar los datos correctamente",
);
if(isset($_POST)){


    require_once('../../model/area_x.php');
    require_once('../../component/database.php');

    $mi_conexion = new database();
    $mi_area=new area_x($mi_conexion->getCurrentConnection());

    $indicador = strval(isset($_POST["pro_producto"]) == true ? str_replace("pro_identity_","",$_POST["pro_producto"]) : 0);


    if($indicador > 0){
        $id_area = $indicador;
        $nombre = $_POST["pro_nombre"];
        $centro = $_POST["pro_centro"];
        
        $resultado =  $mi_area->editarArea($id_area,$nombre,$centro);
    
        $result = array(
            "estado" => "1",
            "mensaje" =>  ($resultado == true ? "Se actualizo con exito" : "Error al actualizar"),
        );
    }else if($indicador == 0){
        $nombre = $_POST["pro_nombre"];
        $centro = $_POST["pro_centro"];

        $resultado =  $mi_area->guardarArea($nombre,$centro);

        $result = array(
            "estado" => "1",
            "mensaje" =>  ($resultado == true ? "Se guardo con exito" : "Error al guardar"),
        );
    }
    echo json_encode($result);
}else{
    echo json_encode($result);
}
?>