<main class="contenedor seccion contenido-centrado">
        <h1> <?php echo $blog->title; ?> </h1>
 
        <img loading="lazy" src="/imagenesblog/<?php echo $blog->imagen; ?>" alt="imagen del blog">
       
        <div class="resumen-propiedad">

        <p class="informacion-meta">Escrito el: <span> <?php echo $blog->fecha; ?> </span>por: <span>Admin</span> </p>

         <p class="cortar-text"> <?php echo $blog->descripcion; ?> </p> 
       
        </div>
    </main>