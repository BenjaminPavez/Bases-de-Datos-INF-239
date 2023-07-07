<?php
/*
El archivo recibe mediante metodo POST la opinion y los datos de lo que hizo opinion

*/

//Datos usuario
session_start();
$idFinal = $_SESSION['user_id'];
$CorreoFinal = $_SESSION['Correo1'];
$NombreFinal = $_SESSION["Nombre1"];
$CumpleanosFinal = $_SESSION["Cumpleanos1"];
$ContrasenaFinal = $_SESSION["Contrasena1"];

//Se conecta a la base de datos
require_once 'database.php';

//Recibe el tipo (paquete u hotel), el id y la opinion
$tipo =  $_POST['tipo'];
$id = $_POST['id_cali'];
$opi = $_POST['resena'];
echo $opi;


//Se actualizan los datos de la opinion en calificaciones
$sql = "UPDATE calificaciones SET opinion = '$opi' WHERE id = '$id'";
$result = mysqli_query($mysqli, $sql);
header("Location: Compras.php");


?>