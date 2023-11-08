<fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="title" placeholder="Titulo propiedad" value="<?php echo s($blog->title); ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <?php if($blog->imagen): ?>
                <img src="/imagenesblog/<?php echo $blog->imagen ?>" class="imagen-small"
            <?php endif ?>

            <label for="descripcion">Descripcion:</label>
            <textarea id="descripcion" name="descripcion"> <?php echo s($blog->descripcion); ?> </textarea>

</fieldset>
