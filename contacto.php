<?php  
    require 'includes/funciones.php';
    incluirTemplates('header');
?>

<main class="contenedor seccion">
        <h1>Contacto</h1>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="">
        </picture>
        <h2>Llena el formulario de Contacto</h2>
        <form action="" class="formulario">
            <fieldset>
                <legend>Informacion personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Tu nombre">
                
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="Tu email">
                
                <label for="telefono">Telefono</label>
                <input type="tel" name="telefono" id="telefono" placeholder="Tu telefono">
                
                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje"></textarea>
            </fieldset>
            <fieldset>
                <legend>Información sobre la propiedad</legend>
                <label for="opciones">Vende o compra</label>
                <select name="opciones" id="opciones">
                    <option value="" selected disabled>--Seleccione</option>
                    <option value="Vende">Vende</option>
                    <option value="Compra">Compra</option>
                </select>
                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" name="presupuesto" id="presupuesto" placeholder="Tu precio o Presupuesto">
            </fieldset>
            <fieldset>
                <legend>Contacto</legend>
                <p>Como desea ser contactado</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">TELEFONO</label>
                    <input name="contacto" type="radio" value="telefono" id="contactar-telefono">

                    <label for="contactar-email">E-mail</label>
                    <input name="contacto" type="radio" value="email" id="contactar-email">
                </div>
                <p>Si elijio telefono, elija la fecha y la hora</p>
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha">
               
                <label for="hora">Hora:</label>
                <input type="time" id="hora" min="09:00" max="18:00">

            </fieldset>
            <input type="submit" value="Enviar" class="boton-verde boton">
        </form>
    </main>
  

<?php  

    incluirTemplates('footer');
?>