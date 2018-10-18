<?php

require_once '../negocio/vehiculo.class.php';

$numPlaca = $_POST["p_num_placa"];

$obj = new Vehiculo();

try {
    $registros = $obj->listarRecibos($numPlaca);
} catch (Exception $exc){
    header("HTTP/1.1 500"); //CONFIGURAR AL NAVEGADOR QUE RECONOZA EL MENSAJE COMO ERROR
    echo $exc->getMessage();
    exit();
}

?>

<table id="tabla-listado" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>N. DEUDA</th>
                <th>Descripcion Infraccion</th>                
                <th style="text-align: right">IMPORTE</th>
                <th style="text-align: right">SALDO</th>
                <th style="text-align: right">IMPORTE A PAGAR</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
    
        <tbody id="detallepago">
            <?php
                for ($i=0; $i<count($registros);$i++) {
                    echo '<tr>';
                    echo '<td>'.$registros[$i][0].'</td>';
                    echo '<td>'.$registros[$i][1].'</td>';
                    echo '<td>'.$registros[$i][2].'</td>';
                    echo '<td>'.$registros[$i][3].'</td>';                   
                    echo '<td id="importepagar">'.$registros[$i][4].'</td>';                    
                    echo '</tr>';                        
                }
            ?>
        </tbody>

    </table>

