<main class="contenedor seccion">
 <h1>Administrador de Bienes Raices</h1>
 <?php
    if($resultado){
        $mensaje = mostrarNotificaciones(intval($resultado));
        if ($mensaje){ ?>
        <p class="alerta exito"><?php echo sanitizar($mensaje);?></p>
        <?php } 
    } ?>
   

 <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
 <a href="/vendedores/crear" class="boton boton-amarillo">Nuevx Vendedor</a>

 <h2>Propiedades</h2>

 <table class="propiedades">
     <thead>
         <tr>
             <th>ID</th>
             <th>Título</th>
             <th>Imagen</th>
             <th>Precio</th>
             <th>Acciones</th>
         </tr>
     </thead>

     <tbody>
         <?php foreach($propiedades as $propiedad): ?>
         <tr> <!-- Mostrar los resultados -->
             <td><?php echo $propiedad->id; ?></td>
             <td><?php echo $propiedad->titulo; ?></td>
             <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" alt="oa"></td>
             <td><?php echo $propiedad->precio; ?></td>
             <td>
                 <form method="POST" class="w-100" action="propiedades/eliminar">
                     <input class="boton-rojo" type="submit" value="Eliminar">
                     <input type="hidden" name="tipo" value="propiedad">
                     <input type="hidden" name="id" value="<?php echo $propiedad->id;?>">
                 </form>
                 <a class="boton-amarillo-block" href="vendedores/actualizar?id=<?php echo $propiedad->id; ?>">Actualizar</a>
             </td>
         </tr>
         <?php endforeach; ?>
     </tbody>
 </table>

 <h2>Vendedores</h2>

        
<table class="propiedades">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($vendedores as $vendedor): ?>
        <tr> <!-- Mostrar los resultados -->
            <td><?php echo $vendedor->id; ?></td>
            <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
            <td><?php echo $vendedor->telefono; ?></td>
            <td>
                <form method="POST" class="w-100" action="vendedores/eliminar">
                    <input class="boton-rojo" type="submit" value="Eliminar">
                    <input type="hidden" name="tipo" value="vendedor">
                    <input type="hidden" name="id" value="<?php echo $vendedor->id;?>">
                </form>
                <a class="boton-amarillo-block" href="vendedores/actualizar?id=<?php echo $vendedor->id; ?>">Actualizar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</main>