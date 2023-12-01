<main class="contenedor seccion">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" width="200" height="300" src="build/img/destacada3.jpg" alt="Imagen Contacto">
        </picture>

        <h2>Llene el formulario de contacto</h2>
        <form class="formulario" action="/contacto" method="POST">
            <fieldset>
                <legend>Información personal:</legend>
                <label for="nombre">Nombre</label>
                <input id="nombre" type="text" placeholder="Tu Nombre" name="contacto[nombre]" required> 

                <label for="email">E-mail</label>
                <input type="email" id="email" placeholder="Tu Email" name="contacto[email]" required>

                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" cols="30" rows="10" name="contacto[mensaje]" required></textarea>
            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>
                <label for="opciones">Vende o Compra:</label>

                <select id="opciones" name="contacto[tipo]" required>
                    <option value="" disabled selected>--selecciona--</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                
                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" id="presupuesto" placeholder="Tu Precio o Presupuesto" min="0" name="contacto[precio]" required>
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
</main>