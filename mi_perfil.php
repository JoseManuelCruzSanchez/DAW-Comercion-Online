<?php
    require_once ("include/funciones.php");
    session_start();
    if($_SESSION['admin'] == true){
        require_once ("include/menu_admin.php");
    }else{
        require_once ("include/menu_cliente.php");
    }
    if(isset($_POST['nick'])){
        /*Si algun campo está vacio lo devuelvo a la misma página pero con los input que estaban rellenos*/
        if($_POST['nick'] == '' || $_POST['contrasena'] == '' || $_POST['nombre'] == '' || $_POST['apellidos'] == '' ||
            $_POST['telefono'] == '' || $_POST['direccion'] == ''){
            echo '<span>Ups! Parece que has dejado algún campo en blanco.</span>';
            mostrarFormulario('mi_perfil.php', 'Guardar', false, $_POST['nick'], $_POST['contrasena'], $_POST['confirmar'], $_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['direccion'], '');
        }else if($_POST['contrasena'] != $_POST['confirmar']){
            echo '<span>Parece que las contraseñas son incorrectas!</span>';
            mostrarFormulario('mi_perfil.php', 'Guardar', false, $_POST['nick'], $_POST['contrasena'], $_POST['confirmar'], $_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['direccion'], '');
        }else{
            actualizarDatosUsuarioBBDD($_POST['nick'], $_POST['contrasena'], $_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['direccion'], '');
            header("location: index.php");
        }
    }else{
        $fila = obtenerDatosUsuarios($_SESSION['nick'])->fetch_row();
        mostrarFormulario('mi_perfil.php', 'Guardar', true, $fila[0], $fila[1], $fila[1], $fila[2], $fila[3], $fila[4], $fila[5], '');
    }

?>