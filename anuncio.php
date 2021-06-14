<?php  
    require 'includes/funciones.php';
    incluirTemplates('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa de venta frente al bosque</h1>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpe" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="imagen de la propiedad">
        </picture>
        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacienamiento">
                    <p>3</p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p>4</p>
                </li>
            </ul>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur possimus dignissimos voluptatibus omnis quos eveniet sapiente nisi dolorum officia voluptas, atque quidem magni ea deleniti quod ratione at! Nulla aliquid culpa consequatur earum accusamus suscipit iste ex, corrupti praesentium numquam!</p>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi autem corrupti totam aut voluptatem illum libero, nemo, maxime obcaecati deserunt labore omnis mollitia. Deserunt consectetur consequatur quae veritatis eligendi illum amet omnis. Vitae quam odit, est atque inventore perspiciatis aperiam!
            </p>
        </div>
    </main>

<?php 
    incluirTemplates('footer'); 
?>