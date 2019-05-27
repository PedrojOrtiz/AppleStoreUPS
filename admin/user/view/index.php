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
                    <?php
                    //" . $_SESSION['codigo'] . "
                    include '../../../config/configDB.php';
                    //session_start();

                    $sql = "SELECT * FROM usuario user, imagen img, direccion dir 
                            WHERE user.usu_id = img.USUARIO_usu_id and 
                            user.usu_id = dir.USUARIO_usu_id and
                            user.usu_id=19;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $nombre = $row["usu_nombres"];
                        $apellido = $row["usu_apellidos"];
                        $cedula = $row["usu_cedula"];
                        $telefono = $row["usu_telefono"];
                        $fecha = $row["usu_fecha_nacimiento"];
                        $correo = $row["usu_correo"];
                        $dirNombre = $row["dir_nombre"];
                        $dirCP = $row["dir_calle_principal"];
                        $dirCS = $row["dir_calle_secundaria"];
                        $ciudad = $row["dir_ciudad"];
                        $provincia = $row["dir_provincia"];
                        $img = $row["img_nombre"];
                    } else {
                        $sql = "SELECT * FROM usuario user, imagen img 
                            WHERE user.usu_id = img.USUARIO_usu_id and
                            user.usu_id=19;";

                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();

                        $nombre = $row["usu_nombres"];
                        $apellido = $row["usu_apellidos"];
                        $cedula = $row["usu_cedula"];
                        $telefono = $row["usu_telefono"];
                        $fecha = $row["usu_fecha_nacimiento"];
                        $correo = $row["usu_correo"];
                        $dirNombre = '';
                        $dirCP = '';
                        $dirCS = '';
                        $ciudad = '';
                        $provincia = '';
                        $img = $row["img_nombre"];
                    }

                    $conn->close();
                    ?>
                    <form action="" method="POST">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" value="<?php echo ($nombre); ?>">
                        <label for="apellido">Apellido:</label>
                        <input type="text" name="apellido" id="apellido" value="<?php echo ($apellido); ?>">
                        <label for="cedula">Cedulad:</label>
                        <input type="text" name="cedula" id="cedula" value="<?php echo ($cedula); ?>">
                        <label for="telefono">Telefono:</label>
                        <input type="text" name="telefono" id="telefono" value="<?php echo ($telefono); ?>">
                        <label for="fechaNacimiento">Fecha de nacimiento</label>
                        <input type="date" name="fechaNacimiento" id="fechaNacimiento" value="<?php echo ($fecha); ?>">
                        <label for="dereccion2">Correo</label>
                        <input type="text" name="email" id="email" value="<?php echo ($correo); ?>">
                        <label for="derecNombre">Nombre de direccion</label>
                        <input type="text" name="derecNombre" id="derecNombre" value="<?php echo ($dirNombre); ?>">
                        <label for="derecCalle1">Calle principal</label>
                        <input type="text" name="derecCalle1" id="derecCalle2" value="<?php echo ($dirCP); ?>">
                        <label for="derecCalle2">Calle secundaria</label>
                        <input type="text" name="derecCalle2" id="derecCalle2" value="<?php echo ($dirCS); ?>">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" name="ciudad" id="ciudad" value="<?php echo ($ciudad); ?>">
                        <label for="provincia">Provincia</label>
                        <input type="text" name="provincia" id="provincia" value="<?php echo ($provincia); ?>">

                        <div class="perfilImg">
                            <div class="img">
                                <img src="../../../img/user/<?php echo (19); ?>/<?php echo ($img); ?>" alt="">
                            </div>
                            <label for="perfilImg">Cambiar foto de perfil...</label>
                            <input type="file" name="perfilImg" id="perfilImg">
                        </div>
                        <label class="save" id="save">Guardar cambios...</label>
                        <input type="submit" value="Guardar cambios">
                    </form>

                </div>
            </div>
        </section>
    </div>

    <footer>
        <script src="../js/funciones.js"></script>
        <?php
        include("../../../global/php/footerPublic.php");
        ?>
    </footer>

</body>

</html>