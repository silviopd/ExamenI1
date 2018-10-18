<?php

require_once '../datos/conexion.php';

/**
 * Description of Vehiculo
 *
 * @author GIANMARCO
 */
class Vehiculo extends Conexion{
    //put your code here
    public function listarPlaca($dni){
        try {
            $sql = "select v.numero_placa from vehiculo v inner join propietario p on v.dni=p.dni where p.dni=:p_dni";
            $sentencia = $this->dblink->prepare($sql);            
             $sentencia->bindParam(":p_dni", $dni);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function listarRecibos($placa){
        try {
            $sql = "select numero_infraccion, fecha_vencimiento, importe, saldo, 0 as importe "
                    . "from infraccion "
                    . "where numero_placa = :p_num and saldo<>'0' "
                    . "order by fecha_vencimiento";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_num", $placa);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();

            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
   
}
