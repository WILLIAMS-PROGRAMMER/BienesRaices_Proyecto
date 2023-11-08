<fieldset>
            <legend>Información Admin</legend>

            <label for="email">email:</label>
            <input type="email" id="email" name="email" placeholder="email admin" value="<?php echo s($Admin->email); ?>">

            <label for="password">password:</label>
            <input type="password" id="password" name="password" placeholder="password admin" value="<?php echo s($Admin->password); ?>">
        
            <label for="rango">rango:</label>
            <input type="num" id="rango" name="rango" placeholder="rango admin" value="<?php echo s($Admin->rango); ?>">

</fieldset>
