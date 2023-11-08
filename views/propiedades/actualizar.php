<main class="contenedor seccion">
        <h1>Actualizar</h1>

        <?php foreach($errores as $error):  ?>
            <!--div genera block format--> 
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach;  ?>

        <a href="/admin" class="boton-verde">Volver</a>
        
        <form  class="formulario" method="POST" enctype="multipart/form-data">  <!--cuando el formulario se emvia se vuelve post-->
        <?php include __DIR__ .'/formulario.php' ?>
        <input type="submit" value="Actualizar Propiedad" class="boton-verde">
</main>