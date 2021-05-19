<?php
class usuario_x
{

    private $cn = null;

    public function __construct($conexion)
    {
        $this->cn = $conexion;
    }

    public function getUsuarioList($desde = 0, $hasta = 20)
    {
        $result = array(
            "estado" => "2",
            "paginacion" => null,
            "mensaje" => "No se realizo la consulta",
            "lista" => null
        );
        try {
            $consulta = "SELECT usuc.id_usuario, usuct.nombre AS tipo, usuca.nombre AS area, usuc.nombres, usuc.apellidos, usuc.usuario, usuc.clave, usuc.estado FROM usuario AS usuc
            LEFT JOIN usuario_tipo AS usuct ON usuc.id_tipo = usuct.id_tipo
            LEFT JOIN usuario_area AS usuca ON usuc.id_area = usuca.id_area
            ORDER BY usuc.id_usuario ASC LIMIT $desde, $hasta;";

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

    public function getUsuarioCount($cantidad = 20)
    {
        $result = array(
            "mostrado" => 1,
            "total" => 1,
            "pagina_actual" => 1,
            "pagina_total" => 1
        );
        try {
            $sql = $this->cn->query("SELECT COUNT(0) AS total FROM usuario;");
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


    public function guardarUsuario(
        $id_tipo, $id_area, $nombres, $apellidos, $usuario, $clave, $usu_crea
    ) {
        $result = false;
        $consulta = "";
        try {
            $consulta = "INSERT INTO usuario(id_tipo, id_area, nombres, apellidos, usuario, clave, usu_crea) 
            VALUES($id_tipo,$id_area,'$nombres','$apellidos', '$usuario', '$clave', $usu_crea);";

            $sql = $this->cn->query($consulta);
            if ($sql) {
                $result = true;
            }
        } catch (Exception $ex) {
            $result = false;
        }

        return $result;
    }


    public function editarUsuario(
        $id_usuario, $id_tipo, $id_area, $nombres, $apellidos, $usuario, $clave, $usu_crea
    ) {
        $result = false;
        $consulta = "";
        try {
            $consulta = "UPDATE usuario SET id_tipo=$id_tipo,id_area=$id_area,nombres='$nombres',apellidos='$apellidos', 
            usuario='$usuario',clave='$clave',usu_crea=$usu_crea WHERE id_usuario=$id_usuario LIMIT 1;";

            $sql = $this->cn->query($consulta);
            if ($sql) {
                $result = true;
            }
        } catch (Exception $ex) {
            $result = false;
        }

        return $result;
    }

    public function desactivarUsuario($id_area, $valor)
    {
        $result = false;

        $consulta = "UPDATE usuario SET estado=$valor WHERE id_usuario=$id_area LIMIT 1;";

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

        $consulta= "SELECT id_usuario AS id, CONCAT(apellidos, ', ', nombres) nombre FROM usuario WHERE estado = 1;";

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
