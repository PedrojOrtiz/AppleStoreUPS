<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    //header("Location: ../admin/index.php");
    if ($_SESSION['rol'] == 'admin') {
        //header("Location: ../admin/index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../../../public/css/globalStyle.css">
    <title>Opciones</title>
</head>

<body>
    <header>
        <div class="content">
            <?php
            include("../../../global/php/headerPublicUser.php");
            ?>
    </header>

    <div class="container">
        <header>
            <?php
            include("../../../global/php/headerUser.php");
            ?>
        </header>
        <section>
            <?php
            include '../../../config/configDB.php';
            $oldpass = isset($_POST["oldpass"]) ? trim($_POST["oldpass"]) : null;
            $newpass= isset($_POST["newpass"]) ? trim($_POST["newpass"]) : null;
            $repeatpass = isset($_POST["repeatpass"]) ? trim($_POST["repeatpass"]) : null;
            $cod = isset($_POST["cod"]) ? trim($_POST["cod"]) : null;

            $sql = "SELECT usu_password FROM usuario u WHERE u.usu_id='$cod';";
            $result = $conn->query($sql);
            $result = $result->fetch_assoc();
            $date = date(date("Y-m-d H:i:s"));

            if (MD5($oldpass) === $result["usu_password"]) {
                if ($newpass === $repeatpass ) {
                    $sql = "UPDATE usuario u SET u.usu_password = MD5('$newpass'), u.usu_fecha_modificacion=null  WHERE  u.usu_id='$cod'";
                    if ($conn->query($sql) == true) {
                        noerro();
                    } else {
                        echo "<h2>Error al actualizar la contraseña " . mysqli_error($conn) . "</h2>";
                        error($cod);
                    }
                } else {
                    echo "<h2>Las contraseñas no coinciden</h2>";
                    error($cod);
                }
            } else {
                echo "<h2>La contraseña no existe en el sistema</h2>";
                error($cod);
            }
            $conn->close();
            function noerro()
            {
                echo "<h2>Contraseña actualizada con exito</h2>";
                echo '<i class="far fa-check-circle"></i>';
                echo '<a href="../../vista">Regresar</a>';
            }
            function error($cod)
            {
                echo '<i class="fas fa-exclamation-circle"></i>';
                echo '<a href="../../vista?usu_=' . $cod . '">Regresar</a>';
            }
            ?>


        </section>

    </div>


        <footer>
            <?php
            include("../../../global/php/footerPublic.php");
            ?>
        </footer>

</body>

</html>