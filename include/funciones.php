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

function mostrarFormulario($esNuevoUsuario, $btnEliminar, $form_action, $nick_readonly, $nick, $nombre, $apellidos, $telefono, $direccion, $tipo){
    ?>
        <form action="<?= $form_action ?>" method="post">
            <br><br>
            <?php
                if($nick_readonly){
                    echo 'Nick:<input name="nick" value="' . $nick . '" readonly>';
                }else{
                    echo 'Nick:<input name="nick" value="' . $nick . '">';
                }
                if($esNuevoUsuario == false){
                    echo '<br><br>Antigua contraseña:<input name="antigua_contrasena" type="text">';
                }
            ?>
            <br><br>
            Contraseña:<input name="contrasena" type="text">
            <br><br>
            Confirmar contraseña:<input name="confirmar" type="text">
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
                if($btnEliminar == 'eliminar_usuario.php'){
                    ?>
                        <button  class="boton" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                        <button  class="boton" onclick="this.parentNode.action = 'eliminar_usuario.php';this.parentNode.submit()"><i class="fa fa-trash" aria-hidden="true"></i></button>

                    <?php
                }else{
                    ?>
                        <button class="boton" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                        <button class="boton"  onclick="this.parentNode.action = 'eliminarse_a_si_mismo.php';this.parentNode.submit()">Darme de baja</button>
                    <?php
                }
            ?>
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

function eliminarUsuario($nick){
    $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
    mysqli_set_charset($conexion, 'utf8');
    if ($conexion->connect_error) {
        die("La conexión ha fallado " . $conexion->connect_error);
    }
        $sql = "DELETE from usuarios WHERE nick = ?";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param('s', $nick);

    $sentencia->execute();
    $sentencia->close();
    $conexion->close();
}

/*************************************            PRODUCTOS               *******************************************/
function mostrarFormularioSubirProductos($form_action, $btn_delete, $referencia_readonly, $referencia, $titulo, $descripcion, $ruta_imagen, $precio){
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
        <?php
            if($ruta_imagen != ''){
                ?>
                    <img src="<?= $ruta_imagen ?>">
                <?php
            }else{
                ?>
                Imágen:<input type="file" name="ruta_imagen" id="prueba"  multiple="multiple" value="<?= $ruta_imagen ?>">
                <?php
            }
        ?>
        <br><br>
        Precio:<input type="number" name="precio" value="<?= $precio ?>">
        <br><br>
        <button class="boton" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        <?php
            if($btn_delete == true){
                ?>
                <button class="boton"  onclick="this.parentNode.action = 'eliminar_producto.php';this.parentNode.submit()"><i class="fa fa-trash" aria-hidden="true"></i></button>
                <?php
            }
        ?>
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

function obtenerUnSoloProducto($referencia){
    $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
    mysqli_set_charset($conexion, 'utf8');
    if($conexion->connect_error){
        die("La conexion ha fallado" . $conexion->connect_error);
    }
    $sql = "select * from productos where referencia like '$referencia'";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute();
    $resultado = $sentencia->get_result();
    $conexion->close();
    $sentencia->close();
    return $resultado;
}

function actualizarDatosProductoBBDD($referencia, $titulo, $descripcion, $precio){
    $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
    mysqli_set_charset($conexion, 'utf8');
    if ($conexion->connect_error) {
        die("La conexión ha fallado " . $conexion->connect_error);
    }
    $sql = "UPDATE productos SET referencia = ?, titulo = ?, descripcion = ?, precio = ? WHERE referencia like '$referencia'";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bind_param('sssi',$referencia, $titulo, $descripcion, $precio);
    $sentencia->execute();
    $sentencia->close();
    $conexion->close();
}

function eliminarProducto($referencia){
    $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
    mysqli_set_charset($conexion, 'utf8');
    if ($conexion->connect_error) {
        die("La conexión ha fallado " . $conexion->connect_error);
    }
    $sql = "DELETE from productos WHERE referencia = ?";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bind_param('s', $referencia);

    $sentencia->execute();
    $sentencia->close();
    $conexion->close();
}

/*************************************            CARRITO               *******************************************/
function cantidadItemsQueUnUsuarioTieneDeUnProducto($nick, $referencia){
        $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
        mysqli_set_charset($conexion, 'utf8');
        if($conexion->connect_error){
            die("La conexion ha fallado" . $conexion->connect_error);
        }
        $sql = "select cantidad from carrito where nick = ? and referencia = ?";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param('ss', $nick, $referencia);
        $sentencia->execute();
        $cantidad = $sentencia->get_result()->fetch_row()[0];
        $conexion->close();
        $sentencia->close();
        return $cantidad;
}

function guardarItemCarritoBBDD($nick, $referencia, $cantidadItems){
    $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
    mysqli_set_charset($conexion, 'utf8');
    if ($conexion->connect_error) {
        die("La conexión ha fallado " . $conexion->connect_error);
    }
    $sql = "INSERT INTO carrito (nick, referencia, cantidad) VALUES (?, ?, ?)";

    $sentencia = $conexion->prepare($sql);
    $sentencia->bind_param('ssi', $nick, $referencia, $cantidadItems);
    $sentencia->execute();

    $sentencia->close();
    $conexion->close();
}

function sumarItemEnCarrito($nick, $referencia, $cantidadItems){
    $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
    mysqli_set_charset($conexion, 'utf8');
    if ($conexion->connect_error) {
        die("La conexión ha fallado " . $conexion->connect_error);
    }
    $sql = "UPDATE carrito SET cantidad = ? WHERE nick like '$nick' and referencia like '$referencia'";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bind_param('i', $cantidadItems);
    $sentencia->execute();
    $sentencia->close();
    $conexion->close();
}

function restarItemEnCarrito($nick, $referencia, $cantidadItems){
    sumarItemEnCarrito($nick, $referencia, $cantidadItems);
}

function eliminarItemCarrito($nick, $referencia){/***************************************************************************/
    $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
    mysqli_set_charset($conexion, 'utf8');
    if ($conexion->connect_error) {
        die("La conexión ha fallado " . $conexion->connect_error);
    }
    $sql = "DELETE from carrito WHERE nick = ? and referencia = ?";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bind_param('ss', $nick, $referencia);
    $sentencia->execute();
    $sentencia->close();
    $conexion->close();
}

function itemsEnCarritoDeUsuario($nick){
    $conexion = new mysqli(DB_HOST, DB_USUARIO, DB_PASS, DB_NOMBRE_BASE_DATOS);
    mysqli_set_charset($conexion, 'utf8');
    if($conexion->connect_error){
        die("La conexion ha fallado" . $conexion->connect_error);
    }
    $sql = "select * from carrito where nick like '$nick'";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute();
    $resultado = $sentencia->get_result();
    $conexion->close();
    $sentencia->close();
    return $resultado;
}

function mostrarProductosEnCarrito($ruta_imagen, $titulo, $precio, $referencia){
    ?>
    <div class="cont-producto-carrito">
        <img src="<?= $ruta_imagen ?>"><!--ruta imagen-->
        <div>
            <h3><?= $titulo ?></h3><!--titulo-->
            <h4><?= $precio ?> €</h4><!--precio-->
        </div>
        <form action="eliminar_producto_de_carrito.php" method="post"><!--********************************  action y post  ***************************-->
            <input type="text" name="referencia" value="<?= $referencia ?>"><!--referencia-->
            <button type="submit">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
        </form>
    </div>
    <?php
}

function mostrarRecuadroListaPrecioTotalCarrito($nick){

    ?>
        <form class="cont-factura-carrito" action="finalizar_compra_carrito.php" method="post">
            <h3>Resumen de tu compra:</h3>
			<table>
				<tr>
					<th>Nombre del producto</th>
					<th>Cantidad</th>
					<th>Precio</th>
				</tr>

                <?php
                     $precio_total_carrito = 0;
                     $resultado_items_carrito = itemsEnCarritoDeUsuario($nick);
                     while($fila_carrito = $resultado_items_carrito->fetch_row()){
                         $fila_un_producto = obtenerUnSoloProducto($fila_carrito[1])->fetch_row();
                         ?>
                         <tr>
                             <td><?= $fila_un_producto[1] ?></td>
                             <td>x<?= $fila_carrito[2] ?></td>
                             <td><?= $fila_carrito[2]*$fila_un_producto[4] ?> €</td>
                         </tr>
                         <?php
                         $precio_total_carrito += $fila_carrito[2]*$fila_un_producto[4];
                     }
                ?>

			</table>
            <h2>SubTotal = <?= $precio_total_carrito ?> €</h2>
            <h2>IVA(21%) = <?= $precio_total_carrito*0.21 ?> €</h2>
			<h2>Total = <?= $precio_total_carrito+$precio_total_carrito*0.21 ?> €</h2>
            <input style="display: none" type="text" name="precio_total" value="<?= $precio_total_carrito+$precio_total_carrito*0.21 ?>">
			<button type="submit">Finalizar compra</button>
		</form>
    <?php
}