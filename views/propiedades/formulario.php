

<fieldset>
    <legend>Información</legend>

    <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre" value="<?php echo s($propiedad->nombre); ?>">

        <label for="apellido_m">Apellido Materno</label>
        <input type="text" id="apellido_m" name="apellido_m" placeholder="Ingrese su nombre" value="<?php echo s($propiedad->apellido_m); ?>" >

        <label for="apellido_p">Apellido Paterno</label>
        <input type="text" id="apellido_p" name="apellido_p" placeholder="Ingrese su nombre" value="<?php echo s($propiedad->apellido_p); ?>">

        <label for="telefono">Numero Telefonico</label>
        <input type="tel" id="telefono" name="telefono" value="<?php echo s($propiedad->telefono); ?>">

        <label for="correo">Correo Electronico</label>
        <input type="email" id="correo" name="correo" placeholder="Ingrese su correo" value="<?php echo s($propiedad->correo); ?>">

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Contraseña" >

</fieldset>
