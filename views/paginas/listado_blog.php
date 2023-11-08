<?php foreach( $blogs as $blog ): ?>

<article class="entrada-blog">
    <div class="imagen">

    <img loading="lazy" src="/imagenesblog/<?php echo $blog->imagen;  ?>" alt="imagen blog">
        
    </div>

    <div class="texto-entrada">
        <a href="/entrada?id=<?php echo $blog->id; ?>">
            <h4>  <?php echo $blog->title; ?> </h4>
            <p class="informacion-meta" >Escrito el: <span> <?php echo $blog->fecha; ?> </span> por: <span>Admin</span> </p>
            <!-- <p>
               <?php echo $blog->descripcion; ?>
            </p> -->
        </a>
    </div>
</article>

<?php endforeach; ?>