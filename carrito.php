<?php
require_once ("include/cabecera.php");
require_once ("include/funciones.php");
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
    while ($fila = $resultado->fetch_row()){
        echo '<br>';
        echo $fila[1] . ' ' . $fila[2];
    }
}



