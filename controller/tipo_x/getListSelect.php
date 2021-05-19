<?php
$result = array(
    "estado" => "3",
    "mensaje" => "Ingresar parametros",
    "lista" => null,
);

if(isset($_POST['numero']) ){
    $numero=$_POST['numero'];
	if(is_numeric($numero)){
        require_once('../../model/tipo_x.php');
        require_once('../../component/database.php');

        $mi_conexion = new database();
        $mi_clase = new tipo_x($mi_conexion->getCurrentConnection());
        $cantidad = 20;
        $mi_data = $mi_clase->getListSelect();
        
		if(count($mi_data) > 0 ){
            echo json_encode($mi_data);
        }else{
            $result = array(
                "estado" => "3",
                "mensaje" => "Error al buscar",
                "lista" => null,
            );
            echo json_encode($result);
        }
    }else{
        $result = array(
            "estado" => "3",
            "mensaje" => "Los parametros no son numericos",
            "lista" => null,
        );
        echo json_encode($result);
    }
}else{
    echo json_encode($result);
}
?>