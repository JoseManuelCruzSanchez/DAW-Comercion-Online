<?php
    require_once ("include/cabecera.php");
    require_once ("include/funciones.php");
if($_SESSION['admin'] == true){
    if(isset($_POST['referencia'])){
        if($_POST['referencia'] == '' || $_POST['titulo'] == '' || $_POST['descripcion'] == '' || $_POST['precio'] == ''){
            $archivo = (isset($_FILES['ruta_imagen'])) ? $_FILES['ruta_imagen'] : null;
            mostrarFormularioSubirProductos('subir_productos.php', false, false, $_POST['referencia'], $_POST['titulo'], $_POST['descripcion'], '', $_POST['precio']);
        }else{
            /*Creo la carpeta que contendra las imagenes. Una carpeta por cada producto segun la referencia*/
            if(!is_dir('imagenes/' . $_POST['referencia'])){
                mkdir('imagenes/' . $_POST['referencia']);
            }
            $referencia = $_POST['referencia'];
            /*OJO: EL FORMULARIO TIENE QUE TENER EL ATRIBUTO enctype="multipart/form-data"*/
            $archivo = (isset($_FILES['ruta_imagen'])) ? $_FILES['ruta_imagen'] : null;
            if ($archivo) {
                $ruta_destino_archivo = "imagenes/$referencia/{$archivo['name']}";
                $archivo_ok = move_uploaded_file($archivo['tmp_name'], $ruta_destino_archivo);
            }
            guardarProductoBBDD($_POST['referencia'],$_POST['titulo'],$_POST['descripcion'], $ruta_destino_archivo, $_POST['precio']);
        }
    }else{
        mostrarFormularioSubirProductos('subir_productos.php', false, false, '', '', '', '', '');
    }
}else{
    
}


