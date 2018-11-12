<?php
    require_once ("include/cabecera.php");
    require_once ("include/funciones.php");
    if(isset($_POST['nombre'])){
        actualizarDatosUsuarioBBDD($_POST['nick'], $_POST['contrasena'], $_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['direccion'], $_POST['tipo']);
        $resultado = obtenerTablaUsuarios();
        while($fila = $resultado->fetch_row()){
            mostrarFormulario(true,'gestion_usuarios.php', 'Guardar', true, $fila[0], $fila[2], $fila[3], $fila[4], $fila[5], $fila[6]);
        }
    }else{
        $resultado = obtenerTablaUsuarios();
        while($fila = $resultado->fetch_row()){
            mostrarFormulario(true,'gestion_usuarios.php', 'Guardar', true, $fila[0], $fila[2], $fila[3], $fila[4], $fila[5], $fila[6]);
        }
    }
