<?php
include("../shared/xheader.php");

$result = array(
    "estado" => "3",
    "mensaje" => "Ingresar los datos correctamente",
);
if(isset($_POST)){


    require_once('../../model/usuario_x.php');
    require_once('../../component/database.php');

    $mi_conexion = new database();
    $mi_area=new usuario_x($mi_conexion->getCurrentConnection());

    $indicador = strval(isset($_POST["pro_producto"]) == true ? str_replace("pro_identity_","",$_POST["pro_producto"]) : 0);

    $usu_crea =  isset($_SESSION['session_admin']['id_usuario']) == true ? $_SESSION['session_admin']['id_usuario'] : 0;

    if($indicador > 0){
        $id_usuario = $indicador;
        $nombres = $_POST["pro_nombres"];
        $apellidos = $_POST["pro_apellidos"];
        $tipo = $_POST["pro_tipo"];
        $area = $_POST["pro_area"];
        $usuario = $_POST["pro_usuario"];
        $clave = $_POST["pro_clave"];
        
        $resultado =  $mi_area->editarUsuario($id_usuario,$tipo,$area,$nombres,$apellidos,$usuario,$clave,$usu_crea);
    
        $result = array(
            "estado" => "1",
            "mensaje" =>  ($resultado == true ? "Se actualizo con exito" : "Error al actualizar"),
        );
    }else if($indicador == 0){
        $nombres = $_POST["pro_nombres"];
        $apellidos = $_POST["pro_apellidos"];
        $tipo = $_POST["pro_tipo"];
        $area = $_POST["pro_area"];
        $usuario = $_POST["pro_usuario"];
        $clave = $_POST["pro_clave"];

        $resultado =  $mi_area->guardarUsuario($tipo,$area,$nombres,$apellidos,$usuario,$clave,$usu_crea);

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