Nombre: Benjamin Alejandro Pavez Ortiz

Rol USM: 202173628-K

SO: Windows 11

IDE: Visual Studio Code

Supuestos:

1) Para un desarrollo mas simple, los paquetes van a una ciudad y a un hotel

2) La busqueda avanzada y la busqueda normal se encuentran implementados en el menu presentes en todas las plantillas

3) Las valoraciones que se muestran por cada paquete u hotel es un promedio entre cada valoracion, limpieza, servicio, etc

4) Para evitar problemas con el digito del rut, no se pedira el rut al registrarse

5) El efecto en cascada se realiza de manera manual, es decir al comprar un paquete o reserva, dentro de la aplicacion se realiza otra consula actualizando los datos

6) En el carrito no es necesario llenar los datos de facturacion, ya que al no realizar una transaccion real, no se necesitaran

7) Para la estetica se utilizaron plantillas de bootstrap y de otros sitios del mismo tipo

Instrucciones de uso:

1) El sitio web cuenta con todas las caracteristicas señaladas en el pdf

2) Debido a la extencion de la tarea, todos los supuestos al realizar la tarea se encuentran en la parte superior

3) Cada archivo .php se encuentra detalladamente comentado

4) Para la realizacion de la tarea se omitieron algunos temas de la seguridad para la facilidad, por ejemplo, las contraseñas no se encuentran encriptadas, entre otras

5) A continuacion se explica la funcion de cada archivo:
    Agregar_carro.php : El archivo se encarga de agregar o paquetes o reserva
    busqueda.php : La plantilla se encarga de mostrar los resultados a la busqueda
    calificacion.php : El archivo se encarga de añadir los productos comprados a la tabla calificaciones para que posterior los califique
    Carrito.php : La plantilla se encarga de mostrar los datos de facturacion y lo que quiere comprar
    compra_paquete.php : El archivo se encarga de agregar a la cantidad de paquetes al carrito
    Compras.php : La plantilla se encarga de mostrar las compras que hizo el usuario
    cupon.html : La plantilla se encarga de mostrar el cupon
    database.php : El archivo se encarga de conectarse a la base de datos
    del_carrito.php : El archivo se encarga de eliminar un elemento del carrito
    DeleteUser.php : El archivo se encarga de eliminar al usuario
    Hoteles.php : La plantilla se encarga mostrar los hoteles que hay
    Index.php : La plantilla se encarga de mostrar informacion de la aplicacion
    Lista.php : La plantilla se encarga mostrar lo que hay en la wishlist
    Login.html : La plantilla se encarga mostrar para iniciar sesion o crear cuenta
    LogIn.php : El archivo se encarga de entrar a la sesion
    LogOut.php : El archivo se encarga de salir de la cuenta que ya esta
    opinion.php : El archivo se encarga de cambiar la calificacion
    Opiniones.php : La plantilla se encarga de mostrar las opiniones que hizo el usuario
    PaginaHotel.php : La plantilla se encarga de mostrar cada uno de los hoteles
    PaginaPaquete.php : La plantilla se encarga de mostrar cada uno de los paquetes
    Paquetes.php : La plantilla se encarga de mostrar los paquetes que hay
    Perfil.php : La plantilla se encarga de mostrar la informacion del usuario
    reserva.php : El archivo se encarga de reservar hoteles
    search.php : El archivo se encarga de buscar paquetes u hoteles
    SignUp.php : El archivo se encarga de crear una cuenta
    UpgradeInfo.php : El archivo se encarga modificar la informacion del usuario
    val.php : El archivo se encarga recibir y guardar el formulario de valoracion cuando el usuario compra algo
    wishlist.php : El archivo se encarga de guarda un paquete o reserva de hotel a la wishlist