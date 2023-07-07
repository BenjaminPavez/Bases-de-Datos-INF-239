<?php
/*
El archivo se encarga de verificar los datos para iniciar sesion

*/

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        if ($_POST["password"] == $user["password_hash"]) {
            session_start();
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];

            //Variables Log In
            session_start();
            $_SESSION['Correo1'] = $user["email"];
            $_SESSION['Nombre1'] = $user["name"];
            $_SESSION['Cumpleanos1'] = $user["birthday"];
            $_SESSION['Contrasena1'] = $_POST["password"];
            header("Location: Perfil.php");
            exit;
        }else{
            header("Location: Login.html");
            exit; 
        }

    }else{
        header("Location: Login.html");
        exit; 
        
    }
    
    
}
