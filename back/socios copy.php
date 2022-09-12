<?php
@session_start();
include_once 'conexion.php';

if(isset($_POST['guardar'])){
    $numero = mysqli_real_escape_string($conexion, $_POST["numero"]);
    $documento = mysqli_real_escape_string($conexion, $_POST["documento"]);
    $sexo = mysqli_real_escape_string($conexion, $_POST["sexo"]);
    $nombre = mysqli_real_escape_string($conexion, $_POST["nombre"]);
    $edad = mysqli_real_escape_string($conexion, $_POST["edad"]);
    $generacion = mysqli_real_escape_string($conexion, $_POST["generacion"]);
    $prepaga = mysqli_real_escape_string($conexion, $_POST["prepaga"]);
    $firmo = mysqli_real_escape_string($conexion, $_POST["firmo"]);
    $tipo = mysqli_real_escape_string($conexion, $_POST["tipo"]);
    $turno = mysqli_real_escape_string($conexion, $_POST["turno"]);
    $mes_de_cuota = mysqli_real_escape_string($conexion, $_POST["fecha"]);
    $monto = mysqli_real_escape_string($conexion, $_POST["monto"]);
    $telefono = mysqli_real_escape_string($conexion, $_POST["telefono"]);
    $correo = mysqli_real_escape_string($conexion, $_POST["correo"]);
    $comentarios = mysqli_real_escape_string($conexion, $_POST["comentarios"]);

    $sql = "INSERT INTO members(dni, name, age, sex, generation, prepaid, sign, hour, type, phone, email, comments) 
    VALUES('$documento', '$nombre', '$edad', '$sexo', '$generacion', '$prepaga', '$firmo', '$turno', '$tipo', '$telefono', '$correo', '$comentarios')";
    mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    $query = "SELECT id FROM members ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conexion, $query) or die(mysqli_error($conexion));
    if($row = mysqli_fetch_array($result)){
        header('Location: ../detalle.php?id='.$numero);
    }else{
        header('Location: ../index.php');
    }
}

if(isset($_POST['editar'])){
    $numero = mysqli_real_escape_string($conexion, $_POST["numero"]);
    $documento = mysqli_real_escape_string($conexion, $_POST["documento"]);
    $sexo = mysqli_real_escape_string($conexion, $_POST["sexo"]);
    $nombre = mysqli_real_escape_string($conexion, $_POST["nombre"]);
    $edad = mysqli_real_escape_string($conexion, $_POST["edad"]);
    $generacion = mysqli_real_escape_string($conexion, $_POST["generacion"]);
    $prepaga = mysqli_real_escape_string($conexion, $_POST["prepaga"]);
    $firmo = mysqli_real_escape_string($conexion, $_POST["firmo"]);
    $tipo = mysqli_real_escape_string($conexion, $_POST["tipo"]);
    $turno = mysqli_real_escape_string($conexion, $_POST["turno"]);
    $mes_de_cuota = mysqli_real_escape_string($conexion, $_POST["fecha"]);
    $monto = mysqli_real_escape_string($conexion, $_POST["monto"]);
    $telefono = mysqli_real_escape_string($conexion, $_POST["telefono"]);
    $correo = mysqli_real_escape_string($conexion, $_POST["correo"]);
    $comentarios = mysqli_real_escape_string($conexion, $_POST["comentarios"]);
    $id = mysqli_real_escape_string($conexion, $_POST["id"]);

    $sql = "UPDATE members 
    SET dni = '$documento' , name = '$nombre', age = '$edad', sex = '$sexo', generation = '$generacion', 
        prepaid = '$prepaga', sign = '$firmo', hour = '$turno', type = '$tipo', phone = '$telefono', email = '$correo', comments = '$comentarios' WHERE id = '$id' ";
    $actualiza = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    if($actualiza){
        $_SESSION['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Datos actualizados correctamente
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
        header('Location: ../detalle.php?id='.$id);
    }else{
        $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Error al actualizar los datos
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
        header('Location: ../detalle.php?id='.$id);
    }
}

if (isset($_POST['fecha'])) {
    echo fecha($conexion, $_POST['desde'], $_POST['hasta']);
}elseif (isset($lugar) and $lugar == "ingresos") {
    echo today($conexion);  //DESCOMENTAR CUANDO TRABAJO LA PÁGINA DE INGRESOS
}

function today($conexion){ //lista los pagos de socios que se realizaron hoy
    $hoy = date('Y-m-d');
    $listado = '';
    $sql = "SELECT members.id, name, amount, pay_type, pay_date FROM payments 
            JOIN members ON payments.member_id = members.id
            WHERE pay_date = '$hoy'";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    while($row = mysqli_fetch_array($busca)){
        $listado.= '<tr">
                    <td>'.$row['id'].'</td>
                    <td>'.mi_fecha($row['pay_date']).'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['amount'].'</td>
                    <td>'.$row['pay_type'].'</td>
                    <td><a href="detalle.php?id='.$row['id'].'"><i class="fas fa-fw fa-eye"></i></a></td>
                </tr>
                ';        
    }
    return $listado;
}

function fecha($conexion, $desde, $hasta){ //lista los pagos de socios en un rango de fechas
    $hoy = date('Y-m-d');
    $listado = '';
    $sql = "SELECT members.id, name, amount, pay_type, pay_date, members.id FROM payments 
            JOIN members ON payments.member_id = members.id
            WHERE pay_date BETWEEN '$desde' AND '$hasta' ";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    while($row = mysqli_fetch_array($busca)){
        $listado.= '<tr">
                    <td>'.$row['id'].'</td>
                    <td>'.mi_fecha($row['pay_date']).'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['amount'].'</td>
                    <td>'.$row['pay_type'].'</td>
                    <td><a href="detalle.php?id='.$row['id'].'"><i class="fas fa-fw fa-eye"></i></a></td>
                </tr>
                ';        
    }
    return $listado;
}

function members_list($conexion){
    $listado = '';
    $sql = "SELECT id, name, lastname, hour, type, sign FROM members WHERE status = 1 ";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    while($row = mysqli_fetch_array($busca)){
        $ultimo_pago = ultimo_pago($row['id'], $conexion);
        $dias = moroso($ultimo_pago, $row['id'], $conexion);
        $ultima_asistencia = ultima_asistencia($row['id'], $conexion);
        
        if($dias > 30 and $row['type']=='mensual' and $ultimo_pago != '0000-00-00'){ //validación si socio mensual es moroso
            $listado.= '<tr class="table-danger">
                        <td>'.$row['id'].'</td>
                        <td>'.$row['name'].' '.$row['lastname'].'</td>
                        <td>'.$row['hour'].'</td>
                        <td>'.$row['type'].'</td>
                        <td>'.$row['sign'].'</td>
                        <td>'.$ultimo_pago.'</td>
                        <td><div id="mostrar_mensaje'.$row['id'].'">'.$ultima_asistencia.'</div></td>
                        <td>
                            <button type="button" id="asistencia" class="btn btn-success" onclick="dato_asistencia('.$row['id'].');">+1</button>
                        </td>
                        <td><a href="detalle.php?id='.$row['id'].'"><i class="fas fa-fw fa-eye"></i></a></td>
                    </tr>
                    ';
        }
        if($dias > 15 and $row['type']=='quincenal' and $ultimo_pago != '0000-00-00') { //validación si socio quincenal es moroso
            $listado.= '<tr class="table-danger">
                        <td>'.$row['id'].'</td>
                        <td>'.$row['name'].' '.$row['lastname'].'</td>
                        <td>'.$row['hour'].'</td>
                        <td>'.$row['type'].'</td>
                        <td>'.$row['sign'].'</td>
                        <td>'.$ultimo_pago.'</td>
                        <td><div id="mostrar_mensaje'.$row['id'].'">'.$ultima_asistencia.'</div></td>
                        <td>
                            <button type="button" id="asistencia" class="btn btn-success" onclick="dato_asistencia('.$row['id'].');">+1</button>
                        </td>
                        <td><a href="detalle.php?id='.$row['id'].'"><i class="fas fa-fw fa-eye"></i></a></td>
                    </tr>
                    ';
        } 
        elseif($dias > 1 and $row['type']=='diario' and $ultimo_pago != '0000-00-00') { //validación si socio diario es moroso
            $listado.= '<tr class="table-danger">
                        <td>'.$row['id'].'</td>
                        <td>'.$row['name'].' '.$row['lastname'].'</td>
                        <td>'.$row['hour'].'</td>
                        <td>'.$row['type'].'</td>
                        <td>'.$row['sign'].'</td>
                        <td>'.$ultimo_pago.'</td>
                        <td><div id="mostrar_mensaje'.$row['id'].'">'.$ultima_asistencia.'</div></td>
                        <td>
                            <button type="button" id="asistencia" class="btn btn-success" onclick="dato_asistencia('.$row['id'].');">+1</button>
                        </td>
                        <td><a href="detalle.php?id='.$row['id'].'"><i class="fas fa-fw fa-eye"></i></a></td>
                    </tr>
                    ';
        } else {
            $listado.= '<tr">
                        <td>'.$row['id'].'</td>
                        <td>'.$row['name'].' '.$row['lastname'].'</td>
                        <td>'.$row['hour'].'</td>
                        <td>'.$row['type'].'</td>
                        <td>'.$row['sign'].'</td>
                        <td>'.$ultimo_pago.'</td>
                        <td><div id="mostrar_mensaje'.$row['id'].'">'.$ultima_asistencia.'</div></td>
                        <td>
                            <button type="button" id="asistencia'.$row['id'].'" class="btn btn-success" onclick="dato_asistencia('.$row['id'].');">+1</button>
                        </td>
                        <td><a href="detalle.php?id='.$row['id'].'"><i class="fas fa-fw fa-eye"></i></a></td>
                    </tr>
                    ';
        }

        
    }
    return $listado;
}


function ultimo_pago($id, $conexion){
    $resultado = "";
    $sql = "SELECT pay_date FROM payments WHERE member_id = '$id' ORDER BY pay_date DESC LIMIT 1";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    if($row = mysqli_fetch_array($busca)){
        $resultado = $row['pay_date'];
    }else{
        $resultado = "0000-00-00";
    }

    return $resultado;
}

function ultima_asistencia($id, $conexion){
    $resultado = "";
    $sql = "SELECT day FROM attendance WHERE id_member = '$id' ORDER BY time DESC LIMIT 1";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    if($row = mysqli_fetch_array($busca)){
        $resultado = $row['day'];
    }else{
        $resultado = "0000-00-00";
    }

    return $resultado;
}

function moroso($ultimo_pago, $id, $conexion){
    $hoy = date('Y-m-d');
    $date1 = new DateTime($ultimo_pago);
    $date2 = new DateTime($hoy);
    $diff = $date1->diff($date2);
    return $diff->days."-";
}

// function fecha_arg($fecha){
//     $fecha_temp = explode('-', $fecha);
//     return $fecha_temp[2].'/'.$fecha_temp[1].'/'.$fecha_temp[0];
// }

function datos_socio($id, $conexion){
    $sql = "SELECT * FROM members WHERE id = '$id' ";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
    if($resultado = mysqli_fetch_array($busca)){
        return $resultado;
    }
}

function siguiente_id($conexion){
    $codigo = 0;
    $sql = "SELECT id FROM members ORDER BY id DESC LIMIT 1";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
    if($result = mysqli_fetch_array($busca)){
        $codigo = $result['id'] + 1;
    }

    return $codigo;
}

function historial_asistencia($id, $conexion){
    $listado = '';
    $sql = "SELECT time FROM attendance WHERE id_member = '$id' ORDER BY day DESC";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    while($row = mysqli_fetch_array($busca)){
        $dato = explode(" ", $row['time']);
        $dia = $dato[0];
        $hora = $dato[1];
        
        $listado.= '<tr>
                        <td>'.$dia.'</td>
                        <td>'.$hora.'</td>
                    </tr>
                    ';
    }
    return $listado;
}

function sexo_combo($sexo){
    $combo = '';
    $sexo = strtolower($sexo);
    switch ($sexo) {
        case 'hombre':
            $combo = '<option value="Hombre" selected>Hombre</option>
                    <option value="Mujer">Mujer</option>
                    <option value="Otro">Otro</option>';
            break;
        case 'mujer':
            $combo = '<option value="Hombre">Hombre</option>
                    <option value="Mujer" selected>Mujer</option>
                    <option value="Otro">Otro</option>';
            break;
        case 'otro':
            $combo = '<option value="Hombre" selected>Hombre</option>
                    <option value="Mujer">Mujer</option>
                    <option value="Otro" selected>Otro</option>';
            break;
        default:
            $combo = '<option value="Hombre" selected>Hombre</option>
                    <option value="Mujer">Mujer</option>
                    <option value="Otro">Otro</option>';
            break;
    }
    return $combo;
}

function adulto_ninio($edad){
    $combo = '';
    $edad = strtolower($edad);
    switch ($edad) {
        case 'adulto':
            $combo = '<option value="Adulto" selected>Adulto</option>
                    <option value="Niño">Niño</option>';
            break;
        case 'niño':
            $combo = '<option value="Adulto">Adulto</option>
                    <option value="Niño" selected>Niño</option>';
            break;
        default:
            $combo = '<option value="Adulto">Adulto</option>
                    <option value="Niño">Niño</option>';
            break;
    }
    return $combo;
}

function firmo($sign){
    $combo = '';
    $sign = strtolower($sign);
    switch ($sign) {
        case 'si':
            $combo = '<option value="Si" selected>Si</option>
                    <option value="No">No</option>';
            break;
        case 'no':
            $combo = '<option value="Si">Si</option>
                    <option value="No" selected>No</option>';
            break;
        default:
            $combo = '<option value="Si">Si</option>
                    <option value="No">No</option>';
            break;
    }
    return $combo;
}

function tipo($type){
    $combo = '';
    $type = strtolower($type);
    switch ($type) {
        case 'mensual':
            $combo = '<option value="mensual" selected>Mensual</option>
                    <option value="quincenal">Quincenal</option>
                    <option value="diario">Diario</option>';
            break;
        case 'quincenal':
            $combo = '<option value="mensual">Mensual</option>
                    <option value="mensual" selected>Quincenal</option>
                    <option value="diario">Diario</option>';
            break;
        case 'diario':
            $combo = '<option value="mensual">Mensual</option>
                    <option value="quincenal">Quincenal</option>
                    <option value="diario" selected>Diario</option>';
            break;
        default:
            $combo = '<option value="mensual">Mensual</option>
                    <option value="quincenal">Quincenal</option>
                    <option value="diario">Diario</option>';
            break;
    }
    return $combo;
}
function turno($hour){
    $combo = '';
    $hour = strtolower($hour);
    switch ($hour) {
        case 'mañana':
            $combo = '<option value="Mañana" selected>Mañana</option>
                    <option value="Tarde">Tarde</option>';
            break;
        case 'tarde':
            $combo = '<option value="Mañana">Mañana</option>
                    <option value="Tarde" selected>Tarde</option>';
            break;
        default:
            $combo = '<option value="Mañana">Mañana</option>
                    <option value="Tarde">Tarde</option>';
            break;
    }
    return $combo;
}
?>