<?php
require_once ("include/funciones.php");
eliminarUsuario($_POST['nick']);
header('Location: gestion_usuarios.php');