<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Eliminar datos de persona</title>
    </head>
    <body>
        <?php

            //Incluir conexion a la BD
            include '../../../config/configDB.php';
            $codigo_admin = $_GET["codigo_admin"];
            $codigo = $_POST["codigo"];
            date_default_timezone_set("America/Guayaquil");
            $fecha = date("Y-m-d H:i:s",time());
            $sql = "UPDATE usuario SET usu_eliminado = 1, usu_fecha_modificacion = '$fecha' WHERE usu_id = '$codigo'";

            if ($conn->query($sql) == TRUE){
                echo "<p>Se ha eliminado los datos correctamente</p>";
            }else{
                echo "<p>Error".$sql."<br>".mysqli_error($conn)."</p>";
            }
            echo "<a href='clients.php?codigo_admin=".$codigo_admin."'>Regresar</a>";

            $conn->close();
        ?>
    </body>
</html>
