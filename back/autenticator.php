<?php

session_start();
include('conexion.php');

if(isset($_POST['enter'])){
  $user = mysqli_real_escape_string($conexion, $_POST["user"]);
  $pass = mysqli_real_escape_string($conexion, $_POST["pass"]);

  // $semilla = "!#$%&/()"; //uso como semilla para encriptar la clave
  // $user_pass = crypt($pass,$semilla);

  $sql = "SELECT * FROM users WHERE (name='$user' OR email='$user')";
  $result = mysqli_query($conexion, $sql) or die("select user error: ".mysqli_error($conexion));
  if ($row=mysqli_fetch_array($result) and $row['first_login']==1) {
    $_SESSION["user"] = $row["id"];
    header('Location: ../firstLogin.php');
  }else{
    $sql = "SELECT * FROM users WHERE (name='$user' OR email='$user')";
    $result = mysqli_query($conexion, $sql) or die("valid user error: ".mysqli_error($conexion));
    if ($row=mysqli_fetch_array($result) and password_verify($pass, $row['password'])) {
      $_SESSION["user"] = $row["id"];
      $_SESSION["name"] = $row["name"];
      $_SESSION["type"] = $row["role"];
      header('Location: ../index.php');
    }else {
      $_SESSION["message"] = '<div class="alert alert-danger" role="alert">
                                Usuario o contraseña inexistente.
                              </div>';
    header('Location: ../login.php');
    }
  }
  
}

?>
