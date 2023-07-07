<?php
/*
El archivo recibe mediante metodo POST la calificacion, luego se le calcular el promedio y se guarda en calificacion y se modifica en el paquete u el hotel

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

//Clasifica si es un Hotel o un Paquete
$tipo =  $_POST['tipo'];

if($tipo == "Paquete"){
    //Extrae los datos recibidos
    $id =  $_POST['id_cali'];
    $calihoteles =  $_POST['calihoteles'];
    $transporte =  $_POST['transporte'];
    $servicios =  $_POST['servicios'];
    $preciocalidad =  $_POST['precio-calidad'];
    $calificacion =  round(($calihoteles+$transporte+$servicios+$preciocalidad) / 4, 1);
    
    $sql = "UPDATE calificaciones SET n_estrellas = '$calificacion' WHERE id = '$id'";
    $result = mysqli_query($mysqli, $sql);
    $sql2 = "UPDATE paquete SET num_estrellas = (num_estrellas + '$calificacion') / 2 WHERE id = '$id'";
    $result2 = mysqli_query($mysqli, $sql2);

    //Redirije a Compras.php
    header("Location: Compras.php");

}elseif($tipo == "Hotel"){
    //Extrae los datos recibidos
    $id =  $_POST['id_cali'];
    $limpieza = $_POST['limpieza'];
    $servicio =  $_POST['servicio'];
    $decoracion =  $_POST['decoracion'];
    $camas =  $_POST['camas'];
    $calificacion = round(($limpieza + $servicio + $decoracion + $camas) / 4, 1);

    $sql = "UPDATE calificaciones SET n_estrellas = '$calificacion' WHERE id = '$id'";
    $result = mysqli_query($mysqli, $sql);
    $sql2 = "UPDATE hotel SET num_estrellas = (num_estrellas + '$calificacion') / 2 WHERE id = '$id'";
    $result2 = mysqli_query($mysqli, $sql2);

    //Redirije a Compras.php
    header("Location: Compras.php");

}

?>
