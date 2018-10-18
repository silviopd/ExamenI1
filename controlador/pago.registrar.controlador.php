<?php

require_once '../negocio/Pagos.class.php';

parse_str($_POST["p_datos_cabecera"],$datosCabecera);

$datosDetalle = $_POST["p_datos_detalle"];

/*
parse_str($_POST["p_array_datos_cabecera"],$datosCabecera);

$datosDetalle = $_POST["p_json_datos_detalle"];
*/
$obj = new Pagos();

$obj->setFechaPago($datosCabecera["txtfec"]);
$obj->setTotal($datosCabecera["txtimporteneto"]);
$obj->setDetalle($datosDetalle);

try {
    if($obj->agregar()){
        echo 'exito';
    }
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}