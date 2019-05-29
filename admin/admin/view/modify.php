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
    <title>Perfil</title>
</head>

<body>
    <header>
        <div class="content">        
            <div class="sessionItems">
                    <div class="header">
                        <ul class="nav">
                            <li> <a>Nombre Apellido</a>
                                <ul>
                                    <li><a href="modify.php">Ajustes</a></li>
                                    <li><a href="logout.php">Cerrar Sesion</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <div class="imgUser">
                    <img src="../../../img/user/perfil.jpg" alt="user">
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
            <h2>Modificar Datos Administrador</h2>
            <div class="cardContent">
            <h2>Cambiar Contraseña</h2>
                    <form class="box" method="POST" action="../../controladores/admin/cambiar_contrasena.php?codigo_admin=<?php echo $codigo_admin ?>">
                        <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>">
                    
                        <label class="contrasena" for="contrasenaActual">Contraseña Antigua</label>
                        <input type="password" id="contrasena1" name="contrasena1" value="" required placeholder="">
                        <br>
                        <label class="contrasena" for="contrasenaNueva">Contraseña Nueva</label>
                        <input type="password" id="contrasena2" name="contrasena2" value="" required placeholder="">
                        <br>
                        <label class="contrasena" for="contrasenaNueva">Confirmar Contraseña</label>
                        <input type="password" id="contrasena3" name="contrasena3" value="" required placeholder="">
                        <br>

                        <input class="boton" type="submit" id="confirmar" name="confirmar" value="Confirmar">
                    </form>
            </div>
        </section>
    </div>

    

</body>

</html>