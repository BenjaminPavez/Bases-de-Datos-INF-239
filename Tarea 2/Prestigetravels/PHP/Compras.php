<?php
/*
La plantilla muestra los paquetes o reserevas compradas

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

//Se realiza la consulta para ver todo los datos de los hoteles y los paquetes
$query = "SELECT c.id, c.reserva_id, c.paquete_id, c.user_id, 
          c.n_estrellas, c.opinion,
          p.nombre AS nombre_elemento,
          p.fecha_inicio AS fecha_inicio_elemento,
          p.fecha_termino AS fecha_termino_elemento,
          p.precio_persona AS precio_paquete, 
          r.fecha_inicio AS fecha_inicio_reserva, 
          r.fecha_termino AS fecha_termino_reserva, 
          h.nombre AS nombre_hotel, 
          h.precio_noche AS precio_hotel,
          c.id AS id_cali,
          c.n_estrellas AS cantidad_estrellas
          FROM calificaciones c
          LEFT JOIN paquete p ON c.paquete_id = p.id
          LEFT JOIN reservas r ON c.reserva_id = r.id
          LEFT JOIN hotel h ON r.hotel_id = h.id
          WHERE c.user_id = ?";
          
$stmt = mysqli_prepare($mysqli, $query);
mysqli_stmt_bind_param($stmt, "i", $idFinal);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, materialpro admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, materialpro admin lite design, materialpro admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Material Pro Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Mis Compras</title>
    <link rel="shortcut icon" href="../src/img/Prestigetravels_logo.png">
    <link rel="canonical" href="https://www.wrappixel.com/templates/materialpro-lite/" />
  
    <link rel="icon" type="image/png" sizes="16x16" href="src/img/favicon.png">

    <link href="../src/css/style.min.css" rel="stylesheet">



    <link rel="shortcut icon" href="favicon.ico">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../src/css/animate.css">
	<link rel="stylesheet" href="../src/css/icomoon.css">
	<link rel="stylesheet" href="../src/css/bootstrap.css">
	<link rel="stylesheet" href="../src/css/superfish.css">
	<link rel="stylesheet" href="../src/css/magnific-popup.css">
	<link rel="stylesheet" href="../src/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="../src/css/cs-select.css">
	<link rel="stylesheet" href="../src/css/cs-skin-border.css">
	<link rel="stylesheet" href="../src/css/style.css">
	<script src="../src/js/modernizr-2.6.2.min.js"></script>
    
</head>

<style>
    .ec-stars-wrapper {
	/* Espacio entre los inline-block (los hijos, los `a`) 
	   http://ksesocss.blogspot.com/2012/03/display-inline-block-y-sus-empeno-en.html */
	font-size: 0;
	/* Podríamos quitarlo, 
		pero de esta manera (siempre que no le demos padding), 
		sólo aplicará la regla .ec-stars-wrapper:hover a cuando
		también se esté haciendo hover a alguna estrella */
	display: inline-block;
    }
    .ec-stars-wrapper a {
        text-decoration: none;
        display: inline-block;
        /* Volver a dar tamaño al texto */
        font-size: 32px;
        font-size: 2rem;
        
        color: #888;
    }

    .ec-stars-wrapper:hover a {
        color: rgb(39, 130, 228);
    }
    /*
    * El selector de hijo, es necesario para aumentar la especifidad
    */
    .ec-stars-wrapper > a:hover ~ a {
        color: #888;
    }
</style>


<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <header id="fh5co-header-section" class="sticky-banner" style="background-color:#180148;">
			<div class="container">
				<div class="nav-header">
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
					<h1 id="fh5co-logo"><a href="index.php"><i class="icon-airplane"></i>Prestigetravels</a></h1>
					<!-- START #fh5co-menu-wrap -->
					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">
							<li class="active"><a href="index.php">Home</a></li>
							<li><a href="Hoteles.php">Hoteles</a></li>
							<li><a href="Paquetes.php">Paquetes</a></li>
							<li><a href="Lista.php">Wishlist</a></li>
							<li><a href="Carrito.php">Mi Carrito</a></li>
							<li><a href="Perfil.php"><?php echo $NombreFinal; ?></a></li>
						</ul>
					</nav>
				</div>
			</div>
		</header>
       
 
        <aside class="left-sidebar" data-sidebarbg="skin6" style="margin-top: 0;">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav" style="margin-top: 70px;">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="Perfil.php" aria-expanded="false">
                                <i class="mdi me-2 mdi-account-check"></i><span class="hide-menu">Perfil</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="Compras.php" aria-expanded="false"><i class="mdi me-2 mdi-table"></i><span
                                    class="hide-menu">Mis compras</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="Opiniones.php" aria-expanded="false"><i class="mdi me-2 mdi-table"></i><span
                                    class="hide-menu">Mis opiniones</span></a>
                        </li>
                    </ul>
                </nav>
            </div>
      
            <div class="sidebar-footer">
                <div class="row">
                    <div class="col-4 link-wrap">
                        <!-- item-->
                        <a href="DeleteUser.php" class="link" data-toggle="tooltip" title="" data-original-title="Settings">
                            <img src="../src/img/delete_user.png" width="14" height="15"></a>
                    </div>
                    <div class="col-4 link-wrap">
                        <!-- item-->
                        <a href="LogOut.php" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i
                                class="mdi mdi-power"></i></a>
                    </div>
                </div>
            </div>
        </aside>
        
        <div class="page-wrapper">
           
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Mis Compras</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="Perfil.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Mis Compras</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Compras</h4>
                                <div class="table-responsive">
                                <table class="table user-table">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Nro</th>
                                            <th class="border-top-0">Paquete/Reserva</th>
                                            <th class="border-top-0">Fecha Inicio</th>
                                            <th class="border-top-0">Fecha Termino</th>
                                            <th class="border-top-0" style="text-align: center;">Valoración</th>
                                            <th class="border-top-0">Reseña</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $contador = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $cantidad_estrellas = $row['cantidad_estrellas'];
                                        $nombre_elemento = $row['nombre_elemento'];
                                        if (!empty($nombre_elemento)) {
                                            $tipo = "Paquete";
                                            $fecha_inicio_elemento = $row['fecha_inicio_elemento'];
                                            $fecha_termino_elemento = $row['fecha_termino_elemento'];
                                            ?>
                                            <tr>
                                                <td><?php echo $contador; ?></td>
                                                <td><?php echo $tipo; ?> <?php echo $nombre_elemento; ?></td>
                                                <td><?php echo $fecha_inicio_elemento; ?></td>
                                                <td><?php echo $fecha_termino_elemento; ?></td>
                                                <td>
                                                    <form method="post" action="val.php">
                                                        <div style="display: flex; align-items: center; justify-content: center;">
                                                            <span>Calidad de los hoteles:</span>
                                                            <select name="calihoteles" id="categoria-<?php echo $row['id_cali']; ?>">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>
                                                        <div style="display: flex; align-items: center; justify-content: center;">
                                                            <span>Transporte:</span>
                                                            <select name="transporte" id="categoria-<?php echo $row['id_cali']; ?>">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>
                                                        <div style="display: flex; align-items: center; justify-content: center;">
                                                            <span>Servicio:</span>
                                                            <select name="servicios" id="categoria-<?php echo $row['id_cali']; ?>">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>
                                                        <div style="display: flex; align-items: center; justify-content: center;">
                                                            <span>Precio-calidad:</span>
                                                            <select name="precio-calidad" id="categoria-<?php echo $row['id_cali']; ?>">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>
                                                        <input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
                                                        <input type="hidden" name="id_cali" value="<?php echo $row['id_cali']; ?>">
                                                        <p class="text-center"><button type="submit" style="padding: 5px 10px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; margin-left: auto; margin-right: auto;">Guardar</button></p>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form method="post" action="opinion.php">
                                                        <div>
                                                            <textarea id="prompt-textarea" tabindex="0" data-id="request-:r3u:-18" rows="1" placeholder="Escribe tu Reseña" class="m-0 w-full resize-none border-0 bg-transparent p-0 focus:ring-0 focus-visible:ring-0 dark:bg-transparent" spellcheck="false" data-ms-editor="true" name="resena"></textarea>
                                                            <input type="hidden" name="tipo" value="Resena">
                                                            <input type="hidden" name="id_cali" value="<?php echo $row['id_cali']; ?>">
                                                            <p class="text-center"><button type="submit" style="padding: 5px 10px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; margin-left: auto; margin-right: auto;">Guardar</button></p></button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php 
                                        }else{
                                            $tipo = "Hotel";
                                            $nombre_elemento = $row['nombre_hotel'];
                                            $fecha_inicio_elemento = $row['fecha_inicio_reserva'];
                                            $fecha_termino_elemento = $row['fecha_termino_reserva'];
                                            ?>
                                            <tr>
                                                <td><?php echo $contador; ?></td>
                                                <td><?php echo $tipo; ?> <?php echo $nombre_elemento; ?></td>
                                                <td><?php echo $fecha_inicio_elemento; ?></td>
                                                <td><?php echo $fecha_termino_elemento; ?></td>
                                                <td>
                                                    <form method="post" action="val.php">
                                                        <div style="display: flex; align-items: center; justify-content: center;">
                                                            <span>Limpieza:</span>
                                                            <select name="limpieza" id="categoria-<?php echo $row['id_cali']; ?>">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>
                                                        <div style="display: flex; align-items: center; justify-content: center;">
                                                            <span>Servicio:</span>
                                                            <select name="servicio" id="categoria-<?php echo $row['id_cali']; ?>">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>
                                                        <div style="display: flex; align-items: center; justify-content: center;">
                                                            <span>Decoración:</span>
                                                            <select name="decoracion" id="categoria-<?php echo $row['id_cali']; ?>">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>
                                                        <div style="display: flex; align-items: center; justify-content: center;">
                                                            <span>Comodidad de las camas:</span>
                                                            <select name="camas" id="categoria-<?php echo $row['id_cali']; ?>">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>
                                                        <input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
                                                        <input type="hidden" name="id_cali" value="<?php echo $row['id_cali']; ?>">
                                                        <p class="text-center"><button type="submit" style="padding: 5px 10px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; margin-left: auto; margin-right: auto;">Guardar</button></p>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form method="post" action="opinion.php">
                                                        <div>
                                                            <textarea id="prompt-textarea" tabindex="0" data-id="request-:r3u:-18" rows="1" placeholder="Escribe tu Reseña" class="m-0 w-full resize-none border-0 bg-transparent p-0 focus:ring-0 focus-visible:ring-0 dark:bg-transparent" spellcheck="false" data-ms-editor="true" name="resena"></textarea>
                                                            <input type="hidden" name="tipo" value="Resena">
                                                            <input type="hidden" name="id_cali" value="<?php echo $row['id_cali']; ?>">
                                                            <p class="text-center"><button type="submit" style="padding: 5px 10px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; margin-left: auto; margin-right: auto;">Guardar</button></p></button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php }
                                        $contador += 1;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer"> © 2021 Material Pro Admin by <a href="https://www.wrappixel.com/">wrappixel.com </a>
            </footer>
        </div>
    </div>
    <script src="../src/plugins/jquery/dist/jquery.min.js"></script>
    <script src="../src/plugins//bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../src/js/app-style-switcher.js"></script>
    <script src="../src/js/waves.js"></script>
    <script src="../src/js/sidebarmenu.js"></script>
    <script src="../src/js/custom.js"></script>
</body>

</html>