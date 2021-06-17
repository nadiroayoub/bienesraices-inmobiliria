<?php  

    // Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Validar la URL por ID valido
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
        header('Location: /admin');
    }

    // Obtener los datos de la propiedad con id
    $consulta_id = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultado_id = mysqli_query($db, $consulta_id);
    $propiedad = mysqli_fetch_assoc($resultado_id);

    //Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
        
    $resultado_consulta = mysqli_query($db, $consulta);
    
    // Arreglo con mensajes de errores
    $errores = [];
    // iniciar las variables para mostrarlos a los campos despues de enviarlos
    $titulo = $propiedad["titulo"];
    $precio = $propiedad["precio"];
    $descripcion = $propiedad["descripcion"];
    $habitaciones = $propiedad["habitaciones"];
    $wc = $propiedad["wc"];;
    $estacionamiento = $propiedad["estacionamiento"];;
    $vendedorID = $propiedad["vendedorID"];;
    $creado = date('Y-m-d');
    $imagenPropiedad = $propiedad["imagen"];


    if($_SERVER["REQUEST_METHOD"] === "POST") {
        
        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";
        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";

        // exit;
        
        // Ejecuta el codigo despues de que el usuario envia el formulario
        $titulo = mysqli_real_escape_string($db, $_POST["titulo"]);
        $precio = mysqli_real_escape_string($db, $_POST["precio"]);
        $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
        $habitaciones = mysqli_real_escape_string($db, $_POST["habitaciones"]);
        $wc =mysqli_real_escape_string($db, $_POST["wc"]);
        $estacionamiento = mysqli_real_escape_string($db, $_POST["estacionamiento"]);
        $vendedorID = mysqli_real_escape_string($db, $_POST["vendedorID"]);
        // Asignar files hacia una variable
        $imagen = $_FILES['imagen'];
        
        // Validar datos
        // La imagen no se verifica otra vez 
        // if(!$imagen['name'] || $imagen['error']){
        //     $errores[] = "Debes subir una imagen";
        // }
        // Validar el tamaño 1m de la imagen
        $medida = 1000 * 1000;
        if($imagen['size'] > $medida) {
            $errores[] = "La imagen es muy pesada";
        }
        
        if(!$titulo) {
            $errores[] = "Debes añadir un titulo";
        }
        if(!$precio) {
            $errores[] = "El precio es obligatorio";
        }
        if(strlen($descripcion) < 50) {
            $errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
        }
        if(!$habitaciones){
            $errores[] = "El numero de habitaciones es obligatorio";
        }
        if(!$wc){
            $errores[] = "El numero de baños es obligatorio";
        }
        if(!$vendedorID){
            $errores[] = "Elige un vendedor";
        }

        // Revisar si el arreglo de errores esta vacio
        if(empty($errores)) {

            $carpetaImagenes = '../../imagenes/';
            $nombreImagen = "";
            
            // CREAR UNA CARPETA
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }
            
            // SUBIDA DE ARCHIVOS
            if($imagen["name"]){
                // Eliminar la imagen previa 
                unlink($carpetaImagenes . $propiedad['imagen']);
                // Generar un nombre unico
                $nombreImagen = md5(uniqid(rand())). ".jpg";
    
                // Almacenar el archivo
                move_uploaded_file($imagen['tmp_name'],  $carpetaImagenes. $nombreImagen);
            }else {
                $nombreImagen = $propiedad['imagen'];
            }

            // Insertar en la base de datos
            $query = "UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc}, estacionamiento = ${estacionamiento}, vendedorID = ${vendedorID} WHERE id = ${id}";

            $resultado = mysqli_query($db, $query);
            if($resultado) {
                // Redireccionar al usuario
                header('Location: /Admin?resultado=2');
            }
        }        
    };

    require '../../includes/funciones.php';
    
    incluirTemplates('header');
?>
    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>
        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $key => $value):?>
            <div class="alerta error">

                <?php echo $value ?>

            </div>
        <?php endforeach;?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <fieldset>
                <?php ?>
                <legend>Informacion general</legend>
                <label for="titulo">Titulo</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo;?>">

                <label for="precio">precio</label>
                <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio;?>">
                
                <label for="imagen">imagen</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
                <img src="../../imagenes/<?php echo $imagenPropiedad?>" alt="" class="imagen-small">

                <label for="descripcion">descripcion</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion;?></textarea>
            </fieldset>
            <fieldset>
                <legend>Informacion propiedad</legend>
                <label for="habitaciones">habitaciones</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones;?>">

                <label for="wc">Baños</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc;?>">

                <label for="estacionamiento">estacionamiento</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento;?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                <select name="vendedorID">
                    <option value="" selected>--Selecciona--</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado_consulta)):?>
                        <option <?php echo $vendedorID === $vendedor["id"] ? 'selected': '' ?> value="<?php echo $vendedor["id"];?>"><?php echo $vendedor["nombre"] . " " . $vendedor["apellido"];?></option>
                    <?php endwhile?>
                </select>
            </fieldset>
            <input type="submit" value="Actualizar propiedad" class="boton boton-verde"></input>
        </form>
    </main>
    
<?php  
    incluirTemplates('footer');
?>