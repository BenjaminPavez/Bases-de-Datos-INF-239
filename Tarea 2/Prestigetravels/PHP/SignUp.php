<?php
/*
El archivo guarda en la base de datos los datos del usuario

*/

//Se verifica si esta el nombre
if (empty($_POST["name"])) {
    die("Name is required");
}

//Se verifica si esta el email
if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

//Se verifica si esta la fecha de cumpleaños
$date = $_POST['date'];

//Se verifica si esta la fecha de cumpleaños
if (strtotime($date) === false) {
    die("La fecha ingresada no es válida");
}

//Se verifica si esta la contraseña
if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

//Se verifica si esta la contraseña tiene alguna letra
if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

//Se verifica si esta la contraseña tiene algun numero
if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

//Se hace un insert con los datos
$mysqli = require __DIR__ . "/database.php";
$sql = "INSERT INTO user (email, name, birthday, password_hash)
        VALUES (?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if( ! $stmt->prepare($sql)) {
    die("SQL error : " . $mysqli->error);
}

$stmt->bind_param("ssss",
                  $_POST["email"],
                  $_POST["name"],
                  $date,
                  $_POST["password"]);
                  

if ($stmt->execute()) {
    header("Location: Login.html");
    exit;
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}