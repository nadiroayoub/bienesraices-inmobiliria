<?php  
    // Base de datos
    require '../../includes/config/database.php';
    
    $db = conectarDB();
    $errores = [];
    $titulo = "";
    $precio = "";
    $descripcion = "";
    $habitaciones = "";
    $wc = "";
    $estacionamiento = "";
    $vendedorID = "";


    if($_SERVER["REQUEST_METHOD"] === "POST") {
        // Arreglo con mensajes de errores
        
        // Ejecuta el codigo despues de que el usuario envia el formulario
        $titulo = $_POST["titulo"];
        $precio = $_POST["precio"];
        $descripcion = $_POST["descripcion"];
        $habitaciones = $_POST["habitaciones"];
        $wc = $_POST["wc"];
        $estacionamiento = $_POST["estacionamiento"];
        $vendedorID = $_POST["vendedorID"];

        // Validar datos
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

            // Insertar en la base de datos
            $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedorID) VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '${estacionamiento}', '${vendedorID}')";
    
            // echo $query;
            $resultado = mysqli_query($db, $query);
        }

        $query_2 = "SELECT * FROM vendedores";
        
            $resultado_2 = mysqli_query($db, $query_2);

            echo "<pre>";
            var_dump( $resultado_2["nombre"]);
            echo "</pre>";
    };

    require '../../includes/funciones.php';
    
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

        <form class="formulario" method="POST" action="../propiedades/crear.php">
            <fieldset>
                <legend>Informacion general</legend>
                <label for="titulo">Titulo</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo;?>">

                <label for="precio">precio</label>
                <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio;?>">
                
                <label for="imagen">imagen</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">descripcion</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion;?>"</textarea>
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
                    <option value="1">ayoub</option>
                    <option value="2">nadir</option>
                </select>
            </fieldset>

            <input type="submit" value="Crear propiedad" class="boton boton-verde"></input>
        </form>
    </main>
    
<?php  
    incluirTemplates('footer');
?>