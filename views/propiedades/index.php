
<main class="contenedor seccion">
    <h1>Administrador</h1>
    <?php 
        $mensaje = mostrarNotificacion( intval( $resultado) );
        if($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>
        <?php } 
    ?>

    <h2>Propiedades</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>nombre</th>
                <th>apellidos</th>
                <th>correo</th>
                <th>telefono</th>
                <th>Aciones</th>
            </tr>
        </thead>
        
        <tbody> <!--mostrando resultado-->
        <?php foreach( $propiedades as $propiedad ): ?>

                <tr>
                <td><?php echo $propiedad->id; ?></td>
                <td><?php echo $propiedad->nombre; ?></td>
                <td><?php echo $propiedad->apellido_p , " " , $propiedad->apellido_m; ?></td>
                <td><?php echo $propiedad->correo; ?></td>
                <td>
                    <form method="POST" action="propiedades/eliminar" class="w-100">
                        <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                        <input type="hidden" name="tipo" value="propiedad">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    
                    <a href="propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
        
    </table>

</main>