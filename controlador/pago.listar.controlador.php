<?php

require_once '../negocio/Pagos.class.php';
require_once '../util/funciones/Funciones.class.php';

$fecha1 = $_POST["p_fecha1"];
$fecha2 = $_POST["p_fecha2"];
$tipo   = $_POST["p_tipo"];

try {
    $obj = new Pagos();
    $registros = $obj->listar($fecha1, $fecha2, $tipo);
  
} catch (Exception $exc) {
    Funciones::mensaje
            (
                $exc->getMessage(), 
                "e"
            );
}

?>


<table id="tabla-listado" class="table table-bordered table-striped">
        <thead>
                <tr>
                        <th>OPCIÓN</th>
                        <th>N.Pago</th>
                        <th>Fecha Pago</th>                        
                        <th>Propietario</th>                        
                        <th>Placa</th>
                        <th>Total Pagado</th>
                        <th>ESTADO</th>
                </tr>
        </thead>
        <tbody id="datos-detalle">
            <?php
                for ($i=0; $i<count($registros);$i++) {
                    if ($registros[$i][5]=="ANULADO"){
                        echo '<tr style="text-decoration:line-through; color:red">';
                            echo '
                                <td align="center">
                                    &nbsp;
                                </td>
                                ';
                    }else{
                        echo '<tr>';
                            echo '
                                <td align="center">
                                    <a href="javascript:void();" onclick = "anular('.$registros[$i]["0"].')"><i class="fa fa-trash text-orange"></i></a>
                                </td>
                                ';
                    }
                        
                    echo '<td>'.$registros[$i][0].'</td>';
                    echo '<td>'.$registros[$i][1].'</td>';
                    echo '<td>'.$registros[$i][2].'</td>';
                    echo '<td>'.$registros[$i][3].'</td>';
                    echo '<td>'.$registros[$i][4].'</td>';
                    echo '<td>'.$registros[$i][5].'</td>';
                    
                    
                    echo '</tr>';
                        
                }
            ?>

        </tbody>

    </table>
