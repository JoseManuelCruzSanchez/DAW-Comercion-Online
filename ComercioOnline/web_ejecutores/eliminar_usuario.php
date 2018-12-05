<?php
require_once("../include/funciones.php");
eliminarUsuario($_POST['nick']);
header('Location: ../web_vistas/gestion_usuarios.php');