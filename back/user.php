<?php
@session_start();
include 'conexion.php';

if(isset($_POST['guardar'])){
    $name = mysqli_real_escape_string($conexion, $_POST["name"]);
    $surname = mysqli_real_escape_string($conexion, $_POST["surname"]);
    $email = mysqli_real_escape_string($conexion, $_POST["email"]);
    $tipo = mysqli_real_escape_string($conexion, $_POST["type"]);
    $pass = 0;


    // $pass = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(name, surname, email, role, password) VALUES ('$name', '$surname', '$email', '$tipo', '$pass')";
    $result = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
    if ($result) {
    $_SESSION["message"] = '<script>
                            swal("¡Buen trabajo!", "Usuario creado correctamente", "success");
                            </script>';
    header('Location: ../users.php');
    }else {
    $_SESSION["message"] = '<script>
                            swal("Error", "No se pudo crear el usuario", "error");
                            </script>';
    header('Location: ../users.php');
    }
}

if(isset($_POST['actualiza'])){
    $name = mysqli_real_escape_string($conexion, $_POST["name"]);
    $surname = mysqli_real_escape_string($conexion, $_POST["surname"]);
    $email = mysqli_real_escape_string($conexion, $_POST["email"]);
    $tipo = mysqli_real_escape_string($conexion, $_POST["type"]);
    $id =  mysqli_real_escape_string($conexion, $_POST["id_user"]);
    
    if($tipo == "administrador"){
        $tipo = "ROLE_ADMIN";
    }else {
        $tipo = "ROLE_USER";
    }

    // $pass = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET name='$name', surname='$surname', email='$email', role='$tipo' WHERE id = '$id' ";
    $result = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
    if ($result) {
        $_SESSION['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Datos actualizados correctamente
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
    header('Location: ../detalleUser.php?id='.$id);
    }else {
        $_SESSION['message'] = '<div class="alert alert-error alert-dismissible fade show" role="alert">
                                    Error al actualizar los datos
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
    header('Location: ../detalleUser.php?id='.$id);
    }
}

if(isset($_POST['actualizaUser'])){
    $name = mysqli_real_escape_string($conexion, $_POST["name"]);
    $surname = mysqli_real_escape_string($conexion, $_POST["surname"]);
    $email = mysqli_real_escape_string($conexion, $_POST["email"]);
    $id = $_SESSION['user'];


    // $pass = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET name='$name', surname='$surname', email='$email' WHERE id = '$id' ";
    $result = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
    if ($result) {
        $_SESSION['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Datos actualizados correctamente
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
    header('Location: ../editUser.php');
    }else {
        $_SESSION['message'] = '<div class="alert alert-error alert-dismissible fade show" role="alert">
                                    Error al actualizar los datos
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
    header('Location: ../editUser.php');
    }
}

if(isset($_POST['modifica'])){
    $current = mysqli_real_escape_string($conexion, $_POST["current"]);
    $new = mysqli_real_escape_string($conexion, $_POST["new"]);
    $new2 = mysqli_real_escape_string($conexion, $_POST["new2"]);
    $id = $_SESSION['user'];

    if($new != $new2){
        $_SESSION["message"] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Las nuevas contraseñas no coinciden
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
        header('Location: ../editUser.php');
    }

    $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conexion, $sql) or die("valid user error: ".mysqli_error($conexion));
    if ($row=mysqli_fetch_array($result) and password_verify($current, $row['password'])) {
        $pass = password_hash($new, PASSWORD_DEFAULT);
        $sql2 = "UPDATE users SET password='$pass' WHERE id = '$id' ";
        $result2 = mysqli_query($conexion, $sql2) or die(mysqli_error($conexion));
        if ($result2) {
            $_SESSION['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Contraseña actualizada correctamente
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
        header('Location: ../editUser.php');
        }else {
            $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Error al actualizar la contraseña
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
        header('Location: ../editUser.php');
        }
    }else {
      $_SESSION["message"] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Contraseña actual incorrecta
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
    header('Location: ../editUser.php');
    }

}

if(isset($_POST['reiniciar'])){
    $id = mysqli_real_escape_string($conexion, $_POST["id_user"]);

    $sql2 = "UPDATE users SET first_login =1 WHERE id = '$id' ";
    $result2 = mysqli_query($conexion, $sql2) or die(mysqli_error($conexion));
    if ($result2) {
        $_SESSION['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Contraseña reiniciada correctamente
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
        header('Location: ../detalleUser.php?id='.$id);
    }else {
        $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Error al reiniciar la contraseña
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
    header('Location: ../detalleUser.php?id='.$id);
    }
}

function user_list($conexion){
    $listado = '';
    $sql = "SELECT * FROM users";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));

    while($row = mysqli_fetch_array($busca)){
        $listado.= '<tr>
                    <td>'.$row['name'].' '.$row['surname'].'</td>
                    <td>'.user_type_name($row['role']).'</td>
                    <td>'.$row['email'].'</td>
                    <td><a href="detalleUser.php?id='.$row['id'].'"><i class="fas fa-fw fa-eye"></i></a></td>
                </tr>
                ';
    }
    return $listado;
}

function user_type_name($role){
    if($role == 'ROLE_ADMIN'){
        return "Administrador";
    }else{
        return "Operador";
    }
}

function datos_user($id, $conexion){
    $sql = "SELECT * FROM users WHERE id = '$id' ";
    $busca = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
    if($resultado = mysqli_fetch_array($busca)){
        return $resultado;
    }
}

function user_type($type){
    $combo = '';
    switch ($type) {
        case 'ROLE_USER':
            $combo = '<option value="operador" selected>Operador</option>
                    <option value="administrador">Administrador</option>';
            break;
        case 'ROLE_ADMIN':
            $combo = '<option value="operador">Operador</option>
                    <option value="administrador" selected>Administrador</option>';
            break;
        default:
            $combo = '<option value="operador" selected>Operador</option>
                    <option value="administrador">Administrador</option>';
            break;
    }
    return $combo;
}
 ?>
