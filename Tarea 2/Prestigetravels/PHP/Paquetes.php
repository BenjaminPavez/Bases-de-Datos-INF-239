<?php
/*
La plantilla muestra todos los paquetes disponibles en la plataforma

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


?>

<!DOCTYPE html>
<html class="no-js">
	<head>
	<meta charset="utf-8">
	<title>Paquetes</title>
	<link rel="shortcut icon" href="../src/img/Prestigetravels_logo.png">
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
	<script src="../js/modernizr-2.6.2.min.js"></script>

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

		<div class="fh5co-hero">
			<div class="fh5co-overlay"></div>
			<div class="fh5co-cover" data-stellar-background-ratio="0.5" style="background-image: url(images/cover_bg_1.jpg);">
				<div class="desc">
					<div class="container">
						<div class="row">
							<div class="col-sm-5 col-md-5">
								<div class="tabulation animate-box">
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
						<h3>Top 10 Mejores Paquetes</h3>
						<p>Descubre las maravillas del mundo en familia con un paquete de viaje especialmente diseñado para ti.</p>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row row-bottom-padded-md">
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="fh5co-blog animate-box">
							<a href="#"><img class="img-responsive" src="../src/img/Paquete1.jpg" alt=""></a>
							<div class="blog-text">
								<div class="prod-title">
									<h3><a href="">New York</a></h3>
									<span class="posted_by">CLP 750.000 por persona</span>
									<p>Maravillas de EEUU: Descubriendo la Tierra de las Oportunidades</p>
									<form action="PaginaPaquete.php" method="post">
										<input type="hidden" name="valor" value="1">
    									<p class="text-center"><button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px;">Comprar</button></p>
									</form>
								</div>
							</div> 
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="fh5co-blog animate-box">
							<a href="#"><img class="img-responsive" src="../src/img/Paquete2.jpg" alt=""></a>
							<div class="blog-text">
								<div class="prod-title">
									<h3><a href="#">Filipinas</a></h3>
									<span class="posted_by">CLP 870.000 por persona</span>
									<p>Explorando las Islas Filipinas: Tesoros Tropicales y Cultura Exuberante</p>
									<form action="PaginaPaquete.php" method="post">
										<input type="hidden" name="valor" value="2">
    									<p class="text-center"><button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px;">Comprar</button></p>
									</form>
								</div>
							</div> 
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="fh5co-blog animate-box">
							<a href="#"><img class="img-responsive" src="../src/img/Paquete3.jpg" alt=""></a>
							<div class="blog-text">
								<div class="prod-title">
									<h3><a href="#">Tokyo</a></h3>
									<span class="posted_by">CLP 1.500.000 por persona</span>
									<p>Descubriendo Japón: Tradición, Tecnología y Encanto Oriental</p>
									<form action="PaginaPaquete.php" method="post">
										<input type="hidden" name="valor" value="3">
    									<p class="text-center"><button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px;">Comprar</button></p>
									</form>
								</div>
							</div> 
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="fh5co-blog animate-box">
							<a href="#"><img class="img-responsive" src="../src/img/Paquete4.jpg" alt=""></a>
							<div class="blog-text">
								<div class="prod-title">
									<h3><a href="#">Miami</a></h3>
									<span class="posted_by">CLP 670.000 por persona</span>
									<p>Maravillas de América: Descubre la Diversidad y la Grandeza de Estados Unidos</p>
									<form action="PaginaPaquete.php" method="post">
										<input type="hidden" name="valor" value="4">
    									<p class="text-center"><button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px;">Comprar</button></p>
									</form>
								</div>
							</div> 
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="fh5co-blog animate-box">
							<a href="#"><img class="img-responsive" src="../src/img/Paquete5.jpg" alt=""></a>
							<div class="blog-text">
								<div class="prod-title">
									<h3><a href="#">El Cairo</a></h3>
									<span class="posted_by">CLP 900.000 por persona</span>
									<p>Tras las Huellas del Antiguo Egipto: Aventura en las Tierras de los Faraones</p>
									<form action="PaginaPaquete.php" method="post">
										<input type="hidden" name="valor" value="5">
    									<p class="text-center"><button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px;">Comprar</button></p>
									</form>
								</div>
							</div> 
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="fh5co-blog animate-box">
							<a href="#"><img class="img-responsive" src="../src/img/Paquete6.jpg" alt=""></a>
							<div class="blog-text">
								<div class="prod-title">
									<h3><a href="#">Osaka</a></h3>
									<span class="posted_by">CLP 1.000.000 por persona</span>
									<p>El Encanto del País del Sol Naciente: Sumergiéndote en la Tradición y la Modernidad de Japón</p>
									<form action="PaginaPaquete.php" method="post">
										<input type="hidden" name="valor" value="6">
    									<p class="text-center"><button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px;">Comprar</button></p>
									</form>
								</div>
							</div> 
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="fh5co-blog animate-box">
							<a href="#"><img class="img-responsive" src="../src/img/Paquete7.jpg" alt=""></a>
							<div class="blog-text">
								<div class="prod-title">
									<h3><a href="#">Auckland</a></h3>
									<span class="posted_by">CLP 750.000 por persona</span>
									<p>Aventuras en la Naturaleza: Paisajes Impresionantes y Aventuras al Aire Libre</p>
									<form action="PaginaPaquete.php" method="post">
										<input type="hidden" name="valor" value="7">
    									<p class="text-center"><button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px;">Comprar</button></p>
									</form>
								</div>
							</div> 
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="fh5co-blog animate-box">
							<a href="#"><img class="img-responsive" src="../src/img/Paquete8.jpg" alt=""></a>
							<div class="blog-text">
								<div class="prod-title">
									<h3><a href="#">Paris</a></h3>
									<span class="posted_by">CLP 800.000 por persona</span>
									<p>Descubriendo la Elegancia de Francia: Arte, Cultura y Delicias Gastronómicas</p>
									<form action="PaginaPaquete.php" method="post">
										<input type="hidden" name="valor" value="8">
    									<p class="text-center"><button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px;">Comprar</button></p>
									</form>
								</div>
							</div> 
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="fh5co-blog animate-box">
							<a href="#"><img class="img-responsive" src="../src/img/Paquete9.jpg" alt=""></a>
							<div class="blog-text">
								<div class="prod-title">
									<h3><a href="#">Amsterdam</a></h3>
									<span class="posted_by">CLP 980.000 por persona</span>
									<p>Explorando los Paises Bajos: Encanto Holandés y Belleza Escénica</p>
									<form action="PaginaPaquete.php" method="post">
										<input type="hidden" name="valor" value="9">
    									<p class="text-center"><button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px;">Comprar</button></p>
									</form>
								</div>
							</div> 
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="fh5co-blog animate-box">
							<a href="#"><img class="img-responsive" src="../src/img/Paquete10.jpg" alt=""></a>
							<div class="blog-text">
								<div class="prod-title">
									<h3><a href="#">Madrid</a></h3>
									<span class="posted_by">CLP 590.000 por persona</span>
									<p>Descubriendo Madrid: Encanto español y riqueza cultural</p>
									<form action="PaginaPaquete.php" method="post">
										<input type="hidden" name="valor" value="10">
    									<p class="text-center"><button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px;">Comprar</button></p>
									</form>
								</div>
							</div> 
						</div>
					</div>
				</div>

			</div>
		</div>
		<div id="fh5co-testimonial" style="background-image:url(images/img_bg_1.jpg);">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>Happy Clients</h2>
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
	<script src="src/js/superfish.js"></script>
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

