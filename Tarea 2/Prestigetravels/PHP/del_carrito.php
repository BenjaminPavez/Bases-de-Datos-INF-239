<?php
/*
El archivo elimina algun producto del carrito

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

//Se obtiene el id del carrito para eliminar
$id_compra = $_POST["id_carrito"];

//Se elimina el articulo
$query = "DELETE FROM carrito WHERE id = $id_compra";
$result = mysqli_query($mysqli, $query); // Ejecutar la consulta

if ($result) {
    header("Location: Carrito.php");
} else {
    header("Location: Carrito.php");
}

?>