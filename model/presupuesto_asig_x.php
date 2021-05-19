<?php
class presupuesto_asig_x
{

    private $cn = null;

    public function __construct($conexion)
    {
        $this->cn = $conexion;
    }

    public function getPresupuestoAsigList($desde = 0, $hasta = 20)
    {
        $result = array(
            "estado" => "2",
            "paginacion" => null,
            "mensaje" => "No se realizo la consulta",
            "lista" => null
        );
        try {
            $consulta = "SELECT presa.id_presupuesto_asignado, presu.descripcion AS presupuesto, usua.nombre AS area, CONCAT(traco.apellidos, ', ', traco.nombres) AS colaborador, presa.fecha_inicio,presa.fecha_final, presa.estado FROM presupuesto_asignado AS presa
            LEFT JOIN presupuesto AS presu ON presa.id_presupuesto = presu.id_presupuesto
            LEFT JOIN usuario_area AS usua ON presa.id_area =  usua.id_area
            LEFT JOIN trabajador AS traco ON presa.id_trabajador = traco.id_trabajador
            ORDER BY presa.id_presupuesto_asignado ASC LIMIT $desde, $hasta;";

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

    public function getPresupuestoAsigCount($cantidad = 20)
    {
        $result = array(
            "mostrado" => 1,
            "total" => 1,
            "pagina_actual" => 1,
            "pagina_total" => 1
        );
        try {
            $sql = $this->cn->query("SELECT COUNT(0) AS total FROM presupuesto_asignado;");
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
        $id_presupuesto, $id_area, $id_trabajador, $fecha_inicio, $fecha_final, $usu_crea
    ) {
        $result = false;
        $consulta = "";
        try {
            $consulta = "INSERT INTO presupuesto_asignado(id_presupuesto, id_area, id_trabajador, fecha_inicio, 
            fecha_final, usu_crea) VALUES ( $id_presupuesto, $id_area, $id_trabajador, '$fecha_inicio', 
            '$fecha_final', $usu_crea);";

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
       $id_presupuesto_asignado, $id_presupuesto, $id_area, $id_trabajador, $fecha_inicio, $fecha_final, $usu_crea
    ) {
        $result = false;
        $consulta = "";
        try {
            $consulta = "UPDATE presupuesto_asignado SET id_presupuesto=$id_presupuesto,id_area=$id_area,
            id_trabajador=$id_trabajador,fecha_inicio='$fecha_inicio',fecha_final='$fecha_final',
            usu_crea=$usu_crea WHERE id_presupuesto_asignado=$id_presupuesto_asignado LIMIT 1;";

            $sql = $this->cn->query($consulta);
            if ($sql) {
                $result = true;
            }
        } catch (Exception $ex) {
            $result = false;
        }

        return $result;
    }

    public function desactivarPresupuesto($id_presupuesto_asignado , $valor)
    {
        $result = false;

        $consulta = "UPDATE presupuesto_asignado  SET estado=$valor WHERE id_presupuesto_asignado=$id_presupuesto_asignado  LIMIT 1;";

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

        $consulta= "SELECT id_area AS id, nombre FROM usuario_area WHERE estado = 1;";

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
