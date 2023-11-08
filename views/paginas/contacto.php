<main class="contenedor seccion">
        <h1>Contacto</h1>

        <?php 
        if($mensaje)
        {
            echo "<p class='alerta exito'>" . $mensaje . "</p>";
        }
        
        ?>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen destacada 3 jpg">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario" action="/contacto" method="POST">
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]" required>

                <label for="mensaje">Mensaje</label>
               <textarea id="mensaje" name="contacto[mensaje]"></textarea>

            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad</legend>

                <label for="opciones">Vende o compra</label>
                <select id="opciones" name="contacto[tipo]" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto" name="contacto[precio]" required>

            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input name="contacto[contacto]" type="radio" value="telefono" id="contactar-telefono" required >

                    <label for="contactar-email">E-mail</label>
                    <input name="contacto[contacto]" type="radio" value="email" id="contactar-email" required>
                </div>

                <div id="contacto"></div>   <!--aqui va codigo javascript-->

            </fieldset>

            <input type="submit" value="enviar" class="boton-verde">

        </form>
    </main>