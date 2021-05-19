<?php
include("../shared/xheader.php");

$result = array(
    "estado" => "3",
    "mensaje" => "Ingresar los datos correctamente",
);
if(isset($_POST)){


    require_once('../../model/presupuesto_asig_x.php');
    require_once('../../component/database.php');

    $mi_conexion = new database();
    $mi_area=new presupuesto_asig_x($mi_conexion->getCurrentConnection());

    $indicador = strval(isset($_POST["pro_producto"]) == true ? str_replace("pro_identity_","",$_POST["pro_producto"]) : 0);
    $usu_crea =  isset($_SESSION['session_admin']['id_usuario']) == true ? $_SESSION['session_admin']['id_usuario'] : 0;


    if($indicador > 0){
        $id_presupuesto_asig = $indicador;
        $presupuesto = $_POST["pro_presupuesto"];
        $colaborador = $_POST["pro_colaborador"];
        $area = $_POST["pro_area"];
        $fecha_inicial = $_POST["pro_fecha_inicial"];
        $fecha_final = $_POST["pro_fecha_final"];
        
        $resultado =  $mi_area->editarPresupuesto($id_presupuesto_asig,$presupuesto,$area,$colaborador,
            $fecha_inicial,$fecha_final,$usu_crea);
    
        $result = array(
            "estado" => "1",
            "mensaje" =>  ($resultado == true ? "Se actualizo con exito" : "Error al actualizar"),
        );
    }else if($indicador == 0){
        $presupuesto = $_POST["pro_presupuesto"];
        $colaborador = $_POST["pro_colaborador"];
        $area = $_POST["pro_area"];
        $fecha_inicial = $_POST["pro_fecha_inicial"];
        $fecha_final = $_POST["pro_fecha_final"];

        $resultado =  $mi_area->guardarPresupuesto($presupuesto,$area,$colaborador,
        $fecha_inicial,$fecha_final,$usu_crea);

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