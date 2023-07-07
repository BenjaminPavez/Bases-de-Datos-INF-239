<?php
/*
La plantilla muestra lo que esta guardado en la wishlist

*/

//Datos usuario
session_start();

//Se verificar si hay un usuario logueado o no
if (isset($_SESSION['Nombre1'])) {
	$pass = true;
    $idFinal = $_SESSION['user_id'];
	$CorreoFinal = $_SESSION['Correo1'];
	$NombreFinal = $_SESSION["Nombre1"];
	$CumpleanosFinal = $_SESSION["Cumpleanos1"];
	$ContrasenaFinal = $_SESSION["Contrasena1"];
} else {
    $pass = null;
}

//Se conecta a la base de datos
require_once 'database.php';

//Realiza la consulta para obtener toda la informacion de la reserva del hotel y del paquete
$sql = "SELECT w.id,
		w.fecha_inicio AS fecha_ire,
		w.fecha_termino AS fecha_tre,
		p.nombre AS nombre_paquete, 
		p.num_estrellas AS estrellas_paquete, 
		h.nombre AS nombre_hotel, 
		h.num_estrellas AS estrellas_hotel, 
		u.name AS nombre_usuario
        FROM wishlist w
        LEFT JOIN paquete p ON w.paquete_id = p.id
        LEFT JOIN hotel h ON w.hotel_id = h.id
        LEFT JOIN user u ON w.user_id = u.id
        WHERE u.id = '$idFinal'";

//Se ejecuta la consulta
$result = $mysqli->query($sql);

//Se almacena la informacion para mostrarla en la pagina
if ($result->num_rows > 0) {
    $arrayt = array();
    while ($row = $result->fetch_assoc()){
        $id = $row["id"];
        $nombrePaquete = $row["nombre_paquete"];
        $estrellasPaquete = $row["estrellas_paquete"];
        $nombreHotel = $row["nombre_hotel"];
        $estrellasHotel = $row["estrellas_hotel"];
        $nombreUsuario = $row["nombre_usuario"];
		$fecha_reservaini = $row["fecha_ire"];
		$fecha_reservaterm = $row["fecha_tre"];

        //Verifica si es un paquete
        if(!empty($nombrePaquete)){
            $arrayf = array();
            $dato1 = $row["id"];
            $dato2 = $nombrePaquete;
            $dato3 = $estrellasPaquete;
            $dato4 = "Paquete";
            $sql2 = "SELECT paquete_id FROM wishlist WHERE id = '$dato1'";
            $resultado = $mysqli->query($sql2);
			$row = $resultado->fetch_assoc();
			$dato5 = $row["paquete_id"];
			array_push($arrayf, $id);
            array_push($arrayf, $dato1);
            array_push($arrayf, $dato2);
            array_push($arrayf, $dato3);
            array_push($arrayf, $dato4);
            array_push($arrayf, $dato5);
			array_push($arrayf, $dato4);
			array_push($arrayf, $dato4);
            array_push($arrayt, $arrayf);


		//Verifica si es un hotel
        }elseif(!empty($nombreHotel)){
            $arrayf = array();
            $dato1 = $row["id"];
            $dato2 = $nombreHotel;
            $dato3 = $estrellasHotel;
            $dato4 = "Hotel";
            $sql3 = "SELECT hotel_id FROM wishlist WHERE id = '$dato1'";
            $resultado = $mysqli->query($sql3);
			$row = $resultado->fetch_assoc();
			$dato5 = $row["hotel_id"];
			array_push($arrayf, $id);
            array_push($arrayf, $dato1);
            array_push($arrayf, $dato2);
            array_push($arrayf, $dato3);
            array_push($arrayf, $dato4);
            array_push($arrayf, $dato5);
			array_push($arrayf, $fecha_reservaini);
			array_push($arrayf, $fecha_reservaterm);
            array_push($arrayt, $arrayf);
        }
    }
}else{
    $arrayt = array();
}


?>

<!DOCTYPE html>
<!--[if gt IE 8]><!--> <html class="no-js">
	<head>
	<meta charset="utf-8">
	<title>Wishlist</title>
	<link rel="shortcut icon" href="../src/img/Prestigetravels_logo.png">
	
	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="../src/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="../src/css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="../src/css/bootstrap.css">
	<!-- Superfish -->
	<link rel="stylesheet" href="../src/css/superfish.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="../src/css/magnific-popup.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="../src/css/bootstrap-datepicker.min.css">
	<!-- CS Select -->
	<link rel="stylesheet" href="../src/css/cs-select.css">
	<link rel="stylesheet" href="../src/css/cs-skin-border.css">
	
	<link rel="stylesheet" href="../src/css/style.css">


	<!-- Modernizr JS -->
	<script src="../js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		<div id="fh5co-wrapper">
		<div id="fh5co-page">

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
							<?php if ($pass): ?>
								<li><a href="Perfil.php"><?php echo $NombreFinal; ?></a></li>
							<?php else: ?>
								<li><a href="Login.html">Log in / Sign up</a></li>
							<?php endif; ?>
							
						</ul>
					</nav>
				</div>
			</div>
		</header>

		<!-- end:header-top -->
	
		<div class="fh5co-hero">
			<div class="fh5co-overlay"></div>
			<div class="fh5co-cover" data-stellar-background-ratio="0.5" style="background-image: url(images/cover_bg_1.jpg);">
				<div class="desc">
					<div class="container">
						<div class="row">
							<div class="col-sm-5 col-md-5">
								<!-- <a href="index.html" id="main-logo">Travel</a> -->
								<div class="tabulation animate-box">

								  <!-- Nav tabs -->
								   <ul class="nav nav-tabs" role="tablist">
								      <li role="presentation" class="active">
								      	<a href="#todo" aria-controls="todo" role="tab" data-toggle="tab">Todos</a>
								      </li>
								      <li role="presentation">
								    	   <a href="#hotel" aria-controls="hotels" role="tab" data-toggle="tab">Hoteles</a>
								      </li>
								      <li role="presentation">
								    	   <a href="#paquete" aria-controls="packages" role="tab" data-toggle="tab">Paquetes</a>
								      </li>
									  <li role="presentation">
								    	   <a href="#ciudad" aria-controls="packages" role="tab" data-toggle="tab">Ciudades</a>
								      </li>
								   </ul>

								   <!-- Tab panes -->
								   
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane active" id="todo">
											<form action="search.php" method="post">
												<div class="row">
													<div class="col-xxs-12 col-xs-12 mt">
														<div class="input-field">
															<label for="from">Ciudad:</label>
															<input type="text" class="form-control" id="from-place" name="destino" placeholder="Madrid"/>
														</div>
													</div>
													<div class="col-xxs-12 col-xs-6 mt">
														<div class="input-field">
															<label for="date-start">Check In:</label>
															<input type="date" class="form-control" name="fecha_1" id="fecha">
														</div>
													</div>
													<div class="col-xxs-12 col-xs-6 mt">
														<div class="input-field">
															<label for="date-end">Check Out:</label>
															<input type="date" class="form-control" name="fecha_2" id="fecha">
														</div>
													</div>
													<div class="col-xs-12">
														<input type="hidden" name="todo" value="">
														<button type="submit" class="btn btn-primary btn-block">Buscar Todos</button>
													</div>
												</div>
											</form>
										</div>

										<div role="tabpanel" class="tab-pane" id="hotel">
											<form action="search.php" method="post">
												<div class="row">
													<div class="col-xxs-12 col-xs-12 mt">
														<div class="input-field">
															<label for="from">Ciudad:</label>
															<input type="text" class="form-control" id="from-place" name="destino" placeholder="Madrid"/>
														</div>
													</div>
													<div class="col-xxs-12 col-xs-6 mt">
														<div class="input-field">
															<label for="date-start">Desde:</label>
															<input type="date" class="form-control" name="fecha_1" id="fecha">
														</div>
													</div>
													<div class="col-xxs-12 col-xs-6 mt">
														<div class="input-field">
															<label for="date-end">Hasta:</label>
															<input type="date" class="form-control" name="fecha_2" id="fecha">
														</div>
													</div>
													<div class="col-sm-12 mt">
														<section>
															<label for="class">Numero de Estrellas:</label>
															<select class="cs-select cs-skin-border" name="valoracion">
															<option value="" disabled selected>1</option>
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
															</select>
														</section>
													</div>
													<div class="col-xs-12">
														<input type="hidden" name="hotel" value="">
														<button type="submit" class="btn btn-primary btn-block">Buscar Hoteles</button>
													</div>
												</div>
											</form>
										</div>

										<div role="tabpanel" class="tab-pane" id="paquete">
											<form action="search.php" method="post">
												<div class="row">
													<div class="col-xxs-12 col-xs-12 mt">
														<div class="input-field">
															<label for="from">Ciudad:</label>
															<input type="text" class="form-control" id="from-place" name="destino" placeholder="Madrid"/>
														</div>
													</div>
													<div class="col-xxs-12 col-xs-6 mt">
														<div class="input-field">
															<label for="date-start">Desde:</label>
															<input type="date" class="form-control" name="fecha_1" id="fecha">
														</div>
													</div>
													<div class="col-xxs-12 col-xs-6 mt">
														<div class="input-field">
															<label for="date-end">Hasta:</label>
															<input type="date" class="form-control" name="fecha_2" id="fecha">
														</div>
													</div>
													<div class="col-sm-12 mt">
														<section>
															<label for="class">Numero de Estrellas:</label>
															<select class="cs-select cs-skin-border" name="valoracion">
															<option value="" disabled selected>1</option>
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
															</select>
														</section>
													</div>
													<div class="col-xs-12">
														<input type="hidden" name="paquete" value="">
														<button type="submit" class="btn btn-primary btn-block">Buscar Paquetes</button>
													</div>
												</div>
											</form>
										</div>

										<div role="tabpanel" class="tab-pane" id="ciudad">
											<form action="search.php" method="post">
												<div class="row">
													<div class="col-xxs-12 col-xs-12 mt">
														<div class="input-field">
															<label for="from">Ciudad:</label>
															<input type="text" class="form-control" id="from-place" name="destino" placeholder="Madrid"/>
														</div>
													</div>
													<div class="col-xs-12">
														<input type="hidden" name="ciudad" value="">
														<button type="submit" class="btn btn-primary btn-block">Buscar Ciudad</button>
													</div>
												</div>
											</form>
										</div>
										</div>
								</div>
							</div>
							<div class="desc2 animate-box">
								<div class="col-sm-7 col-sm-push-1 col-md-7 col-md-push-1">
									<h2>Exclusivo por tiempo limitado</h2>
									<h3>Vuela a Hong Kong via Santiago de Chile</h3>
									<span class="CLP">CLP 750.000</span>
									<!-- <p><a class="btn btn-primary btn-lg" href="#">Get Started</a></p> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		

		<div id="fh5co-blog-section" class="fh5co-section-gray">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h3>Wishlist</h3>
						<p>Agrega tus paquetes y hoteles favoritos a tu wishlist personalizada. Esta lista de deseos te ayudará a visualizar tus metas de viaje y mantener un registro de los lugares que te encantaría visitar.</p>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row row-bottom-padded-md">
				<?php
				// Acceder a los datos recibidos
				foreach ($arrayt as $arrayf) {
					$id_wishlist = $arrayf[0];
					$dato1 = $arrayf[1];
					$dato2 = $arrayf[2];
					$dato3 = $arrayf[3];
					$dato4 = $arrayf[4];
					$dato5 = $arrayf[5];
					$dato6 = $arrayf[6];
					$dato7 = $arrayf[7];
					if($dato4 == "Paquete"){
						?>
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="fh5co-blog animate-box">
								<a href="#"><img class="img-responsive" src="../src/img/<?php echo $dato4; ?><?php echo $dato5; ?>.jpg" alt=""></a>
								<div class="blog-text">
									<div class="prod-title">
										<h3><a href="#"><?php echo $dato2; ?> | <?php echo $dato4; ?></a></h3>
										<span class="posted_by">Valoracion: <?php echo $dato3; ?> / 5</span>
										<div class="text-center">
											<form action="PaginaPaquete.php" method="post" style="display: inline-block;">
												<input type="hidden" name="valor" value="<?php echo $dato5; ?>">
												<button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px;">Reservar</button>
											</form>
											<form action="wishlist.php" method="post" style="display: inline-block;">
												<input type="hidden" name="delete" value="<?php echo $id; ?>">
												<button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px;">Quitar</button>
											</form>
										</div>
									</div>
								</div> 
							</div>
						</div>
						<?php
					}elseif($dato4 == "Hotel"){
						?>
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="fh5co-blog animate-box">
								<a href="#"><img class="img-responsive" src="../src/img/<?php echo $dato4; ?><?php echo $dato5; ?>.jpg" alt=""></a>
								<div class="blog-text">
									<div class="prod-title">
										<h3><a href="#"><?php echo $dato2; ?> | <?php echo $dato4; ?></a></h3>
										<h5><a href="#">Viajaras entre el <?php echo $dato6; ?> al <?php echo $dato7; ?></a></h5>
										<span class="posted_by">Valoracion: <?php echo $dato3; ?> / 5</span>
										<div class="text-center">
											<form action="PaginaHotel.php" method="post" style="display: inline-block;">
												<input type="hidden" name="valor" value="<?php echo $dato5; ?>">
												<button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px;">Reservar</button>
											</form>
											<form action="wishlist.php" method="post" style="display: inline-block;">
												<input type="hidden" name="delete" value="<?php echo $id; ?>">
												<button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px;">Quitar</button>
											</form>
										</div>
									</div>
								</div> 
							</div>
						</div>
						<?php
					}
					?>
					<?php
				}
				?>
			</div>
		</div>
		<!-- fh5co-blog-section -->
		<div id="fh5co-testimonial" style="background-image:url(images/img_bg_1.jpg);">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>Clientes Felices</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="box-testimony animate-box">
						<blockquote>
							<span class="quote"><span><i class="icon-quotes-right"></i></span></span>
							<p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
						</blockquote>
						<p class="author">John Doe, CEO <a href="http://freehtml5.co/" target="_blank">FREEHTML5.co</a> <span class="subtext">Creative Director</span></p>
					</div>
					
				</div>
				<div class="col-md-4">
					<div class="box-testimony animate-box">
						<blockquote>
							<span class="quote"><span><i class="icon-quotes-right"></i></span></span>
							<p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.&rdquo;</p>
						</blockquote>
						<p class="author">John Doe, CEO <a href="http://freehtml5.co/" target="_blank">FREEHTML5.co</a> <span class="subtext">Creative Director</span></p>
					</div>
					
					
				</div>
				<div class="col-md-4">
					<div class="box-testimony animate-box">
						<blockquote>
							<span class="quote"><span><i class="icon-quotes-right"></i></span></span>
							<p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
						</blockquote>
						<p class="author">John Doe, Founder <a href="#">FREEHTML5.co</a> <span class="subtext">Creative Director</span></p>
					</div>
					
				</div>
			</div>
		</div>
	</div>
		<footer>
			<div id="footer">
				<div class="container">
					<div class="row row-bottom-padded-md">
						<div class="col-md-2 col-sm-2 col-xs-12 fh5co-footer-link">
							<h3>Acerca de Prestigetravels</h3>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-12 fh5co-footer-link">
							<h3>Top Flights Routes</h3>
							<ul>
								<li><a href="#">Manila flights</a></li>
								<li><a href="#">Dubai flights</a></li>
								<li><a href="#">Bangkok flights</a></li>
								<li><a href="#">Tokyo Flight</a></li>
								<li><a href="#">New York Flights</a></li>
							</ul>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-12 fh5co-footer-link">
							<h3>Top Hotels</h3>
							<ul>
								<li><a href="#">Boracay Hotel</a></li>
								<li><a href="#">Dubai Hotel</a></li>
								<li><a href="#">Singapore Hotel</a></li>
								<li><a href="#">Manila Hotel</a></li>
							</ul>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-12 fh5co-footer-link">
							<h3>Interest</h3>
							<ul>
								<li><a href="#">Beaches</a></li>
								<li><a href="#">Family Travel</a></li>
								<li><a href="#">Budget Travel</a></li>
								<li><a href="#">Food &amp; Drink</a></li>
								<li><a href="#">Honeymoon and Romance</a></li>
							</ul>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-12 fh5co-footer-link">
							<h3>Best Places</h3>
							<ul>
								<li><a href="#">Boracay Beach</a></li>
								<li><a href="#">Dubai</a></li>
								<li><a href="#">Singapore</a></li>
								<li><a href="#">Hongkong</a></li>
							</ul>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-12 fh5co-footer-link">
							<h3>Affordable</h3>
							<ul>
								<li><a href="#">Food &amp; Drink</a></li>
								<li><a href="#">Fare Flights</a></li>
							</ul>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-md-offset-3 text-center">
							<p class="fh5co-social-icons">
								<a href="#"><i class="icon-twitter2"></i></a>
								<a href="#"><i class="icon-facebook2"></i></a>
								<a href="#"><i class="icon-instagram"></i></a>
								<a href="#"><i class="icon-dribbble2"></i></a>
								<a href="#"><i class="icon-youtube"></i></a>
							</p>
							<p>Copyright 2023 Prestigetravels</p>
						</div>
					</div>
				</div>
			</div>
		</footer>

	

	</div>
	<!-- END fh5co-page -->

	</div>
	<!-- END fh5co-wrapper -->

	<!-- jQuery -->


	<script src="../src/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="../src/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="../src/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="../src/js/jquery.waypoints.min.js"></script>
	<script src="../src/js/sticky.js"></script>

	<!-- Stellar -->
	<script src="../src/js/jquery.stellar.min.js"></script>
	<!-- Superfish -->
	<script src="../src/js/hoverIntent.js"></script>
	<script src="../src/js/superfish.js"></script>
	<!-- Magnific Popup -->
	<script src="../js/jquery.magnific-popup.min.js"></script>
	<script src="../src/js/magnific-popup-options.js"></script>
	<!-- Date Picker -->
	<script src="../src/js/bootstrap-datepicker.min.js"></script>
	<!-- CS Select -->
	<script src="../src/js/classie.js"></script>
	<script src="../src/js/selectFx.js"></script>
	
	<!-- Main JS -->
	<script src="../src/js/main.js"></script>

	</body>
</html>
