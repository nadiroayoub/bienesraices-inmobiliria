<?php  

    // Verificar la sesion
    require '../../includes/funciones.php';
    $auth = estaAuthenticado();
    if(!$auth){
        header('Location: /');
    }

    // Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    //Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
        
    $resultado_consulta = mysqli_query($db, $consulta);

    
    // Arreglo con mensajes de errores
    $errores = [];
    // iniciar las variables para mostrarlos a los campos despues de enviarlos
    $titulo = "";
    $precio = "";
    $descripcion = "";
    $habitaciones = "";
    $wc = "";
    $estacionamiento = "";
    $vendedorID = "";
    $creado = date('Y-m-d');
    // $imagen = "";


    if($_SERVER["REQUEST_METHOD"] === "POST") {
        
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        
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
        if(!$imagen['name'] || $imagen['error']){
            $errores[] = "Debes subir una imagen";
        }
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


            // SUBIDA DE ARCHIVOS
            // CREAR UNA CARPETA
            $carpetaImagenes = '../../imagenes/';
            
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }
            // Generar un nombre unico
            $nombreImagen = md5(uniqid(rand())). ".jpg";

            // Almacenar el archivo
            move_uploaded_file($imagen['tmp_name'],  $carpetaImagenes. $nombreImagen);

            // Insertar en la base de datos
            $query = "INSERT INTO propiedades (titulo, precio, imagen,descripcion, habitaciones, wc, estacionamiento, creado, vendedorID) VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '${estacionamiento}', '${creado}', '${vendedorID}')";
    
            // echo $query;
            $resultado = mysqli_query($db, $query);
            if($resultado) {
                // Redireccionar al usuario
                $true = true;
                header('Location: /Admin?resultado=1');
            }
        }        
    };
    // Incluye el template de header
    incluirTemplates('header');
?>
    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $key => $value):?>
            <div class="alerta error">

                <?php echo $value ?>

            </div>
        <?php endforeach;?>

        <form class="formulario" method="POST" action="../propiedades/crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Informacion general</legend>
                <label for="titulo">Titulo</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo;?>">

                <label for="precio">precio</label>
                <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio;?>">
                
                <label for="imagen">imagen</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

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

            <input type="submit" value="Crear propiedad" class="boton boton-verde"></input>
        </form>
    </main>
    
<?php  
    incluirTemplates('footer');
?>