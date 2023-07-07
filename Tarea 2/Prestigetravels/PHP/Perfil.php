<?php
/*
La plantilla muestra la informacion del usuario logeado

*/

//Datos usuario
session_start();
$idFinal = $_SESSION['user_id'];
$CorreoFinal = $_SESSION['Correo1'];
$NombreFinal = $_SESSION["Nombre1"];
$CumpleanosFinal = $_SESSION["Cumpleanos1"];
$ContrasenaFinal = $_SESSION["Contrasena1"];


?>

<!DOCTYPE html>
<html  lang="es">

<head>
    <meta charset="utf-8">
    <title>Mi Perfil</title>
    <link rel="shortcut icon" href="../src/img/Prestigetravels_logo.png">
    
    <link rel="canonical" href="https://www.wrappixel.com/templates/materialpro-lite/" />
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <link href="../src/css/style.min_prof.css" rel="stylesheet">

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
                        <h3 class="page-title mb-0 p-0">Perfil</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="Perfil.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                    </div>
                </div>
            </div>
           
            <div class="container-fluid">
            
                <div class="row">
                  
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body profile-card">
                                <center class="mt-4"> <img src="../src/img/users/fotouser.png"
                                        class="rounded-circle" width="150" />
                                    <h4 class="card-title mt-2"><?php echo $NombreFinal; ?></h4>
                                    <div class="row text-center justify-content-center">
                                        
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <!-- Formulario -->
                                <form action="UpgradeInfo.php" method="post" class="form-horizontal form-material mx-2">
                                    <div class="form-group">
                                        <label class="col-md-12 mb-0">Nombre</label>
                                        <div class="col-md-12">
                                            <input type="text" id="FullName3" name="name" class="form-control ps-0 form-control-line" placeholder="<?php echo $NombreFinal; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Correo</label>
                                        <div class="col-md-12">
                                            <input type="email" id="Email3" name="email"  class="form-control ps-0 form-control-line"placeholder="<?php echo $CorreoFinal; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 mb-0">Contraseña</label>
                                        <div class="col-md-12">
                                            <input type="password" id="Password3" name="password" maxlength="8" class="form-control ps-0 form-control-line"placeholder="<?php echo $ContrasenaFinal; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 mb-0">Fecha de Nacimiento</label>
                                        <div class="col-md-12">
                                            <input type="date" id="fecha" name="date"  class="form-control ps-0 form-control-line" placeholder="<?php echo $CumpleanosFinal; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12 d-flex">
                                            <button class="btn btn-success mx-auto mx-md-0 text-white">Actualizar
                                                Perfil</button>
                                        </div>
                                    </div>
                                </form>
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
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../src/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../src/js/app-style-switcher_prof.js"></script>
    <!--Wave Effects -->
    <script src="../src/js/waves_prof.js"></script>
    <!--Menu sidebar -->
    <script src="../src/js/sidebarmenu_prof.js"></script>
    <!--Custom JavaScript -->
    <script src="../src/js/custom_prof.js"></script>
</body>

</html>