<?php
    require_once ("include/cabecera.php");
    require_once ("include/funciones.php");
if($_SESSION['admin'] == true){
    if(!isset($_POST['titulo'])){
        $resultado = obtenerTablaProductos();
        while ($fila = $resultado->fetch_row()){
            mostrarFormularioSubirProductos('gestion_productos.php', true, true, $fila[0], $fila[1], $fila[2], $fila[3], $fila[4]);
        }
    }else{/*Guardar cambios si los hay*/
        actualizarDatosProductoBBDD($_POST['referencia'], $_POST['titulo'], $_POST['descripcion'], $_POST['precio']);
        header('Location: gestion_productos.php');
    }
}else{
    header('location: index.php');
}

