<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Modificar datos de persona</title>
        <link rel="stylesheet" rel="stylesheet" href="">
    </head>
    <body>
        <?php
            $codigo_admin = $_GET["codigo_admin"];
            $codigo = $_GET["codigo"];
            $sql = "SELECT * FROM usuario where usu_id=$codigo";

            include '../../../config/configDB.php';
            $result = $conn->query($sql);

            if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
        ?>
                    <form class="box" method="POST" action="../controller/modificar.php?codigo_admin=<?php echo $codigo_admin ?>">
                        <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>">

                

                        <label class="modificar" for="nombres">Nombres (*)</label>
                        <input type="text" id="nombres" name="nombres" value="<?php echo $row["usu_nombres"]; ?>" required_placeholder="Ingrese los dos nombres...">
                        <br>

                        <label class="modificar" for="apellidos">Apellidos (*)</label>
                        <input type="text" id="apellidos" name="apellidos" value="<?php echo $row["usu_apellidos"]; ?>" required_placeholder="Ingrese los dos apellidos...">
                        <br>


                        <label class="modificar" for="correo">Correo electronico (*)</label>
                        <input type="email" id="correo" name="correo" value="<?php echo $row["usu_correo"]; ?>" required_placeholder="Ingrese el correo electronico...">
                        <br>

                        <input class="boton" type="submit" id="modificar" name="modificar" value="Modificar">
                        <input type="button" id="cancelar" name="cancelar" value="Cancelar" onclick="location.href='usuarios.php?codigo_admin=<?php echo $codigo_admin ?>'" class="boton">
                    </form>
        <?php            
                }
            }else{
                echo "<p>Ha ocurrido un error inesperdado</p>";
                echo "<p>".mysqli_error($conn)."</p>";
            }
            $conn->close();
        ?>
    </body>
</html>