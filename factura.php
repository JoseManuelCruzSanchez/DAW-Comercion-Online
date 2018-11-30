<?php
require_once ('include/funciones.php');
require_once ('include/cabecera.php');

mostrarFactura($_SESSION['nick']);
resetearCarritoDeUsuario($_SESSION['nick']);