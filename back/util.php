<?php
session_start();

function is_logued(){    
    if(!isset($_SESSION['user'])){
        header('Location: login.php');
    }
}

function is_admin(){
    if($_SESSION["type"] == 'ROLE_ADMIN'){
        return 1;
    }

}

function is_root(){
    if($_SESSION['type']=="ROLE_ADMIN"){
        return 1;
    }
}

function user_connected(){
  include_once 'conexion.php';
  $id = $_SESSION['user'];
  $nombre = 0;
  return $_SESSION['name'];
}

function id(){
    return $_SESSION['user'];   
}

function create_pass(){
    $key = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    return $key;
}

function mi_fecha($fecha){
    $fecha_hora = explode(' ', $fecha);
    $fecha_temp = explode('-', $fecha_hora[0]);
    return $fecha_temp[2].'/'.$fecha_temp[1].'/'.$fecha_temp[0];
}

function medio_name($id, $conexion){
    $name = "";
    $sql = "SELECT * FROM medios WHERE id = '$id'";
    $query = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
    if($row = mysqli_fetch_array($query)){
        $name = $row['nombre'].' - '.$row['numero'];
    }
    return $name;
}

function any_message(){
    if(isset($_SESSION['message']) and $_SESSION['message'] != ""){
        echo $_SESSION['message'];
        $_SESSION['message'] = "";
    }
}

?>