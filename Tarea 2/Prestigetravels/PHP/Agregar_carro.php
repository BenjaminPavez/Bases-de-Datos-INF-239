<?php
//Datos usuario
session_start();


// Verificar si hay un usuario logueado
if (isset($_SESSION['Nombre1'])) {
	$pass = true;
    $idFinal = $_SESSION['user_id'];
	$CorreoFinal = $_SESSION['Correo1'];
	$NombreFinal = $_SESSION["Nombre1"];
	$CumpleanosFinal = $_SESSION["Cumpleanos1"];
	$ContrasenaFinal = $_SESSION["Contrasena1"];
} else {
    $pass = null;
}


require_once 'database.php';

if(!empty($_POST["hotel"])){
    $id_hotel = $_POST["hotel"];
    $id_paquete = NULL;
} else {
    $id_paquete = $_POST["paquete"];
    $id_hotel = NULL;
}


// Consulta SQL para insertar datos en la tabla "carrito"
$sql = "INSERT INTO carrito (paquete_id, reserva_id, user_id)
        VALUES ('$id_paquete', '$id_hotel', '$idFinal')";

if($mysqli->query($sql) === TRUE){
    echo "Datos agregados al carrito correctamente.";
    header("Location: Hoteles.php");
    exit; 
}else{
    echo "Error al agregar los datos: ";
    header("Location: Login.html");
    exit; 
}


?>
