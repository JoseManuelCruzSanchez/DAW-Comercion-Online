<?php
require_once('../include/funciones.php');

session_start();
if(isset($_POST['referencia'])){
    $cantidad_items = cantidadItemsQueUnUsuarioTieneDeUnProducto($_SESSION['nick'], $_POST['referencia']);
    if($cantidad_items < 2){
        eliminarItemCarrito($_SESSION['nick'], $_POST['referencia']);
    }else{
        restarItemEnCarrito($_SESSION['nick'], $_POST['referencia'], $cantidad_items -1);
    }
    header('location: ../web_vistas/carrito.php');
}