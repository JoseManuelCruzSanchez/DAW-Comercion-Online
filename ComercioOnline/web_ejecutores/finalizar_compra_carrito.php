<?php
require_once('../include/funciones.php');
session_start();
if(isset($_POST['precio_total'])){
    guardarFacturaHistoricos($_SESSION['nick'], $_POST['precio_total']);
    /*Reseteo el carrito en factura, despues de que la vea el pollo*/
}
header('location: ../web_vistas/factura.php');