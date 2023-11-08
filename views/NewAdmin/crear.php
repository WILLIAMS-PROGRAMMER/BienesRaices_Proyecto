<main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton-verde">Volver</a>

        <?php foreach($errores as $error):  ?>
            <!--div genera block format--> 
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach;  ?>

        <!--formulario-->
        <form action="/NewAdmin/crear" class="formulario" method="POST" enctype="multipart/form-data">  <!--cuando el formulario se emvia se vuelve post-->
            
            <?php include __DIR__ .'/formulario.php'  ?>
          
            <input type="submit" value="Crear Admin" class="boton-verde">
            
        </form>

    </main>