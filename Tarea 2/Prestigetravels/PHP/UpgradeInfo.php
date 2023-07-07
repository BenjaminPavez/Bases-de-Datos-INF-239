<?php
/*
El archivo verifica los campos que se cambiaron del usuario

*/

//Datos usuario
session_start();
$idFinal = $_SESSION['user_id'];

//Se verifica si se modifico el email
if(empty($_POST['email'])){
    $Correo = $_SESSION['Correo1'];
}else{
    $Correo = $_POST["email"];
}

//Se verifica si se modifico el nombre
if(empty($_POST['name'])){
    $Nombre = $_SESSION["Nombre1"];
}else{
    $Nombre = $_POST["name"];
}

//Se verifica si se modifico la fecha de cumpleaños
if(empty($_POST['date'])){
    $Cumpleanos = $_SESSION['Cumpleanos1'];
}else{
    $Cumpleanos = $_POST["date"];
}

//Se verifica si se modifico la contraseña
if(empty($_POST['password'])){
    $Contrasena = $_SESSION["Contrasena1"];
}else{
    $Contrasena = $_POST["password"];
}


//Se hace el update con los datos
$mysqli = require __DIR__ . "/database.php";
$sql = "UPDATE user SET email=?, name=?, birthday=?, password_hash=? WHERE id=?";
        
$stmt = $mysqli->stmt_init();

if(!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sssss",
                  $Correo,
                  $Nombre,
                  $Cumpleanos,
                  $Contrasena,
                  $idFinal);


//Se ejecuta la consulta
if($stmt->execute()){
    echo "Datos actualizados exitosamente.";
    header("Location: LogOut.php");
    exit;
    
}else{
    echo "Error al actualizar los datos: " . $stmt->error;
    header("Location: Perfil.php");
    exit;
}