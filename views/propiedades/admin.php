<?php
     if(!($_SESSION)) {
         session_start();
     }
    $rango = $_SESSION['rango'] ?? 0;
    //var_dump($_SESSION);
?>


<main class="contenedor seccion">
        <h1>Administrador de bienes Raices</h1>

        <?php 
        if($message)
        {
            $mensaje = mostrarNotificacion(intval($message));
            if($mensaje) { ?>
                <p class="alerta exito"> <?php echo s($mensaje)  ?> </p>
            <?php  } 
        } ?>

        <div class="separar">
            <a href="/propiedades/crear" class="boton-verde">Nueva propiedad</a>
            <a href="/vendedores/crear" class="boton-amarillo">Nuevo Vendedor</a>
            <a href="/blogs/crear" class="boton-verde">Crea un blog</a>
           
        <?php
            if($rango == 1)
           echo'<a href="/NewAdmin/crear" class="boton-verde">Crea un nuevo Admin</a>';
           ?>
            

        </div>

        <h2>Propiedades</h2>
       
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th >Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach( $propiedades as $propiedad ): ?>

                <tr>
                    <td class="centrar"> <?php echo $propiedad->id; ?> </td>
                    <td class="centrar"><?php echo $propiedad->titulo; ?> </td>
                    <td class="imagen-tabla" > <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen prueba">  </td>
                    <td class="centrar"> $<?php echo $propiedad->precio ?> </td>
                    <td>
                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                             <input type="hidden" name="idd" value=" <?php echo $propiedad->id; ?> ">
                             <input type="hidden" name="tipo" value="propiedad">

                             <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" 
                        class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th >Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach( $vendedores as $vendedor ): ?>

                <tr>
                    <td class="centrar"> <?php echo $vendedor->id; ?> </td>
                    <td class="centrar"><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?> </td>
                    <td class="centrar"> <?php echo $vendedor->telefono ?> </td>
                    <td>
                        <form method="POST" class="w-100" action="/vendedores/eliminar">
                            <input type="hidden" name="idd" value=" <?php echo $vendedor->id; ?> ">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        
                        <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" 
                        class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                
                <?php endforeach; ?>
            </tbody>
        </table>



        <h2>Blogs</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th >Fecha Creacion</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach( $blogs as $blog ): ?>

                <tr>
                    <td class="centrar"> <?php echo $blog->id; ?> </td>
                    <td class="centrar"><?php echo $blog->title; ?> </td>
                    <td class="imagen-tabla" > <img src="/imagenesblog/<?php echo $blog->imagen; ?>" alt="imagen blog">  </td>
                    <td class="centrar"> <?php echo $blog->fecha ?> </td>
                    <td>
                        <form method="POST" class="w-100" action="/blogs/eliminar">
                            <input type="hidden" name="idd" value=" <?php echo $blog->id; ?> ">
                            <input type="hidden" name="tipo" value="blog">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        
                        <a href="/blogs/actualizar?id=<?php echo $blog->id; ?>" 
                        class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                
                <?php endforeach; ?>
            </tbody>
        </table>



</main>