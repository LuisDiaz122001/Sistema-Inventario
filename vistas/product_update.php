<div class="container is-fluid mb-6">
    <h1 class="title">Productos</h1>
    <h2 class="subtitle">Actualizar producto</h2>
</div>

<div class="container pb-6 pt-6">

    <p class="has-text-right pt-4 pb-4">
        <a href="#" class="button is-link is-rounded btn-back"><- Regresar atrás</a>
    </p>
    <script type="text/javascript">
        let btn_back = document.querySelector(".btn-back");

        btn_back.addEventListener('click', function(e) {
            e.preventDefault();
            window.history.back();
        });
    </script>



    <div class="form-rest mb-6 mt-6"></div>

    <h2 class="title has-text-centered">Nombre de producto</h2>

    <form action="" method="POST" class="FormularioAjax" autocomplete="off">

        <input type="hidden" name="producto_id" required>

        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Código de barra</label>
                    <input class="input" type="text" name="producto_codigo" pattern="[a-zA-Z0-9- ]{1,70}" maxlength="70" required>
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Nombre</label>
                    <input class="input" type="text" name="producto_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="70" required>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Precio</label>
                    <input class="input" type="text" name="producto_precio" pattern="[0-9.]{1,25}" maxlength="25" required>
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Stock</label>
                    <input class="input" type="text" name="producto_stock" pattern="[0-9]{1,25}" maxlength="25" required>
                </div>
            </div>
            <div class="column">
                <label>Categoría</label><br>
                <div class="select is-rounded">
                    <select name="producto_categoria">
                        <option value="1" selected="">Nombre de categoria (Actual)</option>
                        <option value="1">Nombre de categoria</option>
                    </select>
                </div>
            </div>
        </div>
        <p class="has-text-centered">
            <button type="submit" class="button is-success is-rounded">Actualizar</button>
        </p>
    </form>



    <div class="notification is-danger is-light mb-6 mt-6">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        No podemos obtener la información solicitada
    </div>
    
</div>