<?php
    require_once ("include/cabecera.php");
    require_once ("include/funciones.php");
    echo '<br><br>';

    $_SESSION['carrito'] = Array();
    //var_dump(count($_SESSION['carrito']));


    $resultado = obtenerTablaProductos();
    while($fila = $resultado->fetch_row()){
        ?>
        <div class="card">
            <div class="thumbnail">
                <img class="left" src="<?= $fila[3] ?>"/>
            </div>
            <div class="right">
                <h1><?= $fila[1] ?></h1>
                <div class="author">
                    <h2>Ref: <?= $fila[0] ?></h2>
                </div>
                <div class="separator"></div>
                <p><?= $fila[2] ?></p>
            </div>
            <h5><?= $fila[4] ?> €</h5>
            <div class="fab" onclick="location.href='carrito.php?referencia=<?= $fila[0] ?>'"><i class="fa fa-cart-plus fa-3x"> </i></div>
        </div>
        <br>
        <?php
    }
?>