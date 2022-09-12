<?php
include('conexion.php');

if(isset($_POST["id"])){
  $id = mysqli_real_escape_string($conexion, $_POST["id"]);
  $day = date('Y-m-d');

  $query = "SELECT day FROM attendance WHERE id_member = '$id' AND day = '$day' ";
  $search = mysqli_query($conexion, $query) or die(mysqli_error($conexion));
  if($row = mysqli_fetch_array($search)){
      echo "Ya asistió";
  }else{
    $sql = "INSERT INTO attendance(id_member, day) VALUES('$id', '$day')";
    $result = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
    if ($result) {
      echo my_date($day);
    } else {
      echo "error";
    }

  }
}
function my_date($fecha){
    $fecha_hora = explode(' ', $fecha);
    $fecha_temp = explode('-', $fecha_hora[0]);
    return $fecha_temp[2].'/'.$fecha_temp[1].'/'.$fecha_temp[0];
}
?>