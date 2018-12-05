<?php
    session_start();
    /************************************   INICIO TIEMPO DE SESION     ***********************************************/
    /******************************************************************************************************************/
    if (!isset($_SESSION['tiempo'])) {
        $_SESSION['tiempo']=time();
    }
    else if (time() - $_SESSION['tiempo'] > 120) {
        session_destroy();
        /* Aquí redireccionas a la url especifica */
        header("Location: ../index.php");
        die();
    }
    $_SESSION['tiempo']=time(); //Si hay actividad reseteamos el valor al tiempo actual
    /************************************   FIN TIEMPO DE SESION     **************************************************/
    /******************************************************************************************************************/

    /*Si intenta acceder sin estar logueado lo redirigimos a index.php*/
    if(!isset($_SESSION['nick'])){
        header('location: ../index.php');
    }
    /*Si es usuario administrador, mostramos los botones a gestionar_productos y gestionar_usuarios*/
    if($_SESSION['admin'] == true){
        require_once("../web_html/head_and_doctype.php");
        require_once ("menu_admin.php");
    }else{
        require_once("../web_html/head_and_doctype.php");
        require_once ("menu_cliente.php");
    }
?>
