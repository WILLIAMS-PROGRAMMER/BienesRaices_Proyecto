
<main class="contenedor seccion">
   
    <a href="/NewAdmin/crear" class="boton-verde">Crea un nuevo Admin</a>
    

    <h2>Admins</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th > Password</th>
                <th>Rango</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!-- Mostrar los resultados -->
            <?php foreach( $Admins as $Admin ): ?>

            <tr>
                <td class="centrar"> <?php echo $Admin->id; ?> </td>
                <td class="centrar"><?php echo $Admin->email; ?> </td>
                <td class="centrar"> <?php echo $Admin->password ?> </td>
                <td class="centrar"> <?php echo $Admin->rango ?> </td>
                <td>
                    <form method="POST" class="w-100" action="/blogs/eliminar">
                        <input type="hidden" name="idd" value=" <?php echo $Admin->id; ?> ">
                        <input type="hidden" name="tipo" value="admin">

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