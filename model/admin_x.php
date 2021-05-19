<?php
class admin_x{

    private $cn = null;

    public function __construct($conexion){ $this->cn = $conexion; }

    public function getLogin($usuario, $clave){

        $consulta = "SELECT id_usuario FROM usuario WHERE usuario = '$usuario' AND clave = '$clave' LIMIT 1";

        try {
            $sql = $this->cn->query($consulta);
            if ($sql) {
                if ($sql->num_rows > 0) {
                    return $sql->fetch_assoc();
                } else {
                    return 0;
                }
            } else {
                return -1;
            }
        } catch (Exception $e) {
            return -1;
        }
    }
}
