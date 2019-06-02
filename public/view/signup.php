<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    if ($_SESSION['rol'] == 'admin') {
        header("Location: ../../admin/admin/view/index.php");
    } else {
        header("Location:index.php");
    }
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
    <title>Sign UP</title>
</head>

<body>
    <header>
        <?php
        include("../../global/php/headerPublic.php");
        ?>
    </header>

    <div class="content">
        <div class="form">
            <form enctype="multipart/form-data" action="../controller/signup.php" method="post">
                <h2>Apple store EC</h2>
                <p>Bienvenido! Por favor, ingrese sus datos.</p>
                <div class="nombres">
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
                    <input type="text" name="apellido" id="apellido" placeholder="Apellido" required>
                </div>
                <input type="email" name="email" id="email" placeholder="Correo" required>
                <input type="password" name="pass" id="pass" placeholder="Contraseña" required>
                <input type="password" name="epass" id="epass" placeholder="Confirmar contraseña" required>

                <div class="remember">
                    <input type="file" name="foto" id="foto" required>
                    <label for="recordar">Seleccione una foto de perfil.</label>
                </div>
                <div class="btns">
                    <input type="submit" value="Crear">
                </div>
                <a href="login.php">Ya tienes? Inicia sesión</a>
            </form>
        </div>
    </div>

    <footer>
        <?php
        include("../../global/php/footerPublic.php");
        ?>
    </footer>

</body>

</html>