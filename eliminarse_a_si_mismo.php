<?php
require_once ("include/funciones.php");
eliminarUsuario($_POST['nick']);
session_unset();
session_destroy();

header("location:index.php");