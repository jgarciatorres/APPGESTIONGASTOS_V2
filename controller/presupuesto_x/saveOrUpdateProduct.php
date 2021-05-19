<?php
include("../shared/xheader.php");

$result = array(
    "estado" => "3",
    "mensaje" => "Ingresar los datos correctamente",
    "post" => $_POST,
    "file" => $_FILES,
);

if(isset($_POST['pro_tipo']) && isset($_POST['pro_estado'])  ){


    require_once('../../model/presupuesto_x.php');
    require_once('../../component/database.php');
    require_once('../../component/util_functions.php');

    $pro_documento = 'pro_documento';
    $ruta_carpeta_imagen = "../../";

    $inconvenientes = "";
    $mi_conexion = new database();
    $mi_area=new presupuesto_x($mi_conexion->getCurrentConnection());

    $indicador = strval(isset($_POST["pro_producto"]) == true ? str_replace("pro_identity_","",$_POST["pro_producto"]) : 0);
    $usu_crea =  isset($_SESSION['session_admin']['id_usuario']) == true ? $_SESSION['session_admin']['id_usuario'] : 0;

    $ruta_repo_img = util_functions::rutaPdfPresupuestoX();

    if($indicador > 0){
        $id_presupuesto = $indicador;
        $descripcion = $_POST["pro_descripcion"];
        $fecha = $_POST["pro_fecha"];
        $monto = $_POST["pro_monto"];
        $fecha = $_POST["pro_fecha"];
        $tipo = $_POST["pro_tipo"];
        $estado = $_POST["pro_estado"];


        if(isset($_FILES['pro_documento']['name']) && $_FILES['pro_documento']['name'] != ""){

            $nombre_archivo=$_FILES[$pro_documento]['name'];
            $tamanio_archivo=$_FILES[$pro_documento]['size'];
            $ruta_imagen=$_FILES[$pro_documento]['tmp_name'];
            $extension_archivo = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
        

            if(util_functions::existeLaImagen($ruta_carpeta_imagen.$ruta_repo_img.$nuevo_nombre_archivo.".pdf")){
                $nuevo_nombre_archivo = $nuevo_nombre_archivo."_2";
            }
    
            if(!copy($ruta_imagen,$ruta_carpeta_imagen.$ruta_repo_img.$nuevo_nombre_archivo.".pdf")) {
                $inconvenientes.= "Error al copiar el documento. ".$sku;
            }else{
                $resultado =  $mi_area->editarPresupuesto($id_presupuesto,$descripcion,$fecha,$monto,
                $ruta_documento,$tipo,$estado,$usu_crea);
        
                $result = array(
                    "estado" => "1",
                    "mensaje" =>  ($resultado == true ? "Se actualizo con exito" : "Error al actualizar"),
                );
            }
        }else{
            $resultado =  $mi_area->editarPresupuestoSinDoc($id_presupuesto,$descripcion,$fecha,$monto,
            $tipo,$estado,$usu_crea);
    
            $result = array(
                "estado" => "1",
                "mensaje" =>  ($resultado == true ? "Se actualizo con exito" : "Error al actualizar"),
            );
        }

        if($inconvenientes != ""){
            $result = array(
                "estado" => "3",
                "mensaje" =>  $inconvenientes,
            );
        }

    }else if($indicador == 0){
        $descripcion = $_POST["pro_descripcion"];
        $fecha = $_POST["pro_fecha"];
        $monto = $_POST["pro_monto"];
        $fecha = $_POST["pro_fecha"];
        $tipo = $_POST["pro_tipo"];
        $estado = $_POST["pro_estado"];

        if(isset($_FILES['pro_documento'])){

            $nombre_archivo=$_FILES[$pro_documento]['name'];
            $tamanio_archivo=$_FILES[$pro_documento]['size'];
            $ruta_imagen=$_FILES[$pro_documento]['tmp_name'];
            $extension_archivo = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
        

            if(util_functions::extensionPdfPermitidaX($extension_archivo) 
            && util_functions::tamanioPdfPermitidaX($tamanio_archivo)){
        
                $nuevo_nombre_archivo=util_functions::generateNamePdfX();

                if(util_functions::existeLaImagen($ruta_carpeta_imagen.$ruta_repo_img.$nuevo_nombre_archivo.".pdf")){
                    $nuevo_nombre_archivo = $nuevo_nombre_archivo."_2";
                }
        
                if(!copy($ruta_imagen,$ruta_carpeta_imagen.$ruta_repo_img.$nuevo_nombre_archivo.".pdf")) {
                    $inconvenientes.= "Error al copiar el documento. ".$sku;
                }else{
        
                    $ruta_documento = $nuevo_nombre_archivo.".pdf";
        
                    $resultado = $mi_area->guardarPresupuesto($descripcion,$fecha,$monto,$ruta_documento,
                    $tipo,$estado,$usu_crea);
        
                    $result = array(
                        "estado" => "1",
                        "mensaje" =>  ($resultado == true ? "Se guardo con exito" : "Error al guardar"),
                    );
                }
            }else{
                $inconvenientes.= "Extension o tamanio del documento no permitida. ";
            }
        }else{
            $inconvenientes.= "No existe el documento ingresado";
        }

        if($inconvenientes != ""){
            $result = array(
                "estado" => "3",
                "mensaje" =>  $inconvenientes,
            );
        }
    }else{
        $result = array(
            "estado" => "3",
            "mensaje" =>  "Manipulacion del DOM. ",
        );
    }
    echo json_encode($result);
}else{
    echo json_encode($result);
}
?>