<?php
include_once '../util.php';
include_once '../pagos.php';
$id = $_GET['id']; 
?>
<div class="card border-info shadow" style="width: 100%;">
    <div class="card-header">
    <h4>Historial de pagos</h4>
    <div id="mensaje_eliminar"></div>
                           
    </div>
    <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
            <th>Estado</th>
            <th>Fecha de pago</th>
            <th>Monto</th>
            <?php if(is_admin()){ ?>
                <th>Modificar</th>
                <th>Borrar</th>
            <?php } ?>
            </tr>
        </thead>
        <tfoot>
            <tr>
            <th>Estado</th>
            <th>Fecha de pago</th>
            <th>Monto</th>
            <?php if(is_admin()){ ?>
                <th>Modificar</th>
                <th>Borrar</th>
            <?php } ?>
            </tr>
        </tfoot>
        <tbody>
            <?php echo historial_pagos($id, $conexion);?>
        </tbody>
        </table>
    </div>
    </div>
</div>