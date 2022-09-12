<?php
@session_start();
include_once 'conexion.php';

if(isset($_POST['abrir'])){
    $valorInicio = mysqli_real_escape_string($conexion, $_POST["monto"]);
    $fecha = date('Y-m-d');
    $user_id = $_SESSION['user'];
    $status = 1;
   

    $sql = "INSERT INTO cash(open, date, user_id_open, status) 
    VALUES('$valorInicio', '$fecha', '$user_id', '$status')";
    $guarda = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    if($guarda){
        $_SESSION['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Caja iniciada correctamente
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
        header('Location: ../caja.php');
    }else{
        $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Error al iniciar caja
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';;
        header('Location: ../caja.php');
    }
}

if(isset($_POST['cerrar'])){

    $valorCierre = mysqli_real_escape_string($conexion, $_POST["monto"]);
    $fecha = date('Y-m-d');
    $user_id = $_SESSION['user'];
    $status = 0;
   

    $sql = "UPDATE cash SET close = '$valorCierre', status = '$status', user_id_close = '$user_id' WHERE date = '$fecha' ";
    $actualiza = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
    if($actualiza){
        $_SESSION['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Caja cerrada correctamente
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
        header('Location: ../caja.php');
    }else{
        $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Error al cerrar caja
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
        header('Location: ../caja.php');
    }
}

function input_type($user_id, $conexion){
    $button = "";
    $hoy = date('Y-m-d');

    $sql = "SELECT * FROM cash WHERE date = '$hoy' AND status = 1";
    $query = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
    if($row = mysqli_fetch_array($query)){
        $montoFinal = suma_montos($hoy, $user_id, $conexion, $row['open']);
        $button = '<label for="monto">Monto cierre</label>
                  <input type="text" class="form-control" id="monto" name="monto" placeholder="0" readonly value="'.$montoFinal.'">';
    }else{
        $button = '<label for="monto">Base apertura</label>
                  <input type="number" min="0.00" step="0.01" class="form-control" id="monto" name="monto" placeholder="0">';
    }

    return $button;
}

function button_type($user_id, $conexion){
    $button = "";
    $hoy = date('Y-m-d');

    $sql = "SELECT * FROM cash WHERE date = '$hoy' AND status = 1";
    $query = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
    if($row = mysqli_fetch_array($query)){
        $button = '<button class="btn btn-primary btn-lg" name="cerrar" type="submit">Cierre</button>';
    }else{
        $button = '<button class="btn btn-primary btn-lg" name="abrir" type="submit">Apertura</button>';
    }

    return $button;
}

function suma_montos($hoy, $user_id, $conexion, $inicial){
    $total = $inicial;
    $sql = "SELECT SUM(amount) total FROM payments WHERE pay_date = '$hoy' ";
    $query = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
    if($row = mysqli_fetch_array($query)){
        $total = $total + $row['total'];
    }
    $sql2 = "SELECT SUM(total) totalventas FROM operaciones WHERE DATE(fecha) = '$hoy'";
    $query = mysqli_query($conexion, $sql2) or die(mysqli_error($conexion));
    if($row = mysqli_fetch_array($query)){
        $total = $total + $row['totalventas'];
    }
    
    return $total;
}

function cash_list($conexion, $user){
    $listado = '';
    $sql = "SELECT * FROM cash ORDER BY id DESC";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    while($row = mysqli_fetch_array($busca)){
        $_SESSION['id_caja'] = $row['id'];
        if($row['close']==""){
            $listado.= '<tr class="table-info">
                    <td>'.$row['date'].'</td>
                    <td>'.$row['open'].'</td>
                    <td>'.nombre_user($conexion, $row['user_id_open']).'</td>
                    <td>'.$row['close'].'</td>
                    <td>'.nombre_user($conexion, $row['user_id_close']).'</td>
                </tr>
                ';
        }else{
            $listado.= '<tr">
                    <td>'.$row['date'].'</td>
                    <td>'.$row['open'].'</td>
                    <td>'.nombre_user($conexion, $row['user_id_open']).'</td>
                    <td>'.$row['close'].'</td>
                    <td>'.nombre_user($conexion, $row['user_id_close']).'</td>
                </tr>
                ';
        }
        
    }
    return $listado;
}

function nombre_user($conexion, $user_id){
    $sql = "SELECT name, surname FROM users WHERE id = '$user_id' ";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
    if($row = mysqli_fetch_array($busca)){
        return $row['name'].' '.$row['surname'];
    }else{
        return ' ';
    }
}

?>