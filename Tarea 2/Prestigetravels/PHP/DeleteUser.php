<?php
/*
El archivo elimina al usuario logeado de la base de datos

*/

//Datos usuario
session_start();
$idFinal = $_SESSION['user_id'];

//Se conecta a la base de datos
$mysqli = require_once 'database.php';

//Llama al procedimiento almacenado
$sql = "CALL EliminarUsuario(?)";
        
$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("i", $idFinal);

if ($stmt->execute()) {
    echo "Usuario eliminado correctamente.";
    header("Location: Login.html");
    
} else {
    echo "Error al eliminar el usuario: " . $stmt->error;
    header("Location: Perfil.php");
}
