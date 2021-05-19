<?php
include('mysql_login.php');
class database extends mysql_login{

    protected $mi_servidor;
    protected $mi_usuario;
    protected $mi_contrasenia;
    protected $mi_basedatos;
    protected $mi_puerto;

    private $mi_mysqlicon;

    public function __construct() {
        $parametros = new mysql_login();
        $this->mi_servidor=$parametros->servidor;
        $this->mi_usuario=$parametros->usuario;
        $this->mi_contrasenia=$parametros->contrasenia;
        $this->mi_basedatos=$parametros->basedatos;
        $this->mi_puerto=$parametros->puerto;
        $this->mi_mysqlicon = $this->instanciarConexion();
    }

    private function instanciarConexion(){
        try{
            //Cambio
            $mi_retorno = new mysqli($this->mi_servidor,$this->mi_usuario, $this->mi_contrasenia,$this->mi_basedatos,$this->mi_puerto);
            $mi_retorno->set_charset('utf8');
            return $mi_retorno;
        }catch (Exception $e) {
            return null;
        }
    }

    public function getCurrentConnection(){
        return $this->mi_mysqlicon;
    }
}
?>