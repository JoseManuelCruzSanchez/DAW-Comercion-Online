<?php
    require_once ("include/funciones.php");
    session_start();
    /*Si la sesión está activa redirigimos a galeria directamente*/
    if(isset($_SESSION['nick'])){
        header('Location: web_vistas/galeria.php');
    }else{
        if(isset($_POST['nick'])){
            if(usuarioEsCorrecto($_POST['nick'], $_POST['contrasena']) && $_POST['contrasena'] != ""){
                $_SESSION['nick'] = $_POST['nick'];
                if(esUsuarioAdministrador($_POST['nick'])){
                    $_SESSION['admin'] = true;
                }else{
                    $_SESSION['admin'] = false;
                }
                header('Location: web_vistas/galeria.php');
            }
            else{
                echo "<spam>Usuario incorrecto</spam>";
            }
        }
    }
    require_once ('web_html/formulario_index.php');
?>
