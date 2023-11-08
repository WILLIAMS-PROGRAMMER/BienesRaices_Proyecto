 
<main class="contenedor seccion contenido-centrado">
        <h2>Iniciar seccion</h2>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form method="POST" class="formulario" action="/login">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu Email" id="email" name="email" required>

                <label for="password">Password</label>
                <input type="password" placeholder="Tu password" id="password" name="password" required>
                <!--required es para obligar al usuario a completar esos campos-->

            </fieldset>

            <input type="submit" value="Iniciar Sesion" class="boton-verde">
        </form>

    </main>
         