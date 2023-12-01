<main class="contenedor seccion">
        <h1>Actualizar Vendedor</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errors as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form action="vendedores/actualizar" class="formulario" method="POST">
            <?php include 'formulario.php' ?>
            <input type="submit" value="Actualizar Vendedor" class="boton boton-verde">
        </form>
</main>