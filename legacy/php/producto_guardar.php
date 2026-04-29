<?php
    require_once "../inc/session_start.php";
    require_once "main.php";
    
    # Almacenando datos
    $codigo=limpiar_cadena($_POST['producto_codigo']);
    $nombre=limpiar_cadena($_POST['producto_nombre']);
    $precio=limpiar_cadena($_POST['producto_precio']);
    $stock=limpiar_cadena($_POST['producto_stock']);
    $categoria=limpiar_cadena($_POST['producto_categoria']);

    #verificando campos obligatorios
    if($codigo=="" || $nombre=="" || $precio=="" || $stock=="" || $categoria==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    #verificando integridad de los datos
    if(verificar_datos("[a-zA-Z0-9- ]{1,70}",$codigo)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El codigo de barra no coincide con el formato solicitado.
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{3,40}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El nombre del producto no coincide con el formato solicitado.
            </div>
        ';
        exit();
    }

    if(verificar_datos("[0-9.]{1,25}",$precio)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El precio del producto no coincide con el formato solicitado.
            </div>
        ';
        exit();
    }

    if(verificar_datos("[0-9]{1,25}",$stock)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El stock del producto no coincide con el formato solicitado.
            </div>
        ';
        exit();
    }

    #verificando codigo de barra
    $check_codigo=conexion();
    $check_codigo=$check_codigo->query("SELECT producto_codigo FROM producto WHERE producto_codigo='$codigo'");
    if($check_codigo->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El código de barra ingresado ya se encuentra registrado, por favor elige otro.
            </div>
        ';
        exit();
    }
    $check_codigo=null;

    #verificando nombre del producto
    $check_nombre=conexion();
    $check_nombre=$check_nombre->query("SELECT producto_nombre FROM producto WHERE producto_nombre='$nombre'");
    if($check_nombre->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El nombre del producto ingresado ya se encuentra registrado, por favor elige otro.
            </div>
        ';
        exit();
    }
    $check_nombre=null;

    #verificando categoría
    $check_categoria=conexion();
    $check_categoria=$check_categoria->query("SELECT categoria_id FROM categoria WHERE categoria_id='$categoria'");
    if($check_categoria->rowCount()<=0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                La categoría ingresada no existe, por favor elige otra.
            </div>
        ';
        exit();
    }
    $check_categoria=null;

    # Directorio de almacenamiento de las imágenes de los productos
    $img_dir="../img/producto/";

    #verificando si se ha seleccionado una imagen
    if($_FILES['producto_foto']['name']!="" && $_FILES['producto_foto']['size']>0){

        # Creando directorio de almacenamiento de las imágenes de los productos
        if(!file_exists($img_dir)){
            if (!mkdir($img_dir, 0777)) {
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrió un error inesperado!</strong><br>
                        No se pudo crear el directorio de almacenamiento de las imágenes de los productos, por favor intente nuevamente.
                    </div>
                ';
                exit();
            }
        }

        # Verificando el formato de la imagen
        if(mime_content_type($_FILES['producto_foto']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['producto_foto']['tmp_name'])!="image/png"){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    La imagen seleccionada no tiene un formato permitido, por favor seleccione una imagen con formato JPG, JPEG o PNG.
                </div>
            ';
            exit();
        }

        # Verificando el tamaño de la imagen
        if(($_FILES['producto_foto']['size']/1024)>3072){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    La imagen seleccionada supera el límite de peso permitido, por favor seleccione una imagen que no supere los 3MB.
                </div>
            ';
            exit();
        }

        # Extensión de la imagen
        switch(mime_content_type($_FILES['producto_foto']['tmp_name'])){
            case 'image/jpeg':
                $img_ext=".jpg";
            break;
            case 'image/png':
                $img_ext=".png";
            break;
        }

        chmod($img_dir, 0777);

        # Nombre de la imagen
        $img_nombre=renombrar_fotos($nombre);
        $foto=$img_nombre.$img_ext;

        # Moviendo la imagen en el directorio correspondiente
        if(!move_uploaded_file($_FILES['producto_foto']['tmp_name'], $img_dir.$foto)){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    No se pudo guardar la imagen seleccionada, por favor intente nuevamente.
                </div>
            ';
            exit();
        }
    }else{
        $foto="";
    }

    # Guardando datos
    $guardar_producto=conexion();
    $guardar_producto=$guardar_producto->prepare("INSERT INTO producto(producto_codigo, producto_nombre, producto_precio, producto_stock, producto_foto, categoria_id, usuario_id) VALUES(:codigo,:nombre,:precio,:stock,:foto,:categoria,:usuario)");
    $marcadores=[
        ":codigo"=>$codigo,
        ":nombre"=>$nombre,
        ":precio"=>$precio,
        ":stock"=>$stock,
        ":foto"=>$foto,
        ":categoria"=>$categoria,
        ":usuario"=>$_SESSION['id']
    ];

    $guardar_producto->execute($marcadores);
    if($guardar_producto->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡Producto registrado!</strong><br>
                El producto se registró con éxito.
            </div>
        ';
    }else{
        if(is_file($img_dir.$foto)){
            chmod($img_dir.$foto, 0777);
            unlink($img_dir.$foto);
        }
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No se pudo registrar el producto, por favor intente nuevamente.
            </div>
        ';
    }