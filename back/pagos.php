<?php
@session_start();
include_once 'conexion.php';

if(isset($_POST['agregar'])){
    $recobro = 0;
    $tipo = mysqli_real_escape_string($conexion, $_POST["tipo"]);
    $monto = mysqli_real_escape_string($conexion, $_POST["monto"]);
    $fecha = mysqli_real_escape_string($conexion, $_POST["fecha"]);
    $tipoPago = mysqli_real_escape_string($conexion, $_POST["tipoPago"]);
    $id = mysqli_real_escape_string($conexion, $_POST["id"]);
    $recobro = mysqli_real_escape_string($conexion, $_POST["recobro"]);
    $status = "Pagado";

    $monto = $monto + $recobro;
    
    $sql = "INSERT INTO payments(member_id, type, amount, pay_status, pay_date, pay_type) 
                    VALUES('$id', '$tipo', '$monto', '$status', '$fecha', '$tipoPago')";
    $guardando = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
    if($guardando){
        limpia_base($conexion, $fecha);
        $_SESSION['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Pago registrado correctamente
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
        header('Location: ../detalle.php?id='.$id);
    }
}

function limpia_base($conexion, $fecha){
    $limpia = "DELETE p1 FROM payments p1
                INNER JOIN payments p2
                WHERE p1.id > p2.id
                AND p1.pay_date = '$fecha'
                AND p1.pay_date = p2.pay_date
                AND p1.member_id = p2.member_id
                AND p1.pay_type = p2.pay_type";
    $sql = mysqli_query($conexion, $limpia) or die(mysqli_error($conexion));
}

if(isset($_POST['modificarPago'])){
    $tipo = mysqli_real_escape_string($conexion, $_POST["tipo"]);
    $monto = mysqli_real_escape_string($conexion, $_POST["monto"]);
    $fecha = mysqli_real_escape_string($conexion, $_POST["fecha"]);
    $tipoPago = mysqli_real_escape_string($conexion, $_POST["tipoPago"]);
    $id = mysqli_real_escape_string($conexion, $_POST["id"]);
    $id_socio = mysqli_real_escape_string($conexion, $_POST["member_id"]);
    
    $sql = "UPDATE payments SET type = '$tipo', amount = '$monto', pay_date = '$fecha', pay_type = '$tipoPago' 
    WHERE id = '$id' ";
    mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    $fecha_hora = explode(' ', $fecha);
    $fecha_temp = explode('-', $fecha_hora[0]);
    $fecha = $fecha_temp[2].'/'.$fecha_temp[1].'/'.$fecha_temp[0];

    $_SESSION['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Pago del día '.$fecha.' actualizado correctamente
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
    header('Location: ../detalle.php?id='.$id_socio);
}

if(isset($_POST['id_pago']) and isset($_POST['id'])){
    $pago_id = mysqli_real_escape_string($conexion, $_POST["id_pago"]);
    $id_socio = mysqli_real_escape_string($conexion, $_POST['id']);
    $sql = "DELETE FROM payments WHERE id = '$pago_id' ";
    $borrando = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
    if($borrando){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Pago borrado correctamente
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
    }else{
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Error al borrar el pago
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
    }
}

function historial_pagos($id, $conexion){
    $listado = '';
    $sql = "SELECT * FROM payments WHERE member_id = '$id' ORDER BY pay_date DESC";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    while($row = mysqli_fetch_array($busca)){
        
        $listado.= '<tr>
                        <td>'.$row['pay_status'].'</td>
                        <td>'.$row['pay_date'].'</td>
                        <td>'.$row['amount'].'</td>';
        if(is_admin()){
            $listado.='<td><a href="modificar_pago.php?id='.$row['id'].'">
                                <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top">
                                    <i class="fas fa-fw fa-pen"></i>
                                </button>
                            </a>
                        </td>
                        <td>
                            <button type="button" id="eliminar_pago" class="btn btn-danger" onclick="eliminar_pago('.$row['id'].', '.$id.');">
                                <i class="fas fa-fw fa-trash"></i>
                            </button>
                        </td>';
        }
        $listado.='</tr>';
    }
    return $listado;
}

function pago_datos($id, $conexion){
    $sql = "SELECT * FROM payments WHERE id = '$id' ";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
    if($row = mysqli_fetch_array($busca)){
        return $row;
    }
}

function frecuencia($tipo){
    $combo = '';
    $tipo = strtolower($tipo);
    switch ($tipo) {
        case 'mensual':
            $combo = '<option value="mensual" selected>Mensual</option>
                        <option value="diario">Diario</option>';
            break;
        case 'diario':
            $combo = '<option value="mensual" >Mensual</option>
                    <option value="diario" selected>Diario</option>';
            break;
        default:
            $combo = '<option value="mensual" >Mensual</option>
                    <option value="diario">Diario</option>';
            break;
    }
    return $combo;
}

function tipo_pago($tipoPago){
    $combo = '';
    $tipoPago = strtolower($tipoPago);
    switch ($tipoPago) {
        case 'efectivo':
            $combo = '<option value="efectivo" selected>Efectivo</option>
                        <option value="mercadopago">Mercado Pago</option>
                        <option value="debito">Débito</option>
                        <option value="credito">Crédito</option>';
            break;
        case 'mercadopago':
            $combo = '<option value="efectivo">Efectivo</option>
                        <option value="mercadopago" selected>Mercado Pago</option>
                        <option value="debito">Débito</option>
                        <option value="credito">Crédito</option>';
            break;
        case 'debito':
            $combo = '<option value="efectivo">Efectivo</option>
                        <option value="mercadopago">Mercado Pago</option>
                        <option value="debito" selected>Débito</option>
                        <option value="credito">Crédito</option>';
            break;
        case 'credito':
            $combo = '<option value="efectivo">Efectivo</option>
                        <option value="mercadopago">Mercado Pago</option>
                        <option value="debito">Débito</option>
                        <option value="credito" selected>Crédito</option>';
            break;
        default:
            $combo = '<option value="efectivo">Efectivo</option>
                        <option value="mercadopago">Mercado Pago</option>
                        <option value="debito">Débito</option>
                        <option value="credito">Crédito</option>';
            break;
    }
    return $combo;
}

?>