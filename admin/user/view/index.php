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
    <title>Perfil</title>
</head>

<body>
    <header>
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
            <h2>Perfil</h2>
            <div class="cardContent">
                <h2>Datos personales</h2>
                <div class="formData">
                    <form action="" method="POST">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" value="Richard">
                        <label for="apellido">Apellido:</label>
                        <input type="text" name="apellido" id="apellido" value="Torres">
                        <label for="cedula">Cedulad:</label>
                        <input type="text" name="cedula" id="cedula" value="0106464456">
                        <label for="telefono">Telefono:</label>
                        <input type="text" name="telefono" id="telefono" value="0992631254">
                        <label for="fechaNacimiento">Fecha de nacimiento</label>
                        <input type="date" name="fechaNacimiento" id="fechaNacimiento" value="03/28/1993">
                        <label for="dereccion1">Direccion 1</label>
                        <input type="text" name="dereccion1" id="dereccion1" value="Av. Jaime Roldos y 3 de Noviembre">
                        <label for="dereccion2">Direccion 2</label>
                        <input type="text" name="dereccion2" id="dereccion2" value="">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" name="ciudad" id="ciudad" value="Cuenca">
                        <label for="provincia">Provincia</label>
                        <input type="text" name="provincia" id="provincia" value="Azuay">
                        <label class="save" id="save">Guardar cambios...</label>
                        <input type="submit" value="Guardar cambios">
                    </form>
                    <div class="perfilImg">
                        <div class="img">
                            <img src="../../../img/user/perfil.jpg" alt="">
                        </div>
                        <label for="perfilImg">Cambiar foto de perfil...</label>
                        <input type="file" name="perfilImg" id="perfilImg">
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