<?php
session_start();
if (!isset($_GET['register']) || !isset($_GET['login'])) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../css/globalStyle.css">
    <link rel="stylesheet" href="../css/generalStyle.css">
    <title>Successful</title>
</head>

<body>
    <header>
        <?php
        include("../../global/php/headerPublic.php");
        ?>
    </header>

    <div class="headerImg pageError pageSuccess">

        <?php
        if (isset($_GET['register'])) {
            if ($_GET['register'] == 'true') {
                ?>
        <div class="contentSucce">
            <h2>Registro exitoso....</h2>
            <p>Redirigiendo por favor espere...</p>
            <i class="far fa-check-circle"></i>

        </div>
        <?php
                header("Refresh:2; url=login.php");
            } else {
                //fracaso
                if (isset($_GET['error'])) {
                    //fracaso
                    if ($_GET['error'] == '1062') {
                        ?>
        <div class="contentSucce">
            <h2>El usuario ya existe</h2>
            <p>Error al registrar..</p>
            <i class="far fa-times-circle"></i>
        </div>
        <?php
                        header("Refresh:2; url=signup.php");
                    } else {
                        ?>
        <div class="contentSucce">
            <h2>Error insesperado</h2>
            <p><?php echo $_GET['error'] ?></p>
            <p>Error al registrar..</p>
            <i class="far fa-times-circle"></i>
        </div>
        <?php
                        header("Refresh:2; url=signup.php");
                    }
                } else {
                    header("Location: signup.php");
                }
            }
        } elseif (isset($_GET['login'])) {


            if ($_GET['login'] === 'true') {
                if ($_GET['delete'] == '1') {
                    ?>
        <div class="contentSucce">
            <h2>Tu cuenta a sido desactivada </h2>
            <p>Activando cuenta espere en breve sera redirigido gracias...</p>
            <i class="far fa-check-circle"></i>
        </div>
        <?php
                    $sql = "UPDATE usuario SET
                    usu_eliminado=1,
                    usu_fecha_modificacion='$date'
                    WHERE usu_id=" . $_SESSION['codigo'] . ";";

                    if ($conn->query($sql)) {
                        if ($_SESSION['rol'] == 'user') {
                            header("Refresh:2; url=index.php");
                        } else {
                            header("Refresh:2; url=../../admin/admin/view/index.php");
                        }
                    } else {
                        header("Refresh:1; url=index.php");
                    }
                } else {
                    ?>
        <div class="contentSucce">
            <h2>Logeo exitoso</h2>
            <p>Redirigiendo por favor espere...</p>
            <i class="far fa-check-circle"></i>
        </div>
        <?php
                    if ($_SESSION['rol'] == 'user') {
                        header("Refresh:2; url=index.php");
                    } else {
                        header("Refresh:2; url=../../admin/admin/view/index.php");
                    }
                }
            } else {
                ?>
        <div class="contentSucce">
            <h2>Error datos de inicio incorrectos.</h2>
            <p>Redirigiendo por favor espere...</p>
            <i class="far fa-times-circle"></i>
        </div>
        <?php
                header("Refresh:2; url=login.php");
            }
        }
        ?>
    </div>
    <footer>
        <?php
        //echo (getcwd());
        include("../../global/php/footerPublic.php");
        ?>
    </footer>

</body>

</html>
</body>

</html>