<?php
class tipo_x
{

    private $cn = null;

    public function __construct($conexion)
    {
        $this->cn = $conexion;
    }

    public function getListSelect()
    {
        $result = array(
            "estado" => "2",
            "mensaje" => "Fracaso",
            "lista" => null
        );

        $consulta= "SELECT id_tipo AS id, nombre FROM usuario_tipo WHERE estado = 1;";

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
