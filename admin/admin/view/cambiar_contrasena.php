<?php 

    include '../../../config/configDB.php';

    session_start();

    if (isset($_SESSION['codigo']))
        $id=$_SESSION['codigo'];

    if($_SESSION["rol"] != "admin")
        header("Location: ../controller/logout.php");

    $sqlUsuario = "SELECT * FROM usuario user, imagen img WHERE user.usu_id = $id AND img.USUARIO_usu_id = $id";

    $resultUsuario = $conn->query($sqlUsuario);
    $rowUsuario = mysqli_fetch_assoc($resultUsuario);

    $nombres = $rowUsuario['usu_nombres'];
    $apellidos = $rowUsuario['usu_apellidos'];
    $img = $rowUsuario['img_nombre'];

    $sucId = $rowUsuario['SUCURSAL_suc_id'];

    $sqlSucursal = "SELECT * FROM sucursal suc WHERE suc.suc_id = $sucId";

    $resultSucursal = $conn->query($sqlSucursal);
    $rowSucursal = mysqli_fetch_assoc($resultSucursal);

    $sucNombre = $rowSucursal['suc_nombre'];
    $sucTelefono = $rowSucursal['suc_telefono'];
    $sucCelular = $rowSucursal['suc_celular'];
    $sucUrl = $rowSucursal['suc_url'];
    $sucEliminado = $rowSucursal['suc_eliminado'];

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
    <link rel="stylesheet" href="../css/globalStyle.css">
    <link rel="stylesheet" href="../css/style2.css">
    <title>Perfil</title>
</head>

<body>
    <header>
        <div class="content">        
            <div class="sessionItems">
                    <div class="header">
                        <ul class="nav">
                            <li> <a><?php echo strtoupper($nombres) ?> <?php echo strtoupper($apellidos) ?></a>
                                <ul>
                                    <li><a href="modify.php">Ajustes</a></li>
                                    <li><a href="../controller/logout.php">Cerrar Sesion</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <div class="imgUser">
                    <img src="../../../img/user/<?php echo $id; ?>/<?php echo ($img); ?>" alt="">
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <header>
            <div class="perfil">
                <li><a>APPLE STORE EC</a></li>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="orders.php"><i class="fas fa-chart-bar"></i> Ordenes</a></li>
                    <li><a href="inbox.php"><i class="far fa-envelope"></i> Mensajes</a></li>
                    <li><a href="products.php"><i class="fa fa-barcode"></i> Productos</a></li>
                    <li><a href="clients.php"><i class="fas fa-users"></i> Clientes</a></li>
                    <li><a href="settings.php"><i class="fas fa-cog"></i> Configuracion</a></li>
                </ul>
            </nav>
        </header>
        <section>
            <h2>Cambiar Contraseña</h2>
            <div class="cardContent">
        <?php
            $codigo = $_GET["codigo"];
        ?>
        <form class="box" method="POST" action="../controller/cambiar_contrasena.php?codigo=<?php echo $codigo ?>">
            <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>">

            <label class="contrasena" for="contrasenaActual">Contrasena Actual (*)</label>
            <input type="password" id="contrasena1" name="contrasena1" value="" required placeholder="Ingrese su contrasena actual...">
            <br>

            <label class="contrasena" for="contrasenaNueva">Contrasena Nueva (*)</label>
            <input type="password" id="contrasena2" name="contrasena2" value="" required placeholder="Ingrese su contrasena nueva...">
            <br>

            <input class="boton" type="submit" id="modificar" name="modificar" value="Modificar">
            <input type="button" id="cancelar" name="cancelar" value="Cancelar" onclick="location.href='clients.php?codigo=<?php echo $codigo ?>'" class="boton">
        </form>
        </div>
        </section>
    </body>
</html>