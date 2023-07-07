<?php
/*
La plantilla muestra la pagina principal

*/

//Datos usuario
session_start();

// Verificar si hay un usuario logueado
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

//Se realiza la consulta para ver los paquetes con menor cantidad de disponibles y la ejecuta
$sql1 = "SELECT * FROM paquete ORDER BY disponibles ASC LIMIT 2";
$result1 = mysqli_query($mysqli, $sql1);

//Se realiza la consulta para ver los paquetes con menor cantidad de disponibles y la ejecuta
$sql2 = "SELECT * FROM HOTEL ORDER BY disponibles ASC LIMIT 2";
$result2 = mysqli_query($mysqli, $sql2);


?>
<!DOCTYPE html>
	<head>
	<meta charset="utf-8">
	<title>Prestigetravels</title>
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
	<script src="../src/js/modernizr-2.6.2.min.js"></script>
	</head>
	<style>
    /* Estilos generales */
    body {
      margin: 0;
      padding: 0;
    }

    /* Estilos para el iframe */
    #cupon-frame {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border: none;
      z-index: 9999;
    }
  	</style>
	<body>
		<iframe id="cupon-frame" src="cupon.html" frameborder="0"></iframe>
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
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="fh5co-tours" class="fh5co-section-gray">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h3>Mayor cantidad de reservas</h3>
						<p>En esta sección, encontrarás los paquetes de hoteles más populares con el mayor número de reservas, asegurando una experiencia de viaje excepcional y de alta demanda.</p>
					</div>
				</div>
				<div class="row">
					<?php
					while($row = mysqli_fetch_assoc($result1)){
						$id_paquete = $row['id'];
						$nombrep = $row['nombre'];
						$preciop = $row['precio_persona'];
						?>
						<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
							<div href="#"><img src="../src/img/Paquete<?php echo $id_paquete; ?>.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
								<div class="desc">
									<span></span>
									<h3><?php echo $nombrep; ?></h3>
									<span>Vuelo ida y vuelta</span>
									<span class="CLP">CLP <?php echo number_format($preciop, 0, ',', '.'); ?></span>
									<form action="PaginaPaquete.php" method="post">
										<input type="hidden" name="valor" value="<?php echo $id_paquete; ?>">
    									<button type="submit" class="btn btn-primary btn-outline" class="icon-arrow-right22">Comprar Ahora</button>
									</form>
								</div>
							</div>
						</div>
						<?php
					}
					?>
					<?php
						while($row = mysqli_fetch_assoc($result2)){
							$id_hotel = $row['id'];
							$nombreh = $row['nombre'];
							$precioh = $row['precio_noche'];
							?>
							<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
								<div href="#"><img src="../src/img/Hotel<?php echo $id_hotel; ?>.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
									<div class="desc">
										<span></span>
										<h3><?php echo $nombreh; ?></h3>
										<span>Habitacion para 2 personas</span>
										<span class="CLP">CLP <?php echo number_format($precioh, 0, ',', '.'); ?></span>
										<form action="PaginaHotel.php" method="post">
											<input type="hidden" name="valor" value="<?php echo $id_hotel; ?>">
    										<button type="submit" class="btn btn-primary btn-outline" class="icon-arrow-right22">Comprar Ahora</button>
										</form>
									</div>
								</div>
							</div>
							<?php
						}
					?>
					<div class="col-md-12 text-center animate-box">
						<p><a class="btn btn-primary btn-outline btn-lg" href="Paquetes.php">Ver mas ofertas <i class="icon-arrow-right22"></i></a></p>
					</div>
				</div>
			</div>
		</div>

		<div id="fh5co-features">
			<div class="container">
				<div class="row">
					<div class="col-md-4 animate-box">

						<div class="feature-left">
							<span class="icon">
								<i class="icon-hotairballoon"></i>
							</span>
							<div class="feature-copy">
								<h3>Viajes en familia</h3>
								<p>Ofrecemos paquetes personalizados para que disfrutes de experiencias únicas en familia.</p>
							</div>
						</div>

					</div>

					<div class="col-md-4 animate-box">
						<div class="feature-left">
							<span class="icon">
								<i class="icon-search"></i>
							</span>
							<div class="feature-copy">
								<h3>Planes de viaje</h3>
								<p>Organizamos tus viajes de forma sencilla y sin complicaciones, adaptados a tus necesidades.</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 animate-box">
						<div class="feature-left">
							<span class="icon">
								<i class="icon-wallet"></i>
							</span>
							<div class="feature-copy">
								<h3>Luna de miel</h3>
								<p>Haz que tu luna de miel sea inolvidable con nuestros paquetes románticos en destinos exóticos.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 animate-box">

						<div class="feature-left">
							<span class="icon">
								<i class="icon-wine"></i>
							</span>
							<div class="feature-copy">
								<h3>Viajes de negocios</h3>
								<p>Planificamos tus viajes de negocios de manera eficiente y exitosa.</p>
							</div>
						</div>

					</div>

					<div class="col-md-4 animate-box">
						<div class="feature-left">
							<span class="icon">
								<i class="icon-genius"></i>
							</span>
							<div class="feature-copy">
								<h3>Viajes en solitario</h3>
								<p>Descubre el mundo por tu cuenta con nuestras opciones de viaje para aventureros solitarios.</p>
							</div>
						</div>

					</div>
					<div class="col-md-4 animate-box">
						<div class="feature-left">
							<span class="icon">
								<i class="icon-chat"></i>
							</span>
							<div class="feature-copy">
								<h3>Explorador</h3>
								<p>Vive emocionantes experiencias de aventura en destinos exóticos y naturaleza impresionante.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		
		<div id="fh5co-destination">
			<div class="tour-fluid">
				<div class="row">
					<div class="col-md-12">
						<ul id="fh5co-destination-list" class="animate-box">
							<li class="one-forth text-center" style="background-image: url(../src/img/Paquete1.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2>New York</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(../src/img/Paquete2.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2>Filipinas</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(../src/img/Paquete6.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2>Japon</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(../src/img/Paquete4.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2>Miami</h2>
									</div>
								</a>
							</li>

							<li class="one-forth text-center" style="background-image: url(../src/img/Paquete5.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2>Egipto</h2>
									</div>
								</a>
							</li>
							<li class="one-half text-center">
								<div class="title-bg">
									<div class="case-studies-summary">
										<h2>Destinos Populares</h2>
										<span><a href="Paquetes.php">Mira todos los destinos</a></span>
									</div>
								</div>
							</li>
							<li class="one-forth text-center" style="background-image: url(../src/img/Paquete8.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2>Paris</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(../src/img/Paquete12.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2>Singapore</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(../src/img/Paquete11.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2>Madagascar</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(../src/img/Paquete10.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2>Madrid</h2>
									</div>
								</a>
							</li>
							<li class="one-forth text-center" style="background-image: url(../src/img/Paquete9.jpg); ">
								<a href="#">
									<div class="case-studies-summary">
										<h2>Ámsterdam</h2>
									</div>
								</a>
							</li>
						</ul>		
					</div>
				</div>
			</div>
		</div>

		<div id="fh5co-blog-section" class="fh5co-section-gray">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h3>Recent From Blog</h3>
						<p>Lo más reciente de Prestige Travels: Descubre las últimas tendencias, consejos y destinos imperdibles en nuestro blog. Sumérgete en el fascinante mundo de los viajes y déjate inspirar para tu próxima aventura. ¡Acompáñanos en este emocionante recorrido!</p>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row row-bottom-padded-md">
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="fh5co-blog animate-box">
							<a href="#"><img class="img-responsive" src="src/img/place-1.jpg" alt=""></a>
							<div class="blog-text">
								<div class="prod-title">
									<h3><a href="#">30% Discount to Travel All Around the World</a></h3>
									<span class="posted_by">Sep. 15th</span>
									<span class="comment"><a href="">21<i class="icon-bubble2"></i></a></span>
									<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
									<p><a href="#">Learn More...</a></p>
								</div>
							</div> 
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="fh5co-blog animate-box">
							<a href="#"><img class="img-responsive" src="src/img/place-2.jpg" alt=""></a>
							<div class="blog-text">
								<div class="prod-title">
									<h3><a href="#">Planning for Vacation</a></h3>
									<span class="posted_by">Sep. 15th</span>
									<span class="comment"><a href="">21<i class="icon-bubble2"></i></a></span>
									<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
									<p><a href="#">Learn More...</a></p>
								</div>
							</div> 
						</div>
					</div>
					<div class="clearfix visible-sm-block"></div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="fh5co-blog animate-box">
							<a href="#"><img class="img-responsive" src="src/img/place-3.jpg" alt=""></a>
							<div class="blog-text">
								<div class="prod-title">
									<h3><a href="#">Visit Tokyo Japan</a></h3>
									<span class="posted_by">Sep. 15th</span>
									<span class="comment"><a href="">21<i class="icon-bubble2"></i></a></span>
									<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
									<p><a href="#">Learn More...</a></p>
								</div>
							</div> 
						</div>
					</div>
					<div class="clearfix visible-md-block"></div>
				</div>

				<div class="col-md-12 text-center animate-box">
					<p><a class="btn btn-primary btn-outline btn-lg" href="#">See All Post <i class="icon-arrow-right22"></i></a></p>
				</div>

			</div>
		</div>
		<!-- fh5co-blog-section -->
		<div id="fh5co-testimonial" style="background-image:url(src/img/img_bg_1.jpg);">
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
	<script src="../src/js/jquery.magnific-popup.min.js"></script>
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

