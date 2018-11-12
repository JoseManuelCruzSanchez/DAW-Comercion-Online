<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>xxxxxxxx</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="css/estilos_productos.css">
</head>

<?php
    session_start();
    /*Si intenta acceder sin estar logueado lo redirigimos a index.php*/
    if(!isset($_SESSION['nick'])){
        header('location: index.php');
    }
    /*Si es usuario administrador, mostramos los botones a gestionar_productos y gestionar_usuarios*/
    if($_SESSION['admin'] == true){
        require_once ("menu_admin.php");
    }else{
        require_once ("menu_cliente.php");
    }
?>
