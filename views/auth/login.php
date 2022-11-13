<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Su Email" id="email">

            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="Su password" id="password">
        </fieldset>
        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>