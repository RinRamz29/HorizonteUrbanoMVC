<main class="contenedor">
        <h1>Iniciar Sesión</h1>

        <?php foreach ($errores as $error) : ?>
            <div class="alerta error"> 
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/login">
            <fieldset>
                <legend>Email y Password:</legend>

                <label for="email">E-mail</label>
                <input name="email" type="email" id="email" placeholder="Tu Email" required>

                <label for="password">Password</label>
                <input name="password" type="password" id="password" placeholder="Tu Password" required >

            </fieldset>
            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
</main>