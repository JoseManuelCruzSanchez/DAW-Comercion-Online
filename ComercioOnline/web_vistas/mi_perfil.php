<?php
    require_once("../include/cabecera.php");
    require_once("../include/funciones.php");

    $fila = obtenerDatosUsuarios($_SESSION['nick'])->fetch_row();
    /*La primera vez se irá al else para mostrar los datos del usuario*/
    if(isset($_POST['nick'])){
        /*Si algun campo está vacio lo devuelvo a la misma página pero con los input que estaban rellenos*/
        if($_POST['nick'] == '' /*|| $_POST['contrasena'] == '' */|| $_POST['nombre'] == '' || $_POST['apellidos'] == '' ||
            $_POST['telefono'] == '' || $_POST['direccion'] == ''){
            echo '<span>Ups! Parece que has dejado algún campo en blanco.</span>';
            mostrarFormulario(false,'mi_perfil.php', 'mi_perfil.php', false, $_POST['nick'], $_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['direccion'], '');
        /*Las contraseñas no coinciden*/
        }else if($_POST['contrasena'] != $_POST['confirmar']){
            echo '<span>Parece que las contraseñas son incorrectas!</span>';
            mostrarFormulario(false,'mi_perfil.php', 'mi_perfil.php', false, $_POST['nick'], $_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['direccion'], '');
        /*Insertamos los nuevos datos en la BBDD*/
        }else{
            /*Si hubo cambios en las contraseñas los miramos y guardamos*/
            if($_POST['antigua_contrasena'] == $fila[1] && $_POST['contrasena'] != ''){
                actualizarDatosUsuarioBBDD($_POST['nick'], $_POST['contrasena'], $_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['direccion'], '');
                header("location: ../index.php");
            }else if($_POST['antigua_contrasena'] != $fila[1] && $_POST['antigua_contrasena'] != ''){/*Si la contraseña antigua es incoreecta*/
                echo '<span>Parece que las contraseñas son incorrectas!</span>';
                mostrarFormulario(false,'mi_perfil.php', 'mi_perfil.php', true, $fila[0], $fila[2], $fila[3], $fila[4], $fila[5], '');
            }else{
                /*Si no hay modificaciones en las contraseñas actualizamos en BBDD la nueva informacion*/
                actualizarDatosUsuarioBBDD($_POST['nick'], $fila[1], $_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['direccion'], '');
                header("location: ../index.php");
            }
        }
    /*Va a la BBDD y muestra los datos del usuario*/
    }else{
        mostrarFormulario(false,'mi_perfil.php', 'mi_perfil.php', true, $fila[0], $fila[2], $fila[3], $fila[4], $fila[5], '');
    }

?>