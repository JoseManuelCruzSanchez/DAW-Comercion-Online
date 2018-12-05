
<?php
    require_once ('../include/hojas_estilos.php');
    require_once("../include/funciones.php");
    if(isset($_POST['nick']) && isset($_POST['contrasena']) && isset($_POST['nombre']) && isset($_POST['apellidos']) &&
        isset($_POST['telefono']) && isset($_POST['direccion'])){
        /*Si algun campo está vacio lo devuelvo a la misma página pero con los input que estaban rellenos*/
        if($_POST['nick'] == '' || $_POST['contrasena'] == '' || $_POST['nombre'] == '' || $_POST['apellidos'] == '' ||
            $_POST['telefono'] == '' || $_POST['direccion'] == ''){
            echo '<span>Todos los campos son obligatorios!</span>';
            mostrarFormulario(true, false,'nuevo_usuario.php',  false, $_POST['nick'], $_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['direccion'],'');
        }else{/*Comprobamos que no exista un usuario con el mismo nick si todos los campos están rellenos*/
            if(existeUsuarioConMismoNick($_POST['nick'])){
                echo '<span>Ya existe un usuario con el mismo nick, utiliza otro diferente!</span>';
                mostrarFormulario(true, false,'nuevo_usuario.php',  false, $_POST['nick'], $_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['direccion'],'');
            }else if($_POST['contrasena'] != $_POST['confirmar']){
                echo '<span>Parece que las contraseñas son incorrectas!</span>';
                mostrarFormulario(true, false,'nuevo_usuario.php',  false, $_POST['nick'], $_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['direccion'],'');
            }else{
                guardarUsuarioBBDD($_POST['nick'], $_POST['contrasena'], $_POST['nombre'], $_POST['apellidos'], $_POST['telefono'], $_POST['direccion'], 'cliente');
                header('location: ../index.php');
            }
        }
    }else{
        echo '<a href="../index.php"><button class="boton"><i class="fa fa-arrow-left"></i></button></a>';
        /*Este formulario aparece la primera vez que llegamos a la página*/
        mostrarFormulario(true, false,'nuevo_usuario.php',  false,"", "", "", "", "", "");
    }
?>
