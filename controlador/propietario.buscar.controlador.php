<?php
require_once '../negocio/Propietario.class.php';

$dni = $_POST["p_dni"];
$obj=new Propietario();
try {
    
    $resultado=$obj->buscar($dni);    
    
//    echo '<pre>';
  //  print_r($datosArray);
   // echo '</pre>';
    echo json_encode($resultado);
} catch (Exception $exc) {
    echo $exc->getMessage();
    
}

