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
    <title>Login</title>
</head>

<body>
    <header>
        <?php
        include("../../global/php/headerPublic.php");
        ?>
    </header>

    <div class="content">
        <div class="form">
            <form action="">
                <h2>Apple store EC</h2>
                <p>Bienvenido! Por favor, ingrese sus datos.</p>
                <input type="email" name="email" id="email" placeholder="Correo" required>
                <input type="password" name="pass" id="pass" placeholder="Contraseña" required>
                <div class="remember">
                    <input type="checkbox" name="recordar" id="recordar">
                    <label for="recordar">Recordarme contraseña</label>
                    <a href="#">Olvide la contraseña</a>
                </div>
                <div class="btns">
                    <input type="submit" value="Iniciar Sesión">
                    <input type="button" value="Registro">
                </div>
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