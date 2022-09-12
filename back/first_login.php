<?php

session_start();
include('conexion.php');

if(isset($_POST['enter'])){
  $pass1 = mysqli_real_escape_string($conexion, $_POST["pass1"]);
  $pass2 = mysqli_real_escape_string($conexion, $_POST["pass2"]);
  $id = $_SESSION["user"];

  if ($pass1 != $pass2){
    $_SESSION["message"] = '<div class="alert alert-danger" role="alert">
                              Las contraseñas no coinciden.
                            </div>';
   header('Location: ../firstLogin.php');
  }else{
    $pass = password_hash($pass1, PASSWORD_DEFAULT);
    $query = "UPDATE users SET password = '$pass', first_login=0 WHERE id = $id ";
    $resultado = mysqli_query($conexion, $query) or die(mysqli_error($conexion));
    if($resultado){
      $sql = "SELECT * FROM users WHERE id = '$id' ";
      $result = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
      if ($row=mysqli_fetch_array($result)) {
        $_SESSION["user"] = $row["id"];
        $_SESSION["name"] = $row["name"];
        $_SESSION["type"] = $row["tipo"];
        header('Location: ../index.php');
      }
    }
  }

}

?>
