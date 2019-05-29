<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cambiar Contrasena</title>
        <link rel="stylesheet" rel="stylesheet" href="">
    </head>
    <body>
        <?php
            $codigo_admin = $_GET["codigo_admin"];
            $codigo = $_GET["codigo"];
        ?>
        <form class="box" method="POST" action="../controller/cambiar_contrasena.php?codigo_admin=<?php echo $codigo_admin ?>">
            <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>">

            <label class="contrasena" for="contrasenaActual">Contrasena Actual (*)</label>
            <input type="password" id="contrasena1" name="contrasena1" value="" required placeholder="Ingrese su contrasena actual...">
            <br>

            <label class="contrasena" for="contrasenaNueva">Contrasena Nueva (*)</label>
            <input type="password" id="contrasena2" name="contrasena2" value="" required placeholder="Ingrese su contrasena nueva...">
            <br>

            <input class="boton" type="submit" id="modificar" name="modificar" value="Modificar">
            <input type="button" id="cancelar" name="cancelar" value="Cancelar" onclick="location.href='clients.php?codigo_admin=<?php echo $codigo_admin ?>'" class="boton">
        </form>
    </body>
</html>