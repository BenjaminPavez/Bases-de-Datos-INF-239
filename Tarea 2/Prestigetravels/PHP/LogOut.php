<?php
/*
El archivo se encarga de quitar la sesion que actualmente esta

*/

//Datos usuario
session_start();

//Se destruyen los datos usuario
session_destroy();

header("Location: Login.html");
exit;