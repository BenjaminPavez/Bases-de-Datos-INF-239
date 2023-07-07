<?php
/*
El archivo realiza una reserva de un hotel y lo guarda en la tabla reservas y en la tabla carrito
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

//Se reciben los datos del formulario
$id = $_GET["valor"];
$fecha_ini = $_GET["fecha_inicio"];
$fecha_ter = $_GET["fecha_salida"];

//Se arma la consulta para insertar en la tabla de reservas
$sql = "INSERT INTO reservas (hotel_id, user_id, fecha_inicio, fecha_termino) VALUES ($id, $idFinal, '$fecha_ini', '$fecha_ter')";

//Se ejecuta la consulta
$result = mysqli_query($mysqli, $sql);

//Verifica si se produjo algún error al ejecutar la consulta
if (!$result) {
    // Recupera el mensaje de error proporcionado por el trigger
    $error = mysqli_error($mysqli);
    if (strpos($error, 'Las fechas no están dentro del rango permitido del hotel') !== false) {
        // Las fechas están fuera del rango permitido del hotel
        header("Location: Hoteles.php");
        exit; // Detiene la ejecución del código
    } else {
        // Otro error al insertar la reserva
        echo "Error al insertar la reserva: " . $error;
        header("Location: Hoteles.php");
        exit;
    }
}

// Se guarda la información en el carrito
$reserva_id = mysqli_insert_id($mysqli);
$sql = "INSERT INTO carrito (paquete_id, reserva_id, user_id) VALUES (NULL, $reserva_id, $idFinal)";
$result2 = mysqli_query($mysqli, $sql);

if ($result2) {
    header("Location: Hoteles.php");
    exit;
} else {
    echo "Error al insertar en carrito: " . mysqli_error($mysqli);
    header("Location: Hoteles.php");
    exit;
}
?>
