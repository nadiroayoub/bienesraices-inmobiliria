<?php  


    // Verificar la Sesion
    require '../includes/funciones.php';
    $auth = estaAuthenticado();
    if(!$auth){
        header('Location: /');
    }

    // Importar la conexion
    require '../includes/config/database.php';
    $db = conectarDB();

    // Escribir el query
    $query = "SELECT * FROM propiedades";

    // Consultar la base de datos
    $resultadoConsulta = mysqli_query($db, $query);
    
    // Muestra mensaje condicional
    $resultado = $_GET["resultado"] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {

            // Eliminar el archivo
            $query = "SELECT imagen FROM propiedades WHERE id = ${id}";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);

            $carpetaImagenes = '../imagenes/';
            unlink($carpetaImagenes . $propiedad['imagen']);

            // Eliminar la propiedad
            $query = "DELETE FROM propiedades WHERE id = ${id}";
            
            $resultado = mysqli_query($db, $query);

            if($resultado) {
                header('location: /admin?resultado=3');
            }
        }
        exit;
    }


    // Incluye un template
    incluirTemplates('header');
?>
    <main class="contenedor seccion">
        <h1>Administrador de Biences Raices</h1>
        <?php if(intval($resultado) === 1):?>
            <p class="alerta exito">Anucio Creado Correctamente</p>
        <?php elseif(intval($resultado) === 2):?>
            <p class="alerta exito">Anucio Actualizado Correctamente</p>
        <?php elseif(intval($resultado) === 3):?>
        <p class="alerta exito">Anucio Eliminado Correctamente</p>
        <?php endif;?>
        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody><!--Mostrar los datos-->
                <?php while ($propiedades = mysqli_fetch_assoc($resultadoConsulta)): ?>
                    <tr>
                        <td> <?php echo $propiedades['id'] ?></td>
                        <td> <?php echo $propiedades["titulo"] ?></td>
                        <td><img src="./../imagenes/<?php echo $propiedades["imagen"] ?>" class="imagen-tabla" alt=""></td>
                        <td>$ <?php echo $propiedades["precio"] ?></td>
                        <td>
                            <form action="" method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $propiedades["id"]?>">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedades['id']?>" class="boton-amarillo">Actualizar</a>
                        </td>
                    </tr>
                <?php endwhile;?>
            </tbody>
        </table>
    </main>
    
<?php

    // Cerrar la conexion
    mysqli_close($db);
    // Agregar el template del footer
    incluirTemplates('footer');
?>