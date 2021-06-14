<?php  
    require 'includes/funciones.php';
    incluirTemplates('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Guia para la decoracion de tu hogar</h1>
        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpe" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="imagen de la propiedad">
        </picture>
        <div class="text-entrada">
            <p>Escrito el: <span>12/06/2021</span> por: <span>Camilia</span></p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur possimus dignissimos voluptatibus omnis quos eveniet sapiente nisi dolorum officia voluptas, atque quidem magni ea deleniti quod ratione at! Nulla aliquid culpa consequatur earum accusamus suscipit iste ex, corrupti praesentium numquam!</p>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi autem corrupti totam aut voluptatem illum libero, nemo, maxime obcaecati deserunt labore omnis mollitia. Deserunt consectetur consequatur quae veritatis eligendi illum amet omnis. Vitae quam odit, est atque inventore perspiciatis aperiam!
            </p>
        </div>
    </main>
   
<?php  
    incluirTemplates('footer');
?>