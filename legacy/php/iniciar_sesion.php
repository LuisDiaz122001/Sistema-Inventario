<?php
    #almacenando datos
    $usuario=limpiar_cadena($_POST['login_usuario']);
    $clave=limpiar_cadena($_POST['login_clave']);

    #verificando campos obligatorios
    if($usuario=="" || $clave==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    #verificando integridad de los datos
    if(verificar_datos("[a-zA-Z0-9]{4,20}",$usuario)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El USUARIO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                La CONTRASEÑA no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    $check_usuario=conexion();
    $check_usuario=$check_usuario->query("SELECT * FROM usuario WHERE usuario_usuario='$usuario'");
    if($check_usuario->rowCount()==1){
        $datos=$check_usuario->fetch();
        if($datos['usuario_usuario']==$usuario && password_verify($clave, $datos['usuario_clave'])){
            $_SESSION['id']=$datos['usuario_id'];
            $_SESSION['nombre']=$datos['usuario_nombre'];
            $_SESSION['apellido']=$datos['usuario_apellido'];
            $_SESSION['usuario']=$datos['usuario_usuario'];

            if(headers_sent()){
                echo "<script> window.location.href='index.php?vista=home'; </script>";
            }else{
                header("Location: index.php?vista=home");
            }
            echo '
                <div class="notification is-info is-light">
                    <strong>¡BIENVENIDO!</strong><br>
                    Iniciando sesión...
                </div>
            ';
            echo '<meta http-equiv="refresh" content="2; url=index.php">';
        }else{
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    La CONTRASEÑA es incorrecta
                </div>
            ';
        }
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El USUARIO no existe
            </div>
        ';
    }
    $check_usuario=null;