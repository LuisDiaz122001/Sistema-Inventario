<div class="container is-fluid mb-6">
    <h1 class="title">Productos</h1>
    <h2 class="subtitle">Lista de productos por categoría</h2>
</div>
<div class="container pb-6 pt-6">
    <?php require_once "./php/main.php"; ?>
<div class="columns is-variable is-5">
    <!-- COLUMNA IZQUIERDA -->
    <div class="column is-narrow">
        <h2 class="title has-text-centered mb-4">Categorías</h2>
        <div class="buttons is-flex is-flex-direction-column" style="gap: 10px;">
            <?php
            $categorias = conexion();
            $categorias = $categorias->query("SELECT * FROM categoria");
            if($categorias->rowCount()>0){
                $categorias = $categorias->fetchAll();
                foreach($categorias as $row){
                    echo '<a href="index.php?vista=product_category&categoria_id='.$row['categoria_id'].'" 
                    class="button is-link is-inverted is-fullwidth">'
                    .$row['categoria_nombre'].
                    '</a>';
                }
            }else{
                echo '<p class="has-text-centered">No hay categorías registradas</p>';
            }
            $categorias = null;
            ?>
        </div>
    </div>
    <!-- COLUMNA DERECHA -->
    <div class="column">
        <?php
        $categoria_id = (isset($_GET['categoria_id'])) ? $_GET['categoria_id'] : 0;
        $categoria = conexion();
        $categoria = $categoria->query("SELECT * FROM categoria WHERE categoria_id='$categoria_id'");
        if($categoria->rowCount()>0){
            $categoria = $categoria->fetch();
            echo '
            <h2 class="title has-text-centered">'.$categoria['categoria_nombre'].'</h2>
            <p class="has-text-centered pb-6">'.$categoria['categoria_ubicacion'].'</p>
            ';
            if (isset($_GET['product_id_del'])) {
                require_once "./php/producto_eliminar.php";
            }
            $pagina = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            if ($pagina <= 1) { $pagina = 1; }
            $pagina = limpiar_cadena($pagina);
            $url = "index.php?vista=product_category&categoria_id=$categoria_id&page=";
            $registros = 5;
            $busqueda = "";
            require_once "./php/producto_lista.php";
        }else{
            echo '<h2 class="has-text-centered title">Seleccione una categoría para empezar</h2>';
        }
        $categoria = null;
        ?>
    </div>
</div>
</div>