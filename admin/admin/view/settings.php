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

    $sqlSuc =  "SELECT suc_nombre, suc_telefono, suc_celular, suc_correo
    FROM sucursal
    WHERE suc_id = $sucId";

    $resultSuc=$conn->query($sqlSuc);
    $rowSuc= mysqli_fetch_assoc($resultSuc);

    $nombreAnterior = $rowSuc['suc_nombre'];
    $descripcionAnterior = $rowSuc['suc_telefono'];
    $celularAnterior = $rowSuc['suc_celular'];
    $correoAnterior = $rowSuc['suc_correo'];

    if (!empty($_POST)) {

        $sucNombre = isset($_POST["nombre"]) ? mb_strtoupper(trim($_POST["nombre"]), 'UTF-8') : null; 
        $sucTelefono = isset($_POST["telefono"]) ? mb_strtoupper(trim($_POST["telefono"]), 'UTF-8') : null;        
        $sucCelular = isset($_POST["celular"]) ? mb_strtoupper(trim($_POST["celular"]), 'UTF-8') : null; 
        $sucCorreo = isset($_POST["correo"]) ? mb_strtoupper(trim($_POST["correo"]), 'UTF-8') : null;

        $sqlProducto = "UPDATE sucursal SET
            suc_nombre = '$sucNombre', 
            suc_telefono = '$sucTelefono',
            suc_celular = '$sucCelular',
            suc_correo = '$sucCorreo'
            WHERE suc_id = $sucId";

        if ($conn->query($sqlProducto) === TRUE) {             
            header("Location: index.php");                 
        } else {             
            echo "Error al modificar sucursal";
            echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";           
        }
    }
    $conn->close();
    

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
            <h2>Configuracion Sucursal</h2>
            <div class="content">
                <h2>Sucursal: <?php echo strtoupper($sucNombre) ?></h2>
                <div class="form">
                                
                    <form method="POST" action=""> 
 
                        <label for="nombre">Nombre:</label> 
                        <input type="text" id="nombre" name="nombre" value="<?php echo $nombreAnterior; ?>" placeholder="Nombre..." required>

                        <label for="telefono">Telefono:</label> 
                        <input type="text" id="telefono" name="telefono" value="<?php echo $sucTelefono; ?>" placeholder="Telefono..." required>            

                        <label for="celular">Celular::</label> 
                        <input type="text" id="celular" name="celular" value="<?php echo $celularAnterior; ?>" placeholder="Celular..." required>

                        <label for="correo">Correo:</label> 
                        <input type="text" id="correo" name="correo" value="<?php echo $correoAnterior; ?>" placeholder="Correo..." required>

                        <br>
                        
                        <div class="btns">
                            <input type="submit" value="Modificar">
                        </div>

                    </form>   

                </div>
            </div>
        </section>
    </div>

    

</body>

</html>