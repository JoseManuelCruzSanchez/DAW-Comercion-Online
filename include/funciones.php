<?php

require_once("configuracion.php");

function usuarioEsCorrecto($nick, $contrasena){
    $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
    mysqli_set_charset($conexion, 'utf8');
    if($conexion->connect_error){
        die("La conexion ha fallado" . $conexion->connect_error);
    }
    $sql = "select contrasena from usuarios where nick like '$nick'";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute();
    $resultado = $sentencia->get_result();
    if($resultado->fetch_row()[0] == $contrasena){
        $sentencia->close();
        $conexion->close();
        return true;
    }
    $sentencia->close();
    $conexion->close();
    return false;
}

function mostrarFormulario($form_action, $btn_value, $nick_readonly, $nick, $contrasena, $confirmar, $nombre, $apellidos, $telefono, $direccion, $tipo){
    ?>
        <form action="<?= $form_action ?>" method="post">
            <br><br>
            <?php
                if($nick_readonly == true){
                    echo 'Nick:<input name="nick" value="' . $nick . '" readonly>';
                }else{
                    echo 'Nick:<input name="nick" value="' . $nick . '">';
                }
            ?>
            <br><br>
            Contraseña:<input name="contrasena" type="password" value="<?= $contrasena ?>">
            <br><br>
            Confirmar contraseña:<input name="confirmar" type="password" value="<?= $confirmar ?>">
            <br><br>
            Nombre:<input name="nombre" value="<?= $nombre ?>">
            <br><br>
            Apellidos:<input name="apellidos" value="<?= $apellidos ?>">
            <br><br>
            Teléfono:<input name="telefono" value="<?= $telefono ?>">
            <br><br>
            Dirección:<input name="direccion" value="<?= $direccion ?>">
            <br><br>
            <?php
                if($tipo != ''){/*En caso de que se haya pasado datos por esta variable*/
                    ?>
                        Tipo:<select name="tipo">
                    <?php
                        if($tipo == 'cliente'){
                            echo '<option value="admin">Admin</option>';
                            echo '<option value="cliente" selected>Cliente</option>';
                        }else{
                            echo '<option value="admin" selected>Admin</option>';
                            echo '<option value="cliente">Cliente</option>';
                        }
                    ?>
                        </select>
                        <br><br>
                    <?php
                }
            ?>
            <input type="submit" value="<?= $btn_value ?>" >
        </form>
    <?php
}

function existeUsuarioConMismoNick($nick){
    $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
    mysqli_set_charset($conexion, 'utf8');
    if($conexion->connect_error){
        die("La conexion ha fallado" . $conexion->connect_error);
    }
    $sql = "select count(*) from usuarios where nick like '$nick'";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute();
    $resultado = $sentencia->get_result();
    if($resultado->fetch_row()[0] == 1){
        $sentencia->close();
        $conexion->close();
        return true;
    }
    $sentencia->close();
    $conexion->close();
    return false;
}

function guardarUsuarioBBDD($nick, $contrasena, $nombre, $apellidos, $telefono, $direccion, $tipo){
    $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
    mysqli_set_charset($conexion, 'utf8');
    if ($conexion->connect_error) {
        die("La conexión ha fallado " . $conexion->connect_error);
    }
    $sql = "INSERT INTO usuarios (nick, contrasena, nombre, apellidos, telefono, direccion, tipo) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $sentencia = $conexion->prepare($sql);
    $sentencia->bind_param('sssssss',$nick, $contrasena, $nombre, $apellidos, $telefono, $direccion, $tipo);
    $sentencia->execute();

    $sentencia->close();
    $conexion->close();
}

function esUsuarioAdministrador($nick){
    $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
    mysqli_set_charset($conexion, 'utf8');
    if($conexion->connect_error){
        die("La conexion ha fallado" . $conexion->connect_error);
    }
    $sql = "select tipo from usuarios where nick like '$nick'";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute();
    $resultado = $sentencia->get_result();
    if($resultado->fetch_row()[0] == 'admin'){
        $sentencia->close();
        $conexion->close();
        return true;
    }
    $sentencia->close();
    $conexion->close();
    return false;
}

function obtenerDatosUsuarios($nick){
        $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
        mysqli_set_charset($conexion, 'utf8');
        if($conexion->connect_error){
            die("La conexion ha fallado" . $conexion->connect_error);
        }
        $sql = "select * from usuarios where nick like '$nick'";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $conexion->close();
        $sentencia->close();
        return $resultado;
}

function obtenerTablaUsuarios(){
    $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
    mysqli_set_charset($conexion, 'utf8');
    if($conexion->connect_error){
        die("La conexion ha fallado" . $conexion->connect_error);
    }
    $sql = "select * from usuarios";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute();
    $resultado = $sentencia->get_result();
    $conexion->close();
    $sentencia->close();
    return $resultado;
}

function actualizarDatosUsuarioBBDD($nick, $contrasena, $nombre, $apellidos, $telefono, $direccion, $tipo){
    $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
    mysqli_set_charset($conexion, 'utf8');
    if ($conexion->connect_error) {
        die("La conexión ha fallado " . $conexion->connect_error);
    }
    if($tipo == ''){
        $sql = "UPDATE usuarios SET nick = ?, contrasena = ?, nombre = ?, apellidos = ?, telefono = ?, direccion = ? WHERE nick like '$nick'";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param('ssssss',$nick, $contrasena, $nombre, $apellidos, $telefono, $direccion);
    }else{
        $sql = "UPDATE usuarios SET nick = ?, contrasena = ?, nombre = ?, apellidos = ?, telefono = ?, direccion = ?, tipo = ? WHERE nick like '$nick'";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param('sssssss',$nick, $contrasena, $nombre, $apellidos, $telefono, $direccion, $tipo);
    }
    $sentencia->execute();
    $sentencia->close();
    $conexion->close();
}

/*************************************            PRODUCTOS               *******************************************/
function mostrarFormularioSubirProductos($form_action, $btn_value, $referencia_readonly, $referencia, $titulo, $descripcion, $ruta_imagen, $precio){
    ?>
    <form action="<?= $form_action ?>" method="post"  enctype="multipart/form-data">
        <br><br>
        <?php
        if($referencia_readonly == true){
            echo 'Referencia:<input name="referencia" value="' . $referencia . '" readonly>';
        }else{
            echo 'Referencia:<input name="referencia" value="' . $referencia . '">';
        }
        ?>
        <br><br>
        Título:<input name="titulo" value="<?= $titulo ?>">
        <br><br>
        Descripción:<input name="descripcion" value="<?= $descripcion ?>">
        <br><br>
        Imágen:<input type="file" name="ruta_imagen" id="prueba"  multiple="multiple" value="<?= $ruta_imagen ?>">
        <br><br>
        Precio:<input type="number" name="precio" value="<?= $precio ?>">
        <br><br>
        <input type="submit" value="<?= $btn_value ?>" >
    </form>
    <?php
}

function guardarProductoBBDD($referencia, $titulo, $descripcion, $ruta_imagen, $precio){
    $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
    mysqli_set_charset($conexion, 'utf8');
    if ($conexion->connect_error) {
        die("La conexión ha fallado " . $conexion->connect_error);
    }
    $sql = "INSERT INTO productos (referencia, titulo, descripcion, ruta_imagen, precio) VALUES (?, ?, ?, ?, ?)";

    $sentencia = $conexion->prepare($sql);
    $sentencia->bind_param('ssssi', $referencia, $titulo, $descripcion, $ruta_imagen, $precio);
    $sentencia->execute();

    $sentencia->close();
    $conexion->close();
}



/*************************************            GALERIA               *******************************************/
function obtenerTablaProductos(){
    $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
    mysqli_set_charset($conexion, 'utf8');
    if($conexion->connect_error){
        die("La conexion ha fallado" . $conexion->connect_error);
    }
    $sql = "select * from productos";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute();
    $resultado = $sentencia->get_result();
    $conexion->close();
    $sentencia->close();
    return $resultado;
}