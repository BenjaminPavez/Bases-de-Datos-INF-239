<?php
/*
El archivo realiza la busqueda de los paquete y hoteles

*/

//Se conecta a la base de datos
require_once 'database.php';


if(isset($_POST["todo"])){
    //Se recibe el formulario
    $destino = $_POST["destino"];
    $fecha_inicio = $_POST["fecha_1"];
    $fecha_termino = $_POST["fecha_2"];

    //Se arma la consulta para buscar paquetes y hoteles
    $sql = "SELECT id, nombre AS ciudad, fecha_inicio, fecha_termino, precio_persona AS precio, 'Paquete' AS tipo FROM paquete WHERE nombre IS NOT NULL";
    $sql .= (!empty($fecha_inicio)) ? " AND fecha_inicio >= '$fecha_inicio'" : "";
    $sql .= (!empty($fecha_termino)) ? " AND fecha_termino <= '$fecha_termino'" : "";
    $sql .= (!empty($destino)) ? " AND nombre LIKE '$destino%'" : "";
    $sql .= " UNION ";
    $sql .= "SELECT id, ciudad, fecha_inicio, fecha_termino, precio_noche AS precio, 'Hotel' AS tipo FROM hotel WHERE ciudad IS NOT NULL";
    $sql .= (!empty($fecha_inicio)) ? " AND fecha_inicio >= '$fecha_inicio'" : "";
    $sql .= (!empty($fecha_termino)) ? " AND fecha_termino <= '$fecha_termino'" : "";
    $sql .= (!empty($destino)) ? " AND ciudad LIKE '$destino%'" : "";

    //Se ejecuta la consulta
    $result = $mysqli->query($sql);

    //Se guarda la informacion en un array para que sea mas facil ver la informacion
    if ($result->num_rows > 0){
        $arrayt = array();
        while ($row = $result->fetch_assoc()) {
            $fecha_inicio = $row["fecha_inicio"];
            $fecha_termino = $row["fecha_termino"];

            $arrayf = array();
            $dato1 = $row["id"];
            $dato2 = $row["ciudad"];
            $dato3 = $row["precio"];
            $dato4 = $row["tipo"];
            array_push($arrayf, $dato1);
            array_push($arrayf, $dato2);
            array_push($arrayf, $dato3);
            array_push($arrayf, $dato4);
            array_push($arrayt, $arrayf);
        }
        include 'busqueda.php';
    } else {
        $arrayt = array();
        include 'busqueda.php';
    }

//HOTEL
}elseif(isset($_POST["hotel"])){
    //Formulario Hotel
    $destino = $_POST["destino"];
    $fecha_inicio = $_POST["fecha_1"];
    $fecha_termino = $_POST["fecha_2"];
    $val_hotel = $_POST["valoracion"];
    
    //Se arma la consulta para buscar hoteles
    $sql = "SELECT * FROM hotel WHERE 1 = 1";

    //Se verificar si se proporcionó la fecha de partida en el formulario
    if(!empty($fecha_inicio)) {
        $sql .= " AND fecha_inicio >= '$fecha_inicio'";
    }

    //Se verificar si se proporcionó la fecha de llegada en el formulario
    if(!empty($fecha_termino)) {
        $sql .= " AND fecha_termino <= '$fecha_termino'";
    }

    //Se verificar si se proporcionó el numero de estrellas en el formulario
    if(!empty($val_hotel)) {
        $sql .= " AND num_estrellas = '$val_hotel'";
    }

    //Se verificar si se proporcionó el destino en el formulario
    if(!empty($destino)) {
        $ciudad = $_POST["destino"];
        //Se gregar la condición de la ciudad a la consulta
        $sql .= " AND ciudad LIKE '$ciudad%'";
    }

    //Se ejecuta la consulta
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $arrayt = array();
        while ($row = $result->fetch_assoc()){
            $arrayf = array();
            $dato1 = $row["id"];
            $dato2 = $row["nombre"];
            $dato3 = $row["precio_noche"];
            $dato4 = "Hotel";
            $dato5 = $row["precio_noche"];
            array_push($arrayf, $dato1);
            array_push($arrayf, $dato2);
            array_push($arrayf, $dato3);
            array_push($arrayf, $dato4);
            array_push($arrayt, $arrayf);
        }
        include 'busqueda.php';
    } else {
        $arrayt = array();
        include 'busqueda.php';
    }

//PAQUETE
}elseif (isset($_POST["paquete"])){
    //Formulario Paquete
    $destino = $_POST["destino"];
    $fecha_inicio = $_POST["fecha_1"];
    $fecha_termino = $_POST["fecha_2"];
    $val_paquete = $_POST["valoracion"];

    //Se arma la consulta para buscar paquetes
    $sql = "SELECT * FROM paquete WHERE 1 = 1";

    //Se verificar si se proporcionó la fecha de partida en el formulario
    if(!empty($fecha_inicio)) {
        $sql .= " AND fecha_inicio >= '$fecha_inicio'";
    }

    //Se verificar si se proporcionó la fecha de llegada en el formulario
    if(!empty($fecha_termino)) {
        $sql .= " AND fecha_termino <= '$fecha_termino'";
    }

    //Se verificar si se proporcionó el numero de estrellas en el formulario
    if(!empty($val_paquete)) {
        $sql .= " AND num_estrellas = '$val_paquete'";
    }

    //Se verificar si se proporcionó el destino en el formulario
    if(!empty($destino)) {
        $ciudad = $_POST["destino"];
        //Se agregar la condición de la ciudad a la consulta
        $sql .= " AND nombre LIKE '$ciudad%'";
    }


    //Se ejecuta la consulta
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $arrayt = array();
        while ($row = $result->fetch_assoc()){
            $arrayf = array();
            $dato1 = $row["id"];
            $dato2 = $row["nombre"];
            $dato3 = $row["precio_persona"];
            $dato4 = "Paquete";
            array_push($arrayf, $dato1);
            array_push($arrayf, $dato2);
            array_push($arrayf, $dato3);
            array_push($arrayf, $dato4);
            array_push($arrayt, $arrayf);
        }
        include 'busqueda.php';
    } else {
        $arrayt = array();
        include 'busqueda.php';
    }

//CIUDAD
}elseif (isset($_POST["ciudad"])){
    //Formulario Ciudad
    $destino = $_POST["destino"];
    
 
    //Se arma la consulta para buscar ciuadades
    $sql = "SELECT id, nombre AS ciudad, fecha_inicio, fecha_termino, precio_persona AS precio, 'Paquete' AS tipo FROM paquete WHERE nombre LIKE '$destino%'";
    $sql .= " UNION ";
    $sql .= "SELECT id, ciudad, fecha_inicio, fecha_termino, precio_noche AS precio, 'Hotel' AS tipo FROM hotel WHERE ciudad LIKE '$destino%'";

    //Se ejecuta la consulta
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0){
        $arrayt = array();
        while ($row = $result->fetch_assoc()) {
            $fecha_inicio = $row["fecha_inicio"];
            $fecha_termino = $row["fecha_termino"];

            $arrayf = array();
            $dato1 = $row["id"];
            $dato2 = $row["ciudad"];
            $dato3 = $row["precio"];
            $dato4 = $row["tipo"];
            array_push($arrayf, $dato1);
            array_push($arrayf, $dato2);
            array_push($arrayf, $dato3);
            array_push($arrayf, $dato4);
            array_push($arrayt, $arrayf);
        }
        include 'busqueda.php';
    } else {
        $arrayt = array();
        include 'busqueda.php';
    }

}


?>