<?php
/*
El archivo se encarga de una vez comprado el articulo, lo guarda en la tabla calificacion con calificacion 0 y opinion nula, para que despues la rellene

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

//Flag que verifica si hay o no hay calificacion
$flag = $_POST['flag'];

//Se realiza la consulta y se extrae la informacion de esta
if($flag == 1){
    //Se realiza la consulta para obtener la informacion del paquete y/o hotel para mostrarlo al usuario que lo compro  y para que realiza la calificacion
    $query = "SELECT c.id, c.paquete_id, c.reserva_id, c.user_id, 
          c.nro_paquetes,
          p.nombre AS nombre_paquete, 
          p.fecha_inicio AS fecha_inicio_paquete, 
          p.fecha_termino AS fecha_termino_paquete, 
          p.precio_persona AS precio_paquete, 
          r.fecha_inicio AS fecha_inicio_reserva, 
          r.fecha_termino AS fecha_termino_reserva, 
          h.nombre AS nombre_hotel, 
          h.precio_noche AS precio_hotel,
          h.id AS id_hotel
          FROM carrito c
          LEFT JOIN paquete p ON c.paquete_id = p.id
          LEFT JOIN reservas r ON c.reserva_id = r.id
          LEFT JOIN hotel h ON r.hotel_id = h.id
          WHERE c.user_id = $idFinal";

    //Se ejecuta la consultas
    $result = mysqli_query($mysqli, $query);

    //Se extrae y clasifican los datos
    if ($result) {
        $cuenta = array();
        $num = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $paquete_id = $row['paquete_id'];
            $reserva_id = $row['reserva_id'];
            $user_id = $row['user_id'];
            $nro_paquetes = $row['nro_paquetes'];
            $id_hotel = $row['id_hotel'];
            // Verificar si es un paquete o una reserva
            if (!is_null($paquete_id)) {
                $sql2 = "UPDATE paquete SET disponibles = disponibles - ? WHERE id = ?";
                $stmt = mysqli_prepare($mysqli, $sql2);
                mysqli_stmt_bind_param($stmt, "ii", $nro_paquetes, $paquete_id);
                $result2 = mysqli_stmt_execute($stmt);
                $sql = "INSERT INTO calificaciones (reserva_id, paquete_id, user_id, n_estrellas, opinion) VALUES (NULL, $paquete_id, $idFinal, 0, NULL)";
                $result2 = mysqli_query($mysqli, $sql); // Ejecutar la segunda consulta
            } elseif (!is_null($reserva_id)) {
                $sql2 = "UPDATE hotel SET disponibles = disponibles - ? WHERE id = ?";
                $cant = 1;
                $stmt = mysqli_prepare($mysqli, $sql2);
                mysqli_stmt_bind_param($stmt, "ii", $cant, $id_hotel);
                $result2 = mysqli_stmt_execute($stmt);
                $sql = "INSERT INTO calificaciones (reserva_id, paquete_id, user_id, n_estrellas, opinion) VALUES ($reserva_id, NULL, $idFinal, 0, NULL)";
                $result2 = mysqli_query($mysqli, $sql); // Ejecutar la segunda consulta
            }

        }
        header("Location: Compras.php");
    } else {
        echo "Error en la consulta: " . mysqli_error($mysqli);
        header("Location: Index.php");
    }

}


?>