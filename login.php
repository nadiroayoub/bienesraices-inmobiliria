<?php  
    // Autenticar el usuario
    // Implementar la conexcion 
    require 'includes/config/database.php';
    $db = conectarDB();

    $errores = [];
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);
        
        if(!$email) {
            $errores[] = "El email no es correcto o no es valido";
        }
        if(!$password) {
            $errores[] = "El password es obligatorio";
        }
        
        if (empty($errores)) {
            // Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '${email}'";
            $resultado = mysqli_query($db, $query);
            
            if($resultado -> num_rows) {
                // Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);
                $auth = password_verify($password, $usuario['password']);
                

                if($auth) {
                    // El usuario esta autenticado
                    session_start();
                    
                    // LLenar el arreglo de la sesion
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;
                }else {
                    $errores[] = "Contraseña incorrecta";
                }
                // if($usuario['password'] === $password){
                //         echo 'todo correcto';
                //         exit;
                // }else {
                //         echo $usuario['password'];
                //         echo $password;
                //         echo 'Password no es correcto';
                //         exit;
                //         }
            }else {
                $errores[] = "El usuario no existe";
            }
            

        }
        

    }

    // Incluye el header
    require 'includes/funciones.php';
    incluirTemplates('header');

?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>
        <?php foreach ($errores as $key => $error) :?>
            <div class="alerta error">
                <?php echo $error;  ?>

            </div>
        <?php endforeach;?>
        <form method="POST" class="formulario" novalidate>
            <fieldset>
                <legend>Email y Contraseña</legend>
                <label for="email">Email</label>
                <input type="email" placeholder="Tu email" value="" name="email" id="email" required>
                
                <label for="password">Contraseña</label>
                <input type="password" placeholder="Tu contraseña" id="password" name="password" required>

            </fieldset>
            <input type="submit" class="boton boton-verde" value="Iniciar Sesión">
        </form>
    </main>
    
<?php  
    incluirTemplates('footer');
?>