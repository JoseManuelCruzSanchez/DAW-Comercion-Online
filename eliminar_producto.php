<?php
require_once ("include/funciones.php");

/*Elimina el producto solo de la base de datos*/
eliminarProducto($_POST['referencia']);

/*Eliminamos el directorio con las imagenes del producto eliminado*/
if(is_dir('imagenes/' . $_POST['referencia'])){

    /*Para borrar todos los archivos en un directorio y que no de error*/
    array_map('unlink', glob('imagenes/' . $_POST['referencia'] . '/*.*'));
    rmdir('imagenes/' . $_POST['referencia']);
}