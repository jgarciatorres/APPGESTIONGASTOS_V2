<?php
class gasto_x
{

    private $cn = null;

    public function __construct($conexion)
    {
        $this->cn = $conexion;
    }

    public function getGastoList($desde = 0, $hasta = 20)
    {
        $result = array(
            "estado" => "2",
            "paginacion" => null,
            "mensaje" => "No se realizo la consulta",
            "lista" => null
        );
        try {
            $consulta = "SELECT ugas.id_gasto, presu.descripcion AS presupuesto, ugas.sin_presupuesto, ugas.motivo, ugas.ruc, ugas.nro_documento, ugas.razon_social, ugas.monto, ugas.fecha, ugas.ruta_documento, ugas.estado 
            FROM gasto AS ugas LEFT JOIN presupuesto AS presu ON ugas.id_presupuesto = presu.id_presupuesto
            ORDER BY ugas.id_gasto ASC LIMIT $desde, $hasta;";

            //$consulta = "SELECT null";

            $sql = $this->cn->query($consulta);
            if ($sql->num_rows > 0) {
                $result = array(
                    "estado" => "1",
                    "paginacion" => null,
                    "mensaje" => "Exito",
                    "lista" => $sql->fetch_all(MYSQLI_ASSOC),
                );
            }
        } catch (Exception $ex) {
            $result = array(
                "estado" => "3",
                "paginacion" => null,
                "mensaje" => $ex->getMessage(),
                "lista" => null,
            );
        }
        return $result;
    }

    public function getGastoCount($cantidad = 20)
    {
        $result = array(
            "mostrado" => 1,
            "total" => 1,
            "pagina_actual" => 1,
            "pagina_total" => 1
        );
        try {
            $sql = $this->cn->query("SELECT COUNT(0) AS total FROM gasto;");
            if ($sql->num_rows > 0) {
                $fila = $sql->fetch_assoc();
                $result = array(
                    "mostrado" => $cantidad,
                    "total" => $fila["total"],
                    "pagina_actual" => 1,
                    "pagina_total" => ($fila["total"] % $cantidad > 0 ? intval($fila["total"] / $cantidad) + 1 : intval($fila["total"] / $cantidad))
                );
            }
        } catch (Exception $ex) {
            $result = array(
                "mostrado" => 0,
                "total" => 0,
                "pagina_actual" => 0,
                "pagina_total" => 0
            );
        }
        return $result;
    }


    public function getGastoListFilter($desde = 0, $hasta = 20, 
        $fecha_desde,$fecha_hasta,$id_area,$id_presupuesto,$id_usuario)
    {

        $more_whre_sql = " 1=1 ";

        if($fecha_desde != "" && $fecha_hasta != ""){
            $more_whre_sql.= "AND ugas.fecha BETWEEN '$fecha_desde' AND '$fecha_hasta' ";
        }

        if($fecha_desde != "" && $fecha_hasta != ""){
            $more_whre_sql.= "AND ugas.fecha BETWEEN '$fecha_desde' AND '$fecha_hasta' ";
        }

        if($id_area != 0){
            $more_whre_sql.= "AND presua.id_area = $id_area ";
        }

        if($id_presupuesto != 0){
            $more_whre_sql.= "AND ugas.id_presupuesto = $id_presupuesto ";
        }

        if($id_usuario != 0){
            $more_whre_sql.= "AND ugas.usu_crea = $id_usuario ";
        }

        $result = array(
            "estado" => "2",
            "paginacion" => null,
            "mensaje" => "No se realizo la consulta",
            "lista" => null
        );
        $consulta = "";
        try {
            $consulta = "SELECT ugas.id_gasto, presu.descripcion AS presupuesto,ugas.sin_presupuesto,ugas.motivo,presua.id_area,
            ugas.ruc,ugas.nro_documento,ugas.razon_social,ugas.monto,ugas.fecha,ugas.ruta_documento,ugas.estado
            FROM gasto AS ugas LEFT JOIN presupuesto AS presu ON ugas.id_presupuesto = presu.id_presupuesto
            LEFT JOIN presupuesto_asignado AS presua ON ugas.id_presupuesto = presua.id_presupuesto
            WHERE ".$more_whre_sql." ORDER BY ugas.id_gasto ASC LIMIT $desde, $hasta;";

            //$consulta = "SELECT null";

            $sql = $this->cn->query($consulta);
            if ($sql->num_rows > 0) {
                $result = array(
                    "sql" => $consulta,
                    "estado" => "1",
                    "paginacion" => null,
                    "mensaje" => "Exito",
                    "lista" => $sql->fetch_all(MYSQLI_ASSOC),
                );
            }
        } catch (Exception $ex) {
            $result = array(
                "sql" => $sql,
                "estado" => "3",
                "paginacion" => null,
                "mensaje" => $ex->getMessage(),
                "lista" => null,
            );
        }
        return $result;
    }

    public function getGastoCountFilter($cantidad = 20,
        $fecha_desde,$fecha_hasta,$id_area,$id_presupuesto,$id_usuario)
    {
        $result = array(
            "mostrado" => 1,
            "total" => 1,
            "pagina_actual" => 1,
            "pagina_total" => 1
        );

        $more_whre_sql = " 1=1 ";

        if($fecha_desde != "" && $fecha_hasta != ""){
            $more_whre_sql.= "AND ugas.fecha BETWEEN '$fecha_desde' AND '$fecha_hasta' ";
        }

        if($id_area != 0){
            $more_whre_sql.= "AND presua.id_area = $id_area ";
        }

        if($id_presupuesto != 0){
            $more_whre_sql.= "AND ugas.id_presupuesto = $id_presupuesto ";
        }

        if($id_usuario != 0){
            $more_whre_sql.= "AND ugas.usu_crea = $id_usuario ";
        }

        $consulta = "";

        try {
            $sql = $this->cn->query("SELECT COUNT(0) AS total FROM gasto AS ugas 
            LEFT JOIN presupuesto AS presu ON ugas.id_presupuesto = presu.id_presupuesto
            LEFT JOIN presupuesto_asignado AS presua ON ugas.id_presupuesto = presua.id_presupuesto
            WHERE ".$more_whre_sql.";");

            if ($sql->num_rows > 0) {
                $fila = $sql->fetch_assoc();
                $result = array(
                    "sql" => $consulta,
                    "mostrado" => $cantidad,
                    "total" => $fila["total"],
                    "pagina_actual" => 1,
                    "pagina_total" => ($fila["total"] % $cantidad > 0 ? intval($fila["total"] / $cantidad) + 1 : intval($fila["total"] / $cantidad))
                );
            }
        } catch (Exception $ex) {
            $result = array(
                "sql" => $sql,
                "mostrado" => 0,
                "total" => 0,
                "pagina_actual" => 0,
                "pagina_total" => 0
            );
        }
        return $result;
    }


    public function guardarGasto(
        $id_presupuesto, $sin_presupuesto,$motivo, $ruc, $nro_documento, 
        $razon_social, $monto, $fecha, $ruta_documento, $usu_crea
    ) {
        $result = false;
        $consulta = "";
        try {
            $consulta = "INSERT INTO gasto(id_presupuesto, sin_presupuesto, 
            motivo, ruc, nro_documento, razon_social, monto, fecha, ruta_documento, 
            usu_crea) VALUES ($id_presupuesto,$sin_presupuesto,'$motivo','$ruc',
            '$nro_documento','$razon_social',$monto,'$fecha','$ruta_documento',$usu_crea);";

            $sql = $this->cn->query($consulta);
            if ($sql) {
                $result = true;
            }
        } catch (Exception $ex) {
            $result = false;
        }

        return $result;
    }

    public function editarGasto(
        $id_gasto, $id_presupuesto, $sin_presupuesto,$motivo, $ruc, $nro_documento, 
        $razon_social, $monto, $fecha, $ruta_documento, $usu_crea
    ) {
        $result = false;
        $consulta = "";
        try {
            $consulta = "UPDATE gasto SET id_presupuesto=$id_presupuesto,sin_presupuesto=$sin_presupuesto,
            motivo='$motivo',ruc='$ruc',nro_documento='$nro_documento',razon_social='$razon_social',
            monto=$monto,fecha='$fecha',ruta_documento='$ruta_documento', usu_crea=$usu_crea
            WHERE id_gasto=$id_gasto LIMIT 1;";

            $sql = $this->cn->query($consulta);
            if ($sql) {
                $result = true;
            }
        } catch (Exception $ex) {
            $result = false;
        }

        return $result;
    }

    public function editarGastoSinDoc(
        $id_gasto, $id_presupuesto, $sin_presupuesto,$motivo, $ruc, $nro_documento, 
        $razon_social, $monto, $fecha, $usu_crea
    ) {
        $result = false;
        $consulta = "";
        try {
            $consulta = "UPDATE gasto SET id_presupuesto=$id_presupuesto,sin_presupuesto=$sin_presupuesto,
            motivo='$motivo',ruc='$ruc',nro_documento='$nro_documento',razon_social='$razon_social',
            monto=$monto,fecha='$fecha',usu_crea=$usu_crea
            WHERE id_gasto=$id_gasto LIMIT 1;";

            $sql = $this->cn->query($consulta);
            if ($sql) {
                $result = true;
            }
        } catch (Exception $ex) {
            $result = false;
        }

        return $result;
    }

    public function desactivarPresupuesto($id_presupuesto, $valor)
    {
        $result = false;

        $consulta = "UPDATE gasto SET estado=$valor WHERE id_gasto=$id_presupuesto LIMIT 1;";

        $sql = $this->cn->query($consulta);
        if ($sql) {
            $result = true;
        }
        return $result;
    }
}
