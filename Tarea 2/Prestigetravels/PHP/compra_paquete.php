<?php
/*
El archivo se encarga de agregar al carrito el numero de paquetes y el id de este 

*/

//Datos usuario
session_start();
$idFinal = $_SESSION['user_id'];
$CorreoFinal = $_SESSION['Correo1'];
$NombreFinal = $_SESSION["Nombre1"];
$CumpleanosFinal = $_SESSION["Cumpleanos1"];
$ContrasenaFinal = $_SESSION["Contrasena1"];

//Archivo que se conecta a la Base de Datos
require_once 'database.php';

//Extrae los datos recibidos
$cantidad = $_POST["cantidad"];
$id_paquete = $_POST["id_paquete"];

//Se realiza la consulta y se ejecutas
$sql = "INSERT INTO carrito (paquete_id, nro_paquetes, reserva_id, user_id) VALUES ($id_paquete, $cantidad , NULL, $idFinal)";
$result = mysqli_query($mysqli, $sql); // Ejecutar la consulta

if ($result) {
    header("Location: Paquetes.php");
} else {
    echo "Error al insertar la reserva: " . mysqli_error($mysqli);
    header("Location: Index.php");
}

?>