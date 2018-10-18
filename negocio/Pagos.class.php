<?php
require_once '../datos/conexion.php';
/**
 * Description of Pagos
 *
 * @author GIANMARCO
 */
class Pagos extends Conexion{
    
    private $numPago;
    private $fechaPago ;    
    private $total;
    
    private $detalle;
    
    public function getNumPago() {
        return $this->numPago;
    }

    public function getFechaPago() {
        return $this->fechaPago;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getDetalle() {
        return $this->detalle;
    }

    public function setNumPago($numPago) {
        $this->numPago = $numPago;
    }

    public function setFechaPago($fechaPago) {
        $this->fechaPago = $fechaPago;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function setDetalle($detalle) {
        $this->detalle = $detalle;
    }

    
    public function listar($fecha1, $fecha2, $tipo) {
        try {
            $sql = "select * from f_listado_pago(:p_fecha1, :p_fecha2, :p_tipo)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_fecha1", $fecha1);
            $sentencia->bindParam(":p_fecha2", $fecha2);
            $sentencia->bindParam(":p_tipo", $tipo);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function listarCuotas($numPlaca){
        try {
            $sql = "
                    select numero_deuda, descripcion_infraccion, fecha_vencimiento, importe, saldo, 0 as importepagar 
                    from deuda 
                    where numero_placa = :p_num_placa and saldo<>'0'
                    order by fecha_vencimiento";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_num_placa", $numPlaca);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();

            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    
    public function agregar() {
        $this->dblink->beginTransaction();
        
        try {
            $sql = "select numero+1 as num from correlativo where tabla = 'pago'";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            
            if ($sentencia->rowCount()){
                $nuevoCodigo = $resultado["num"];
                $this->setNumPago($nuevoCodigo);
                
                $sql = "insert into pago (numero_pago,fecha_pago,total) "
                        . "values(:p_num_pago, :p_fecha_pago, :p_total) ";
                
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_num_pago", $this->getNumPago());
                $sentencia->bindParam(":p_fecha_pago", $this->getFechaPago());
                $sentencia->bindParam(":p_total", $this->getTotal());
                $sentencia->execute();
                
                $datosDetalle = json_decode($this->getDetalle());
                
                foreach ($datosDetalle as $key => $value) {
                    $sql = "insert into pago_detalle ("
                            . "numero_pago, numero_infraccion,importe_pagado) "
                            . "values"
                            . "(:p_numero_pago,:p_numero_deuda,:p_importe_pagado)";

                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_numero_pago", $this->getNumPago());
                    $sentencia->bindParam(":p_numero_deuda", $value->numInfraccion);
                    $sentencia->bindParam(":p_importe_pagado", $value->importe);
                    $sentencia->execute();

                    $sql = "update infraccion set saldo = saldo - :p_importe "
                            . "where numero_placa = :p_num_placa and numero_infraccion = :p_num_infraccion";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_importe", $value->importe);
                    $sentencia->bindParam(":p_num_placa", $value->numPlaca);
                    $sentencia->bindParam(":p_num_infraccion", $value->numInfraccion);
                    $sentencia->execute();
                }
                
                $sql = "update correlativo set numero = numero + 1 where tabla = 'pago'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                
                $this->dblink->commit();
                
            }
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return true;
    }
    
    public function anular(){
        $this->dblink->beginTransaction();
        try {
            $sql = " select pd.importe_pagado, i.numero_placa, pd.numero_infraccion
                        from infraccion i inner join pago_detalle pd on pd.numero_infraccion=i.numero_infraccion
                        where pd.numero_pago = :p_num_pago";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_num_pago", $this->getNumPago());
            $sentencia->execute();
            
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            for ($i = 0; $i < count($resultado); $i++) {
                $sql = "update infraccion set saldo = saldo + :p_importe "
                        . "where numero_infraccion = :p_num_infraccion and numero_placa = :p_num_placa";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_importe", $resultado[$i]["importe_pagado"]);
                $sentencia->bindParam(":p_num_infraccion", $resultado[$i]["numero_infraccion"]); /*no cambié resultado*/
                $sentencia->bindParam(":p_num_placa", $resultado[$i]["numero_placa"]);
                $sentencia->execute();
            }
            
            $sql = "update pago set estado = 'A' where numero_pago = :p_num_pago";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_num_pago", $this->getNumPago());
            $sentencia->execute();
            
            $this->dblink->commit();
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        return true;
    }
}
