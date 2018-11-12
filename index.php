<?php
    session_start();
    require_once ("include/funciones.php");

    /*Si la sesión está activa redirigimos a galeria directamente*/
    if(isset($_SESSION['nick'])){
        header('Location: galeria.php');
    }else{
        if(isset($_POST['nick'])){
            if(usuarioEsCorrecto($_POST['nick'], $_POST['contrasena']) && $_POST['contrasena'] != ""){
                $_SESSION['nick'] = $_POST['nick'];
                if(esUsuarioAdministrador($_POST['nick'])){
                    $_SESSION['admin'] = true;
                }else{
                    $_SESSION['admin'] = false;
                }
                header('Location: galeria.php');
            }
            else{
                ?>
                <spam>Usuario incorrecto</spam>
                <?php
            }
        }
    }
?>
<form action="index.php" method="post">
    Nick:<input name="nick">
    Contraseña:<input name="contrasena" type="password">
    <input type="submit" value="Entrar" >
</form>
<a href="nuevo_usuario.php">Registro nuevos usuarios</a>