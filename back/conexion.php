<?php
$HOST = "localhost";
$USER = "root";
$PASS = "12345678";
$DB = "octopus";

// $HOST = 'localhost';
// $USER = 'c2430941_ventas';
// $PASS = 'fufe60woZI';
// $DB = 'c2430941_ventas';

function conectar(){
	global $HOST, $USER, $PASS, $DB;
	$cnx = mysqli_connect($HOST, $USER, $PASS, $DB);
	if (mysqli_connect_errno()) {
		echo "Conexión fallida: ".mysqli_connect_error();
		exit();
	}

	return $cnx;
}

$conexion = conectar();

?>
