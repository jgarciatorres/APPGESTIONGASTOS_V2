<?php
class xresponse{
    private $x_response = array(
        'estado' => 0,
        'dato' => null,
        'mensaje' => '',
    );
    public function setEstado($x_estado){
        if(is_array($x_estado)){
            $this->x_response['estado'] = 1;
            $this->x_response['dato'] = $x_estado;
        }else{
            $this->x_response['estado'] = $x_estado;
        }
    }
    public function setDato($x_dato){
        $this->x_response['dato'] = $x_dato;
    }
    public function setMensaje($x_estado){
        if($x_estado == 0 ){
            $this->x_response['mensaje']  = 'Credenciales invalidas';
        }else if($x_estado == - 1){
            $this->x_response['mensaje']  = 'Error en la consulta';
        }else{
            $this->x_response['mensaje']  = 'Exito en la consulta';
        }
    }
    public function getResponseAll(){
        return $this->x_response;
    }
    public function getResponseAllJson(){
        return json_encode($this->x_response, JSON_UNESCAPED_UNICODE);;
    }
}
