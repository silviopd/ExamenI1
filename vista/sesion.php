<?php
 /*   session_name("siscomercial");
    session_start();
    
    if ( ! isset($_SESSION["s_nombre"])){
        header("location:index.php");
    }
    
    $nombreUsuario = $_SESSION["s_nombre"];
    $cargoUsuario = $_SESSION["s_cargo"];
    $dniUsuario = $_SESSION["s_dni"];
   */ 
$dniUsuario = 72210475;
    if (file_exists ( "../imagenes/".$dniUsuario .".png" )){
        $fotoUsuario = $dniUsuario . ".png";
    }else{
        $fotoUsuario = "sin-foto.jpg";
    }
    
    
    
?>