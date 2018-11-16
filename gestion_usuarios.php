<?php
    require_once ("include/cabecera.php");
    require_once ("include/funciones.php");
    if($_SESSION['admin'] == true){
        if(isset($_POST['nombre'])){
            if($_POST['contrasena'] == ''){/*Si deja el campo contraseña en blanco el admin*/
                actualizarDatosUsuarioBBDD($_POST['nick'], obtenerDatosUsuarios($_POST['nick'])->fetch_row()[1], $_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['direccion'], $_POST['tipo']);
            }else{
                actualizarDatosUsuarioBBDD($_POST['nick'], $_POST['contrasena'], $_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['direccion'], $_POST['tipo']);
            }

            $resultado = obtenerTablaUsuarios();
            while($fila = $resultado->fetch_row()){
                mostrarFormulario(true, true,'gestion_usuarios.php',  true, $fila[0], $fila[2], $fila[3], $fila[4], $fila[5], $fila[6]);
            }
        }else{
            $resultado = obtenerTablaUsuarios();
            while($fila = $resultado->fetch_row()){
                mostrarFormulario(true, true,'gestion_usuarios.php',  true, $fila[0], $fila[2], $fila[3], $fila[4], $fila[5], $fila[6]);
            }
        }
    }else{
        header('location: index.php');
    }

