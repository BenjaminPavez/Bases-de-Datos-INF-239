<?php
/*
La plantilla muestra la informacion de cada hotel

*/

//Datos usuario
session_start();
$idFinal = $_SESSION['user_id'];
$CorreoFinal = $_SESSION['Correo1'];
$NombreFinal = $_SESSION["Nombre1"];
$CumpleanosFinal = $_SESSION["Cumpleanos1"];
$ContrasenaFinal = $_SESSION["Contrasena1"];

//Se conecta a la base de datos
require_once 'database.php';

//Recibe el id del hotel a buscar
$id = $_POST["valor"];

//Realiza la consulta a la tabla hotel
$sql = "SELECT * FROM hotel WHERE id = $id";
$resultado = $mysqli->query($sql);

//Se extrae la informacion de la consulta
if ($resultado) {
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            // Accede a los campos específicos de la fila
            $id = $fila['id'];
            $nombre = $fila['nombre'];
            $num_estrellas = $fila['num_estrellas'];
            $precio_noche = $fila['precio_noche'];
            $estacionamiento = $fila['estacionamiento'];
            $piscina = $fila['piscina'];
            $servicio_lavanderia = $fila['servicio_lavanderia'];
            $servicio_desayuno = $fila['servicio_desayuno'];
            $pet_friendly = $fila['pet_friendly']; 
            $imagen = $fila['image'];
            $stock = $fila['disponibles']; 
            $fecha_i = $fila['fecha_inicio'];
            $fecha_t = $fila['fecha_termino'];   
        }
    }
}

//Se recibe la informacion de la foto y la transforma en una imagen
$imagenCodificada = base64_encode($imagen);


//Realiza la consulta a la tabla paquete para extraer las opiniones y la valoracion
$sql2 = "SELECT c.n_estrellas, c.opinion, 
        u.name AS nombre_usuario,
        r.fecha_inicio AS inicio,
        r.fecha_termino AS termino 
        FROM calificaciones c 
        JOIN user u ON u.id = c.user_id 
        JOIN reservas r ON r.id = c.reserva_id 
        JOIN hotel h ON h.id = r.hotel_id 
        WHERE h.id = '$id'";

//Ejecuta la consulta
$resultado2 = $mysqli->query($sql2);

?>
<!DOCTYPE html>

<html>
    <head>
        <base target="_parent">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&amp;display=swap">
        <link rel="stylesheet" href="https://mdbootstrap.com/api/snippets/static/download/MDB5-Free_6.3.1/css/mdb.min.css">
        <title><?php echo $nombre; ?></title>
        <link rel="shortcut icon" href="../src/img/Prestigetravels_logo.png">
        <style>INPUT:-webkit-autofill,SELECT:-webkit-autofill,TEXTAREA:-webkit-autofill{animation-name:onautofillstart}INPUT:not(:-webkit-autofill),SELECT:not(:-webkit-autofill),TEXTAREA:not(:-webkit-autofill){animation-name:onautofillcancel}@keyframes onautofillstart{}@keyframes onautofillcancel{}</style>
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

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body>
        <header id="fh5co-header-section" class="sticky-banner" style="background-color:#180148; display: inline-block; height: 95px;"">
			<div class="container">
				<div class="nav-header">
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
					<h1 style="margin-top: 30px;" id="fh5co-logo"><a style="text-decoration: none;" href="index.php"><i class="icon-airplane"></i>Prestigetravels</a></h1>
					<!-- START #fh5co-menu-wrap -->
					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">
							<li class="active"><a style="text-decoration: none;" href="index.php">Home</a></li>
							<li><a style="text-decoration: none;" href="Hoteles.php">Hoteles</a></li>
							<li><a style="text-decoration: none;" href="Paquetes.php">Paquetes</a></li>
							<li><a style="text-decoration: none;" href="Lista.php">Wishlist</a></li>
							<li><a style="text-decoration: none;" href="Carrito.php">Mi Carrito</a></li>
							<li><a style="text-decoration: none;" href="Perfil.php"><?php echo $NombreFinal; ?></a></li>
						</ul>
					</nav>
				</div>
			</div>
		</header>

        <main class="mt-5 pt-4">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
                        <div href="#" style="width: 400px; height: 300px; margin-top: 70px;">
                            <?php if ($imagenCodificada): ?>
                                <div class="cuadro-imagen" style="width: 400px; height: 300px;">
                                    <img src="data:image/jpeg;base64,<?php echo $imagenCodificada; ?>" alt="Imagen" style="width: 400px; height: 300px;">
                                </div>
                            <?php else: ?>
                                <p>No se encontró ninguna imagen.</p>
                            <?php endif; ?>
                            <div class="desc">
                                <span></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="p-4" style="margin-left: 60px; font-size: 16px;">
                            <div class="mb-3">
                                <a href=""><span class="badge bg-dark me-1">Extranjero</span></a>
                                <a href=""><span class="badge bg-info me-1">Vuelo</span></a>
                                <a href=""><span class="badge bg-danger me-1">Hotel</span></a>
                            </div>
                            <h1 class="h2" style="font-size: 30px;"><?php echo $nombre; ?></h1>
                            <p class="lead">
                                <?php
                                $precioFormateado = number_format($precio_noche, 0, ',', '.');
                                ?>
                                <span class="precio" style="font-size: 25px;">CLP <?php echo $precioFormateado; ?> por noche</span>
                            </p>
                            <strong><p style="font-size: 20px;">Información</p></strong>
                            <div class="package-item-summary">
                                <div data-v-2c1ca5c2="" class="package-item-row package-item-dates">
                                    <div data-v-2c1ca5c2="" class="package-info-title">
                                        Tiene Estacionamiento: <?php echo ($estacionamiento == 1) ? 'Sí' : 'No';?>
                                    </div>
                                </div>
                                <div data-v-14e3ce94="" class="package-item-row package-item-dates">
                                    <div data-v-14e3ce94="" class="package-info-title">
                                        Tiene Piscina: <?php echo ($piscina == 1) ? 'Sí' : 'No';?>
                                    </div>
                                </div>
                                <div data-v-2c1ca5c2="" class="package-item-row package-item-dates">
                                    <div data-v-2c1ca5c2="" class="package-info-title">
                                        Tiene Servicio de Lavanderia: <?php echo ($servicio_lavanderia == 1) ? 'Sí' : 'No';?>
                                    </div>
                                </div>
                                <div data-v-2c1ca5c2="" class="package-item-row package-item-dates">
                                    <div data-v-2c1ca5c2="" class="package-info-title">
                                        Tiene Servicio de Desayuno: <?php echo ($servicio_desayuno == 1) ? 'Sí' : 'No';?>
                                    </div>
                                </div>
                                <div data-v-2c1ca5c2="" class="package-item-row package-item-dates">
                                    <div data-v-2c1ca5c2="" class="package-info-title">
                                        Acepta Mascotas: <?php echo ($pet_friendly == 1) ? 'Sí' : 'No';?>
                                    </div>
                                </div>
                                <div data-v-2c1ca5c2="" class="package-item-row package-item-dates">
                                    <div data-v-2c1ca5c2="" class="package-info-title">
                                        Fecha minima: <?php echo $fecha_i;?>
                                    </div>
                                </div>
                                <div data-v-2c1ca5c2="" class="package-item-row package-item-dates">
                                    <div data-v-2c1ca5c2="" class="package-info-title">
                                        Fecha maxima: <?php echo $fecha_t;?>
                                    </div>
                                </div>
                                <div data-v-23c78582="" class="package-item-row package-item-dates">
                                    <div data-v-2c1ca5c2="" class="package-info-title">
                                        <?php
                                        echo '<div data-v-23c78582="">';
                                        echo '<div data-v-23c78582="" class="stars">';
                                        echo 'Valoracion: ';
                                        for ($i = 0; $i < $num_estrellas; $i++) {
                                            echo '<i data-v-23c78582="" class="icon-star"></i>';
                                        }
                                        echo '</div>';
                                        echo '</div>';
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <p></p>
                            <p>Stock disponible: <?php echo $stock; ?></p>
                            <p></p>
                            <form class="d-flex flex-column align-items-start" method="get" action="reserva.php">
                                <div class="mb-3" style="width: 300px;">
                                    <label for="fecha_inicio" class="form-label">Fecha de llegada:</label>
                                    <input style="height: 30px;" type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                                </div>
                                <div class="mb-3" style="width: 300px;">
                                    <label for="fecha_salida" class="form-label">Fecha de salida:</label>
                                    <input style="height: 30px;" type="date" name="fecha_salida" id="fecha_salida" class="form-control" required>
                                </div>
                                <p></p>
                                <input type="hidden" name="valor" value="<?php echo $id; ?>">
                                <button style="text-align: center;" class="btn btn-primary btn-lg" type="submit">Reservar</button>
                                <button style="text-align: center; position: relative; right: -130px; top: -32px;" class="btn btn-primary btn-lg" name="accion" value="wishlist" formaction="wishlist.php" type="submit">Agregar a Wishlist</button>
                            </form>
                            <p></p>
                            <div class="container" style="margin-left: -450px; width: 3000px;">
                                <div class="row row-bottom-padded-md">
                                    <?php
                                    if($resultado2->num_rows > 0){
                                        while($row = $resultado2->fetch_assoc()){
                                            ?>
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="fh5co-blog animate-box">
                                                    <a href="#"><img class="img-responsive" src="../src/img/place-1.jpg" alt=""></a>
                                                    <div class="blog-text">
                                                        <div class="prod-title">
                                                            <h3><a href="#"><?php echo $row['nombre_usuario']; ?></a></h3>
                                                            <span class="posted_by">Del <?php echo $row['inicio']; ?> a <?php echo $row['termino']; ?></span>
                                                            <span class="comment"><a href=""><?php echo $row['n_estrellas']; ?> / 5</a></span>
                                                            <p><?php echo $row['opinion']; ?></p>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="fh5co-blog animate-box">
                                                <a href="#"><img class="img-responsive" src="../src/img/place-1.jpg" alt=""></a>
                                                <div class="blog-text">
                                                    <h3><a href="#">Sin reseñas</a></h3>
                                                </div> 
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="clearfix visible-md-block"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </main>
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
        <script type="text/javascript" src="https://mdbootstrap.com/api/snippets/static/download/MDB5-Free_6.3.1/js/mdb.min.js"></script><script type="text/javascript">{}</script>
    </body>
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
</html>