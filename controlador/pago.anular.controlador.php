<?php

    require_once '../negocio/Pagos.class.php';
    require_once '../util/funciones/Funciones.class.php';   
    
    $numPago = $_POST["p_num_pago"];
    
    $obj = new Pagos();
    
    try {
        $obj->setNumPago($numPago);
        if($obj->anular()){
            echo 'exito';
        }
    } catch (Exception $exc) {
        header("HTTP/1.1 500");
        echo $exc->getMessage();
    }