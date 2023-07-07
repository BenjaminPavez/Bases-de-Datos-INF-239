<?php
/*
La plantilla se encarga de mostrar los datos del carrito

*/

//Datos usuario
session_start();

//Se verificar si hay un usuario logueado o no
if(isset($_SESSION['Nombre1'])) {
    $pass = true;
    $idFinal = $_SESSION['user_id'];
    $CorreoFinal = $_SESSION['Correo1'];
    $NombreFinal = $_SESSION["Nombre1"];
    $CumpleanosFinal = $_SESSION["Cumpleanos1"];
    $ContrasenaFinal = $_SESSION["Contrasena1"];
} else {
    $pass = null;
}

//Flag que verifica si hay un cupon
$flag = false;

//Se comprueba si el codigo de descuento es valido acorde a una exprecion regular para facilitar la comprobacion
if(isset($_POST['codigo_descuento'])) {
	$codigo_descuento = $_POST['codigo_descuento'];
	$pattern = "/^PRESTIGE\d{2}$/";
	if(preg_match($pattern, $codigo_descuento)){
		$mod = substr($codigo_descuento, -2);
		$descuento = intval($mod);
		if($descuento >= 15){
			$descuento = 15;
		}
		$flag = true;
	}else{
		$flag = false;
		$codigo_descuento = "NO VALIDO";
	}
}else{
	$codigo_descuento = "";
}

//Archivo que se conecta a la Base de Datos
require_once 'database.php';

//Se consulta los datos de los paquetes y/o hoteles que agrego a la tabla carrito
$query = "SELECT c.id, c.paquete_id, c.reserva_id, c.user_id, 
          c.nro_paquetes,
          p.nombre AS nombre_paquete, 
          p.fecha_inicio AS fecha_inicio_paquete, 
          p.fecha_termino AS fecha_termino_paquete, 
          p.precio_persona AS precio_paquete, 
          r.fecha_inicio AS fecha_inicio_reserva, 
          r.fecha_termino AS fecha_termino_reserva, 
          h.nombre AS nombre_hotel, 
          h.precio_noche AS precio_hotel
          FROM carrito c
          LEFT JOIN paquete p ON c.paquete_id = p.id
          LEFT JOIN reservas r ON c.reserva_id = r.id
          LEFT JOIN hotel h ON r.hotel_id = h.id
          WHERE c.user_id = $idFinal";

//Se ejecuta la constulta
$result = mysqli_query($mysqli, $query);

//Se extrae la informacion de la consulta
if($result) {
    $cuenta = array();
    $num = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $carrito_id = $row['id'];
        $paquete_id = $row['paquete_id'];
        $reserva_id = $row['reserva_id'];
        $user_id = $row['user_id'];
        $nro_paquetes = $row['nro_paquetes'];
        $nombre_paquete = $row['nombre_paquete'];
        $fecha_inicio_paquete = $row['fecha_inicio_paquete'];
        $fecha_termino_paquete = $row['fecha_termino_paquete'];
        $precio_paquete = $row['precio_paquete'];
        $fecha_inicio_reserva = $row['fecha_inicio_reserva'];
        $fecha_termino_reserva = $row['fecha_termino_reserva'];
        $nombre_hotel = $row['nombre_hotel'];
        $precio_hotel = $row['precio_hotel'];
        $info = array();
        // Verificar si es un paquete o una reserva
        if(!is_null($paquete_id)){
            $tipo = "Paquete";
			array_push($info, $carrito_id);
            array_push($info, $tipo);
            array_push($info, $nombre_paquete);
            array_push($info, $precio_paquete);
            array_push($info, $fecha_inicio_paquete);
            array_push($info, $fecha_termino_paquete);
            array_push($info, $nro_paquetes);
            $num += 1;
        }elseif(!is_null($reserva_id)){
            $tipo = "Reserva";
			array_push($info, $carrito_id);
            array_push($info, $tipo);
            array_push($info, $nombre_hotel);
            array_push($info, $precio_hotel);
            array_push($info, $fecha_inicio_reserva);
            array_push($info, $fecha_termino_reserva);
            array_push($info, 1); // No hay columna nro_paquetes en la reserva, siempre es 1
            $num += 1;
        }
        array_push($cuenta, $info);
    }
}else{
    echo "Error en la consulta: " . mysqli_error($mysqli);
}


?>


<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

    <!-- jQuery y Popper.js (requeridos para el funcionamiento de Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://getbootstrap.com/docs/5.3/assets/js/color-modes.js"></script>



    <title>Mi Carrito</title>
    <link rel="shortcut icon" href="../src/img/Prestigetravels_logo.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../src/css/animate.css">
    <link rel="stylesheet" href="../src/css/icomoon.css">
    <link rel="stylesheet" href="../src/css/superfish.css">
    <link rel="stylesheet" href="../src/css/magnific-popup.css">
    <link rel="stylesheet" href="../src/css/cs-select.css">
    <link rel="stylesheet" href="../src/css/cs-skin-border.css">
    <script src="../src/js/modernizr-2.6.2.min.js"></script>


    
	<link rel="stylesheet" href="../src/css/bootstrap-datepicker.min.css">
	
	<link rel="stylesheet" href="../src/css/style.css">
	

  
    
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="../src/css/checkout.css" rel="stylesheet">
    </head>
    <body class="bg-body-tertiary">
        <header id="fh5co-header-section" class="sticky-banner" style="background-color:#180148; display: inline-block; height: 95px;">
			<div class="container">
				<div class="nav-header" style="width: 1040px;">
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
					<h1 style="margin-top: 30px; margin-left: -100px;" id="fh5co-logo"><a style="text-decoration: none;" href="index.php"><i class="icon-airplane"></i>Prestigetravels</a></h1>
					<nav id="fh5co-menu-wrap" role="navigation" style="text-align: right;">
                        <ul class="sf-menu" id="fh5co-primary-menu" style="position: relative;">
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
<div class="container">
  <main>
    <div class="py-5 text-center">
      <h2>Carrito de compras</h2>
    </div>
    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3" style="width: 450px;">
          <span class="text-primary">Tu Carrito</span>
          <span class="badge bg-primary rounded-pill"><?php echo $num; ?></span>
        </h4>
        <ul class="list-group mb-3" style="width: 450px;">
			<?php
			$suma = 0;
			// Acceder a los datos recibidos
			foreach($cuenta as $info) {
				$id_carrito = $info[0];
				$tipo = $info[1];
				$nombre = $info[2];
				$precio = $info[3];
				$fecha_i = $info[4];
				$fecha_f = $info[5];
				$cantidad = $info[6];
				if ($tipo == "Reserva"){
					?>
					<form method="post" action="del_carrito.php">
						<li class="list-group-item d-flex justify-content-between lh-sm">
							<div class="d-flex align-items-center">
								<h6 class="my-0">Reserva <?php echo $nombre; ?></h6>
								<?php
								$precioFormateado = number_format(floor((abs(strtotime($fecha_f) - strtotime($fecha_i))) / (60 * 60 * 24)) * $precio, 0, ',', '.');
								$suma += floor((abs(strtotime($fecha_f) - strtotime($fecha_i))) / (60 * 60 * 24)) * $precio;
								?>
								<small class="text-body-secondary"><?php echo $fecha_i; ?> al <?php echo $fecha_f; ?></small>
							</div>
							<span class="text-body-secondary">CLP <?php echo $precioFormateado; ?></span>
							<input type="hidden" name="id_carrito" value="<?php echo $id_carrito; ?>">
							<button type="submit" class="btn btn-outline-danger">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
								<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
								<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
								</svg>
							</button>
						</li>
					</form>
					<?php
				}else{
					?>
					<form method="post" action="del_carrito.php">
						<li class="list-group-item d-flex justify-content-between lh-sm">
							<div>
								<h6 class="my-0">Paquete <?php echo $nombre; ?></h6>
								<?php
								$precioFormateado = number_format($cantidad*$precio, 0, ',', '.');
								$suma += $cantidad*$precio;
								?>
								<small class="text-body-secondary"><?php echo $fecha_i; ?> al <?php echo $fecha_f; ?></small>
							</div>
							<span class="text-body-secondary">CLP <?php echo $precioFormateado; ?></span>
							<input type="hidden" name="id_carrito" value="<?php echo $id_carrito; ?>">
							<button type="submit" class="btn btn-outline-danger">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
								<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
								<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
								</svg>
							</button>
						</li>
					</form>
					<?php
				}
			}
			?>
			<?php
			if($flag){
				$suma -= round($suma*(intval($descuento) / 100), 2);
				?>
				<li class="list-group-item d-flex justify-content-between bg-body-tertiary">
					<div class="text-success">
					<h6 class="my-0">Codigo de descuento</h6>
					<small><?php echo $codigo_descuento; ?></small>
					</div>
					<span class="text-success"><?php echo number_format(round($suma*(intval($descuento) / 100), 2), 0, ',', '.') ?></span>
				</li>
				<?php
			}else{
				?>
				<li class="list-group-item d-flex justify-content-between bg-body-tertiary">
					<div class="text-danger">
					<h6 class="my-0">Codigo de descuento</h6>
					<small><?php echo $codigo_descuento; ?></small>
					</div>
					<span class="text-danger">−$0</span>
				</li>
				<?php
			}
			?>
			<li class="list-group-item d-flex justify-content-between">
				<span>Total (CLP)</span>
				<strong><?php echo number_format($suma, 0, ',', '.'); ?></strong>
			</li>
        </ul>

        <form class="card p-2" method="post" action="Carrito.php" style="width: 450px;">
          <div class="input-group">
            <input type="text" class="form-control" name="codigo_descuento" placeholder="Descuento">
            <button type="submit" class="btn btn-secondary">Canjear</button>
          </div>
        </form>
      </div>
      
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Informacion Facturacion</h4>
          <div class="row g-3">


            <div class="col-sm-6">
              <label for="firstName" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="firstName" placeholder="<?php echo $NombreFinal; ?>" value="" readonly required>
              <div id="firstNameFeedback" class="invalid-feedback">
                El campo no es editable.
              </div>
            </div>

            <script>
              document.getElementById('firstName').addEventListener('input', function() {
                document.getElementById('firstNameFeedback').textContent = "El campo no es editable.";
              });
            </script>

            

            <div class="col-12">
              <label for="username" class="form-label">Username</label>
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" id="username" value="<?php echo $NombreFinal; ?>" readonly required>
              <div class="invalid-feedback">
                  Your username is required.
                </div>
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label">Email <span class="text-body-secondary"></span></label>
              <input type="email" class="form-control" id="email" placeholder="<?php echo $CorreoFinal; ?>">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">Direccion de Facturacion</label>
              <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">Direccion de Facturacion 2 <span class="text-body-secondary">(Opcional)</span></label>
              <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
            </div>

            <div class="col-md-5">
              <label for="country" class="form-label">Pais</label>
              <select class="form-select" id="country" required>
                <option value="">Elija</option>
                <option>Chile</option>
              </select>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>

            <div class="col-md-4">
              <label for="state" class="form-label">Region</label>
              <select class="form-select" id="state" required>
                <option value="">Elija...</option>
                <option>Metropolitana de Santiago</option>
              </select>
              <div class="invalid-feedback">
                Please provide a valid state.
              </div>
            </div>

            <div class="col-md-3">
              <label for="zip" class="form-label">Codigo Postal</label>
              <input type="text" class="form-control" id="zip" placeholder="" required>
              <div class="invalid-feedback">
                Zip code required.
              </div>
            </div>
          </div>

          <hr class="my-4">

          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="same-address">
            <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
          </div>

          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="save-info">
            <label class="form-check-label" for="save-info">Save this information for next time</label>
          </div>

          <hr class="my-4">

          <h4 class="mb-3">Pago</h4>

          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
              <label class="form-check-label" for="credit">Tarjeta de Credito</label>
            </div>
            <div class="form-check">
              <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="debit">Web Pay</label>
            </div>
            <div class="form-check">
              <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="paypal">PayPal</label>
            </div>
          </div>

          <div class="row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">Titular</label>
              <input type="text" class="form-control" id="cc-name" placeholder="" required>
              <small class="text-body-secondary">Full name as displayed on card</small>
              <div class="invalid-feedback">
                Name on card is required
              </div>
            </div>

            <div class="col-md-6">
              <label for="cc-number" class="form-label">Numero</label>
              <input type="text" class="form-control" id="cc-number" placeholder="" required>
              <div class="invalid-feedback">
                Credit card number is required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Expiracion</label>
              <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
              <div class="invalid-feedback">
                Expiration date required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
              <div class="invalid-feedback">
                Security code required
              </div>
            </div>
          </div>

          <hr class="my-4">
		  <form method="post" action="calificacion.php">
		  	<input type="hidden" name="flag" value="1">
			<button class="w-100 btn btn-primary btn-lg" type="submit">Comprar</button>
		  </form>
      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-body-secondary text-center text-small">
    <p class="mb-1">&copy; 2023–2023 Prestigetravles S.A</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacidad</a></li>
      <li class="list-inline-item"><a href="#">Terminos</a></li>
      <li class="list-inline-item"><a href="#">Soporte</a></li>
    </ul>
  </footer>
</div>

    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
      <script src="../src/js/checkout.js"></script>
  
  </body>
</html>
