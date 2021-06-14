<?php  
    require 'includes/funciones.php';
    incluirTemplates('header');
?>
    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>
                    25 años de Experiencia
                </blockquote>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur possimus dignissimos voluptatibus omnis quos eveniet sapiente nisi dolorum officia voluptas, atque quidem magni ea deleniti quod ratione at! Nulla aliquid culpa consequatur earum accusamus suscipit iste ex, corrupti praesentium numquam!</p>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi autem corrupti totam aut voluptatem illum libero, nemo, maxime obcaecati deserunt labore omnis mollitia. Deserunt consectetur consequatur quae veritatis eligendi illum amet omnis. Vitae quam odit, est atque inventore perspiciatis aperiam!
                </p>
            </div>
        </div>
    </main>
 
<?php  
    incluirTemplates('footer');
?>