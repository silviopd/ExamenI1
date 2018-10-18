<?php


require_once '../negocio/Vehiculo.class.php';

$dni = $_GET["dni"];

if (!$dni){
    return;
}

$obj = new Vehiculo();
try {
    $resultado = $obj->listarPlaca($dni);
    
   
} catch (Exception $exc){
    header("HTTP/1.1 500"); 
    echo $exc->getMessage();
    exit();
}

echo '<option value="">Seleccione una línea telefónica';

for ($i = 0; $i < count($resultado); $i++) {
        echo '<option value="'.$resultado[$i]["numero_placa"].'">'.$resultado[$i]["numero_placa"].'</option>';
    }

