<?php
/*
El archivo recibe mediante metodo POST el paquete o reservacion de hotel que quiere guardar en la wishlist

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

//Se verifica si se va añadir un paquete o una reserva de hotel
if(isset($_POST["paquete"])){
    //Obtener los datos del formulario
    $id_paquete = $_POST["paquete"];
    $sql = "INSERT INTO wishlist (paquete_id, hotel_id, fecha_inicio, fecha_termino, user_id) VALUES ($id_paquete, NULL, NULL, NULL, $idFinal)";

    if($mysqli->query($sql) === true) {
        echo "Datos insertados correctamente.";
    }else {
        echo "Error al insertar datos: ";
    }
}elseif(isset($_GET["valor"])){
    if($_SERVER["REQUEST_METHOD"] === "GET") {
        //Obtener los datos del formulario
        $id_hotel = $_GET["valor"];
        $fecha_inicio = $_GET["fecha_inicio"];
        $fecha_salida = $_GET["fecha_salida"];
        

        $sql = "INSERT INTO wishlist (paquete_id, hotel_id, fecha_inicio, fecha_termino, user_id) VALUES (NULL, '$id_hotel', '$fecha_inicio', '$fecha_salida', '$idFinal')";
        if ($mysqli->query($sql) === true) {
            echo "Datos insertados correctamente.";
        } else {
            echo "Error al insertar datos: ";
        }
    
    }else{
        echo "Error: sin datos";
    }
}elseif(isset($_POST["delete"])){
    $id_delete = $_POST["delete"];
    $sql = "DELETE FROM wishlist WHERE id = $id_delete";
    if ($mysqli->query($sql) === true) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error al insertar datos: ";
    }

}
//Redirije a Lista.php
header("Location: Lista.php");
?>