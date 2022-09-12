<?php
session_start();
$id = $_SESSION['id_cliente'];
include 'conexion.php';

$sql = "UPDATE members SET status = 0 WHERE id = '$id' ";
$query = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
if($query){
    $_SESSION['message'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Cliente borrado correctamente
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
    header('Location: ../index.php');
}
?>