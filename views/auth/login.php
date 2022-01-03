<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form action="" class="formulario" method="POST">


          <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
         <?php endforeach; ?>

          <label for="correo">Correo</label>
          <input type="email" id="correo" placeholder="Correo Electronico" name="correo">
        <label for="password">Contraseña</label>
          <input type="password" id="password" name="password" placeholder="Contraseña">

          <a href="/crear" class="cuenta">Crear Cuenta nueva</a>
          <input type="submit" value="Enviar" class="boton-verde">
      </form>
</main>