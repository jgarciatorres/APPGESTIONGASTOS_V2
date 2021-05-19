<?php
class presupuesto_x
{

    private $cn = null;

    public function __construct($conexion)
    {
        $this->cn = $conexion;
    }

    public function getPresupuestoList($desde = 0, $hasta = 20)
    {
        $result = array(
            "estado" => "2",
            "paginacion" => null,
            "mensaje" => "No se realizo la consulta",
            "lista" => null
        );
        try {
            $consulta = "SELECT presu.id_presupuesto, presu.descripcion, presu.fecha, presu.monto, presu.ruta_documento, presut.nombre AS tipo, presue.nombre AS estadop, presu.estado FROM presupuesto AS presu 
            LEFT JOIN presupuesto_tipo AS presut ON presu.id_presupuesto_tipo = presut.id_presupuesto_tipo
            LEFT JOIN presupuesto_estado AS presue ON presu.id_presupuesto_estado = presue.id_presupuesto_estado
            ORDER BY presu.id_presupuesto ASC LIMIT $desde, $hasta;";

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

    public function getPresupuestoCount($cantidad = 20)
    {
        $result = array(
            "mostrado" => 1,
            "total" => 1,
            "pagina_actual" => 1,
            "pagina_total" => 1
        );
        try {
            $sql = $this->cn->query("SELECT COUNT(0) AS total FROM presupuesto;");
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


    public function guardarPresupuesto(
        $descripcion,$fecha,$monto,$ruta_documento,$tipo,$estado,$usu_crea
    ) {
        $result = false;
        $consulta = "";
        try {
            $consulta = "INSERT INTO presupuesto(descripcion,fecha,monto,ruta_documento,id_presupuesto_tipo,
            id_presupuesto_estado,usu_crea) VALUES ('$descripcion','$fecha',$monto,'$ruta_documento',
            $tipo,$estado,$usu_crea);";

            $sql = $this->cn->query($consulta);
            if ($sql) {
                $result = true;
            }
        } catch (Exception $ex) {
            $result = false;
        }

        return $result;
    }

    public function editarPresupuesto(
        $id_presupuesto,$descripcion,$fecha,$monto,$ruta_documento,$tipo,$estado,$usu_crea
    ) {
        $result = false;
        $consulta = "";
        try {
            $consulta = "UPDATE presupuesto SET descripcion='$descripcion',fecha='$fecha',
            monto=$monto,ruta_documento='$ruta_documento',id_presupuesto_tipo=$tipo,
            id_presupuesto_estado=$estado,usu_crea=$usu_crea
            WHERE id_presupuesto=$id_presupuesto LIMIT 1;";

            $sql = $this->cn->query($consulta);
            if ($sql) {
                $result = true;
            }
        } catch (Exception $ex) {
            $result = false;
        }

        return $result;
    }

    public function editarPresupuestoSinDoc(
        $id_presupuesto,$descripcion,$fecha,$monto,$tipo,$estado,$usu_crea
    ) {
        $result = false;
        $consulta = "";
        try {
            $consulta = "UPDATE presupuesto SET descripcion='$descripcion',fecha='$fecha',
            monto=$monto,id_presupuesto_tipo=$tipo,
            id_presupuesto_estado=$estado,usu_crea=$usu_crea
            WHERE id_presupuesto=$id_presupuesto LIMIT 1;";

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

        $consulta = "UPDATE presupuesto SET estado=$valor WHERE id_presupuesto=$id_presupuesto LIMIT 1;";

        $sql = $this->cn->query($consulta);
        if ($sql) {
            $result = true;
        }
        return $result;
    }

    public function getListSelect()
    {
        $result = array(
            "estado" => "2",
            "mensaje" => "Fracaso",
            "lista" => null
        );

        $consulta= "SELECT id_presupuesto AS id, descripcion AS nombre FROM presupuesto WHERE estado = 1;";

        $sql = $this->cn->query($consulta);
        if ($sql->num_rows > 0) {
            $lista = array();

            while ($fila = $sql->fetch_assoc()) {
                array_push($lista, $fila);
            }

            $result = array(
                "estado" => "1",
                "mensaje" => "Exito",
                "lista" => $lista,
            );
        }
        return $result;
    }
}
