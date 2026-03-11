<div class="main-container is-flex is-justify-content-center is-align-items-center">
    <form class="box login-card" action="" method="POST" autocomplete="off">
        <div class="top-line"></div>
        <h5 class="title is-5 has-text-centered has-text-white is-uppercase">
            Sistema de Inventario
        </h5>
        <div class="field">
            <label class="label has-text-white">Usuario</label>
            <div class="control">
                <input
                    class="input custom-input"
                    type="text"
                    name="login_usuario"
                    pattern="[a-zA-Z0-9]{4,20}"
                    maxlength="20"
                    required>
            </div>
        </div>
        <div class="field">
            <label class="label has-text-white">Contraseña</label>
            <div class="control has-icons-right">
                <input
                    class="input custom-input"
                    type="password"
                    name="login_clave"
                    pattern="[a-zA-Z0-9$@.-]{7,100}"
                    maxlength="100"
                    required>
                <span class="icon is-small is-right has-text-grey">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
        </div>
        <div class="has-text-centered mt-5">
            <button type="submit" class="button button-login is-fullwidth">
                Iniciar Sesión
            </button>
        </div>
        <?php
            if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
                require_once "./php/main.php";
                require_once "./php/iniciar_sesion.php";
            }
        ?>
    </form>
</div>