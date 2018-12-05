<?php
require_once("../include/cabecera.php");
require_once("../include/funciones.php");
/*Si el producto viene desde galeria añadido por el usuario*/
if(isset($_GET['referencia'])){
    /*Si es el primer item de una referencia dada, lo guarda en la BBDD, sino suma +1 en la columna cantidad de carrito*/
    if(intval(cantidadItemsQueUnUsuarioTieneDeUnProducto($_SESSION['nick'], $_GET['referencia'])) == 0){
        guardarItemCarritoBBDD($_SESSION['nick'], $_GET['referencia'], 1);
    }else{
        sumarItemEnCarrito($_SESSION['nick'], $_GET['referencia'], intval(cantidadItemsQueUnUsuarioTieneDeUnProducto($_SESSION['nick'], $_GET['referencia']))+1);
    }
    header("Location: galeria.php");
}else{/*Si el usuario entra directamente a carrito a traves del enlace en el menu*/
    $resultado = itemsEnCarritoDeUsuario($_SESSION['nick']);
    echo '<div class="cont-general-carrito">';
    mostrarRecuadroListaPrecioTotalCarrito($_SESSION['nick']);
    while ($fila = $resultado->fetch_row()){
        $fila_resultado_producto = obtenerUnSoloProducto($fila[1])->fetch_row();
        for($i = 0; $i < $fila[2]; $i++){
            mostrarProductosEnCarrito($fila_resultado_producto[3], $fila_resultado_producto[1], $fila_resultado_producto[4], $fila_resultado_producto[0]);
        }
    }
    echo '</div>';
}



