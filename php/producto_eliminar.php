<?php 
$product_id_del = limpiar_cadena($_GET['product_id_del']);

// Verificar producto
$check_producto = conexion();
$check_producto = $check_producto->query("SELECT * FROM producto WHERE producto_id='$product_id_del'");

if ($check_producto->rowCount() == 1) {

    $datos = $check_producto->fetch();

    $eliminar_producto = conexion();
    $eliminar_producto = $eliminar_producto->prepare("DELETE FROM producto WHERE producto_id=:id");

    $eliminar_producto->execute([":id" => $product_id_del]);

    // Eliminar imagen si existe
    if (!empty($datos['producto_foto']) && is_file("./img/producto/".$datos['producto_foto'])) {
        chmod("./img/producto/".$datos['producto_foto'], 0777);
        unlink("./img/producto/".$datos['producto_foto']);
    }

    if ($eliminar_producto->rowCount() == 1) {
        echo '
            <div class="notification is-success is-light">
                <strong>¡Producto eliminado exitosamente!</strong><br>
                Los datos del producto fueron eliminados del sistema.
            </div><br>
        ';
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No se pudo eliminar el producto, por favor intente nuevamente.
            </div><br>
        ';
    }

    $eliminar_producto = null;

} else {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No se pudo eliminar el producto, por favor intente nuevamente.
        </div>
    ';
}

$check_producto = null;