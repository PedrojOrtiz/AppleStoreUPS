<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Modificar datos de persona</title>
    </head>
    <body>
        <?php
            //Incluir conexion a la base de datos
            include '../../../config/configDB.php';
            $codigo_admin = $_GET["codigo_admin"];

            $codigo = $_POST["codigo"];
            $nombres = isset($_POST["nombres"]) ? mb_strtoupper(trim($_POST["nombres"]), 'UTF-8') : null;
            $apellidos = isset($_POST["apellidos"]) ? mb_strtoupper(trim($_POST["apellidos"]), 'UTF-8') : null;
            $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : null;

            date_default_timezone_set("America/Guayaquil");
            $fecha = date('Y-m-d H:i:s',time());

            $sql = "UPDATE usuario SET  usu_nombres = '$nombres', usu_apellidos = '$apellidos',  usu_correo = '$correo',  usu_fecha_modificacion = '$fecha' WHERE usu_id = $codigo";
            
            if ($conn->query($sql) == TRUE){
                echo "Se ha actualizado los datos personales correctamente!!!<br>";
            }else{
                echo "Error: ".$sql."<br>".mysqli_error($conn)."<br>";
            }
            echo "<a href='../view/clients.php?codigo_admin=".$codigo_admin."'>Regresar</a>";

            $conn->close();
        ?>
    </body>
</html>