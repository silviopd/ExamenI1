<?php
require_once '../datos/conexion.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Propietario
 *
 * @author GIANMARCO
 */
class Propietario extends Conexion {
   
      public function buscar($dni) {
        try {
            $sql = "select * from propietario where dni= :p_dni";
            $sentencia = $this->dblink->prepare($sql);                        
            $sentencia->bindParam(":p_dni", $dni);;
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC); // con fetchAll existió un error no mostraba en casilleros
            return $resultado;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}
