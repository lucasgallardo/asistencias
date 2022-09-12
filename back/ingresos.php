<?php 
include_once 'conexion.php';
function tipo_de_ingresos($conexion){
    $hoy = date('Y-m-d');
    $listado = '';
    $total = 0;
    $sql = "SELECT * FROM tipos_pagos";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    while($row = mysqli_fetch_array($busca)){
        $total_octopus = suma_totales_octopus($conexion, $row['nombre'], $hoy);
        $total_tienda = suma_totales_tienda($conexion, $row['nombre'], $hoy); //sumo totales de la tienda
        $total_parcial = $total_octopus + $total_tienda;
        $total = $total + $total_parcial;
        $listado.= '<div class="card">
                        <div class="card-body">
                        <h5 class="card-title text-capitalize">'.$row['nombre'].'</h5>
                        <p class="card-text">$'.$total_parcial.'</p>
                        <small class="form-text text-muted">$'.$total_tienda.' de la tienda</small>
                        </div>
                    </div>
                ';        
    }
    if($total > 0){
        $listado.= '<div class="card border-info">
                        <div class="card-body text-info">
                        <h5 class="card-title text-capitalize">Total</h5>
                        <p class="card-text">$'.$total.'</p>
                        </div>
                    </div>
                ';  
    }
    return $listado;
}

function suma_totales_octopus($conexion, $tipo_pago, $fecha){
    $resultado = 0;
    $sql = "SELECT SUM(amount) as total 
            FROM payments 
            WHERE pay_date = '$fecha' 
            AND pay_type = '$tipo_pago'
            ";
          
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    if($row = mysqli_fetch_array($busca)){
        $resultado = $resultado + $row['total'];
    }
    
    $resultado = round($resultado, 2);
    return $resultado;
}

function suma_totales_tienda($conexion, $tipo_pago, $fecha){
    $resultado = 0;
    $sql = "SELECT SUM(total) as totales
            FROM operaciones 
            WHERE DATE(fecha) = '$fecha' 
            AND tipo_pago = '$tipo_pago'
            ";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    if($row = mysqli_fetch_array($busca)){
        $resultado = $resultado + $row['totales'];
    }

    $resultado = round($resultado, 2);
    return $resultado;
}

function ingresos_por_fecha($conexion, $desde, $hasta){
    $listado = '';
    $total = 0;
    $sql = "SELECT * FROM tipos_pagos";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    while($row = mysqli_fetch_array($busca)){
        $total_octopus = suma_totales_octopus_por_fecha($conexion, $row['nombre'], $desde, $hasta);
        $total_tienda = suma_totales_tienda_por_fecha($conexion, $row['nombre'], $desde, $hasta); //sumo totales de la tienda
        $total_parcial = $total_octopus + $total_tienda;
        $total = $total + $total_parcial;
        $listado.= '<div class="card">
                        <div class="card-body">
                        <h5 class="card-title text-capitalize">'.$row['nombre'].'</h5>
                        <p class="card-text">$'.$total_parcial.'</p>
                        <small class="form-text text-muted">$'.$total_tienda.' de la tienda</small>
                        </div>
                    </div>
                ';        
    }
    if($total > 0){
        $listado.= '<div class="card border-info">
                        <div class="card-body text-info">
                        <h5 class="card-title text-capitalize">Total</h5>
                        <p class="card-text">$'.$total.'</p>
                        </div>
                    </div>
                ';  
    }
    return $listado;
}

function suma_totales_octopus_por_fecha($conexion, $tipo_pago, $desde, $hasta){
    $resultado = 0;
    $sql = "SELECT SUM(amount) as total
            FROM payments 
            WHERE pay_date BETWEEN '$desde' AND '$hasta'
            AND pay_type = '$tipo_pago'
            ";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    if($row = mysqli_fetch_array($busca)){
        $resultado = $resultado + $row['total'];
    }
    $resultado = round($resultado, 2);
    return $resultado;
}

function suma_totales_tienda_por_fecha($conexion, $tipo_pago, $desde, $hasta){
    $resultado = 0;
    $sql = "SELECT SUM(total) as totales
            FROM operaciones 
            WHERE DATE(fecha) BETWEEN '$desde' AND '$hasta'
            AND tipo_pago = '$tipo_pago'
            ";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    if($row = mysqli_fetch_array($busca)){
        $resultado = $resultado + $row['totales'];
    }

    $resultado = round($resultado, 2);

    return $resultado;
}
?>