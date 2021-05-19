<?php
class mysql_login{
    protected $servidor;
    protected $usuario;
    protected $contrasenia;
    protected $basedatos;
    protected $puerto;

    public function __construct(){
        $this->servidor="localhost";
        $this->usuario="root";
        $this->contrasenia="";
        $this->basedatos="app_presupuestos";
        $this->puerto=3306;
    }
}
?>