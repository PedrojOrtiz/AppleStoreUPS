<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    if ($_SESSION['rol'] == 'admin') {
        header("Location: ../../admin/view/index.php");
    }
} else {
    header("Location: ../../../index.php");
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
            <h2>Opciones</h2>
            <div class="cardContent settings">
                <div class="updatePass">
                    <h2>Cambiar contraseña</h2>
                    <div class="formData updatePass">
                        <form action="../controller/updatePass.php" method="post">
                            <label for="oldpass">Contraseña antigua</label>
                            <input type="password" name="oldpass" id="oldpass">
                            <label for="newpass">Contraseña nueva</label>
                            <input type="password" name="newpass" id="newpass">
                            <label for="repeatpass">Confirmar contraseña</label>
                            <input type="password" name="repeatpass" id="repeatpass">
                            <input type="submit" value="Confirmar cambios">
                        </form>
                    </div>
                </div>

                <div class="deleteAccount">
                    <h2>Desactivar cuenta</h2>
                    <div class="formData">
                        <form action="../controller/deleteUser.php" method="post">
                            <label for="deleteAccount">Introdusca su contraseña</label>
                            <input type="password" name="deleteAccount" id="deleteAccount">
                            <input type="submit" value="Desactivar">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer>
        <?php
        include("../../../global/php/footerPublic.php");
        ?>
    </footer>

</body>

</html>