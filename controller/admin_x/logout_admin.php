<?php
include("../shared/xheader.php");
require_once('../../model/xresponse.php');

$xresponse = new xresponse();

if (isset($_POST['x_key'])) {
    unset($_SESSION['session_admin']);
    if(array_key_exists('session_admin', $_SESSION)){
        $xresponse->setEstado(-1);
        $xresponse->setMensaje(-1);
    }else{
        $xresponse->setEstado(1);
        $xresponse->setMensaje(1);
    }    
}

print $xresponse->getResponseAllJson();

?>