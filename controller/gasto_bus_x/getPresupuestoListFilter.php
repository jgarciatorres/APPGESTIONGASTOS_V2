<?php
$result = array(
    "estado" => "3",
    "mensaje" => "Ingresar parametros",
    "lista" => null,
    "paginacion" => null,
    "post" => $_POST,
);

if(isset($_POST['desde']) && isset($_POST["hasta"])){
    $desde=$_POST['desde'];
    $hasta=$_POST['hasta'];
	if(is_numeric($desde) && is_numeric($hasta)){
        require_once('../../model/gasto_x.php');
        require_once('../../component/database.php');

        $mi_conexion = new database();
        $area=new gasto_x($mi_conexion->getCurrentConnection());
        $cantidad = 20;
        

        //LAS FECHAS ME ENVIAN APESAR DE NO ESTAR ASIGNADAS
        $fecha_desde = isset($_POST['pro_fecha_desde']) == true ? $_POST['pro_fecha_desde'] : "";
        $fecha_hasta = isset($_POST['pro_fecha_hasta']) == true ? $_POST['pro_fecha_hasta'] : "";

        //LOS SELECT CUANDO NO ESTAS ASIGNADAS NO EXISTEN;
        $id_area = isset($_POST['pro_area']) == true ? intval($_POST['pro_area']) : 0;
        $id_presupuesto = isset($_POST['pro_presupuesto']) == true ? intval($_POST['pro_presupuesto']) : 0;
        $id_usuario = isset($_POST['pro_usuario']) == true ? intval($_POST['pro_usuario']) : 0;

        $data_area = $area->getGastoListFilter($desde, $cantidad,$fecha_desde,$fecha_hasta,$id_area,$id_presupuesto,$id_usuario);
        $data_paginacion = $area->getGastoCountFilter($cantidad,$fecha_desde,$fecha_hasta,$id_area,$id_presupuesto,$id_usuario);
        
		if(count($data_area) > 0 && count($data_paginacion) > 0){
            $data_area["paginacion"] =  $data_paginacion;
            echo json_encode($data_area);
        }else{
            $result = array(
                "estado" => "3",
                "mensaje" => "Error al buscar",
                "lista" => null,
                "paginacion" => null,
            );
            echo json_encode($result);
        }
    }else{
        $result = array(
            "estado" => "3",
            "mensaje" => "Los parametros no son numericos",
            "lista" => null,
            "paginacion" => null,
        );
        echo json_encode($result);
    }
}else{
    echo json_encode($result);
}
?>