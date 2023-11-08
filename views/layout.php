<?php
     if(!($_SESSION)) {
         session_start();
     }
    $auth = $_SESSION['login'] ?? false;
    //var_dump($_SESSION);
    $rango = $_SESSION['rango'] ?? 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="logo bienes raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" class="dark-mode-boton">
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                       
                        <?php if ($auth && $rango == 1) : ?>
                            <a href="/ListarAdmins">Admins Creados</a>
                        <?php endif; ?>
        
                        <?php if ($auth) : ?>
                             <a href="/admin">Administrador</a>
                        <?php endif; ?>

                        <?php if (!$auth) : ?>
                             <a href="/login">Iniciar Sesion</a>
                        <?php endif; ?>

                        <?php if ($auth): ?>
                            <a href="/logout">Cerrar sesion</a>
                        <?php endif; ?>
                        
                    </nav>
                </div>
               
            </div> <!--.barra-->
            <?php if($inicio) { ?>
                <h1>Sale of Houses and Exclusive Luxury Apartments</h1>
            <?php } ?>
        </div>
    </header>




    <?php echo $contenido;  ?>



    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/propiedades">Anuncios</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>
        </div>

        <p class="copyright">Todos los derechos Reservados <?php echo date('Y'); ?>  &copy;</p>
    </footer>

    <script src="/build/js/bundle.min.js"></script>
</body>
</html>