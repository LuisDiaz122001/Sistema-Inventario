<?php
    $category_id_del=limpiar_cadena($_GET['category_id_del']);

    // Verificar categoría
    $check_categoria=conexion();
    $check_categoria=$check_categoria->query("SELECT categoria_id FROM categoria WHERE categoria_id='$category_id_del'");

    if ($check_categoria->rowCount()==1) {

        // Verificar productos
        $check_productos=conexion();
        $check_productos=$check_productos->query("SELECT categoria_id FROM producto WHERE categoria_id='$category_id_del' LIMIT 1");

        if ($check_productos->rowCount()<=0) {

        // Eliminar categoría
            $eliminar_categoria=conexion();
            $eliminar_categoria=$eliminar_categoria->prepare("DELETE FROM categoria WHERE categoria_id=:id");
            $eliminar_categoria->execute([":id"=>$category_id_del]);
            
            if ($eliminar_categoria->rowCount()==1) {
                echo '
                    <div class="notification is-success is-light">
                        <strong>¡Categoría eliminada exitosamente!</strong><br>
                        La categoría fue eliminada del sistema.
                    </div>
                ';
            } else {
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrió un error inesperado!</strong><br>
                        No se pudo eliminar la categoría, por favor intente nuevamente.
                    </div>
                ';
            }
            $eliminar_categoria=null;
        } else {
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    No se puede eliminar la categoría porque tiene productos registrados en el sistema.
                </div>
            ';
        }
        $check_productos=null;

    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No se pudo eliminar la categoría, por favor intente nuevamente.
            </div>
        ';
    }
    $check_categoria=null;