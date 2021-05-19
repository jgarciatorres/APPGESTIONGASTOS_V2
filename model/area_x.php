<?php
class area_x
{

    private $cn = null;

    public function __construct($conexion)
    {
        $this->cn = $conexion;
    }

    public function getAreaList($desde = 0, $hasta = 20)
    {
        $result = array(
            "estado" => "2",
            "paginacion" => null,
            "mensaje" => "No se realizo la consulta",
            "lista" => null
        );
        try {
            $consulta = "SELECT id_area,nombre,centro_costos,estado FROM usuario_area 
            ORDER BY id_area ASC LIMIT $desde, $hasta;";

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

    public function getAreaCount($cantidad = 20)
    {
        $result = array(
            "mostrado" => 1,
            "total" => 1,
            "pagina_actual" => 1,
            "pagina_total" => 1
        );
        try {
            $sql = $this->cn->query("SELECT COUNT(0) AS total FROM usuario_area;");
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


    public function guardarArea(
        $nombre,
        $centro
    ) {
        $result = false;
        $consulta = "";
        try {
            $consulta = "INSERT INTO usuario_area(nombre,centro_costos) VALUES('$nombre','$centro');";

            $sql = $this->cn->query($consulta);
            if ($sql) {
                $result = true;
            }
        } catch (Exception $ex) {
            $result = false;
        }

        return $result;
    }

    public function editarArea(
        $id_area,
        $nombre,
        $centro
    ) {
        $result = false;
        $consulta = "";
        try {
            $consulta = "UPDATE usuario_area SET nombre='$nombre',centro_costos='$centro' WHERE id_area=$id_area LIMIT 1;";

            $sql = $this->cn->query($consulta);
            if ($sql) {
                $result = true;
            }
        } catch (Exception $ex) {
            $result = false;
        }

        return $result;
    }

    public function desactivarArea($id_area, $valor)
    {
        $result = false;

        $consulta = "UPDATE usuario_area SET estado=$valor WHERE id_area=$id_area LIMIT 1;";

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
