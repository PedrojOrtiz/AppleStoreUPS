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
    <link rel="stylesheet" href="../../../public/css/globalStyle.css">
    <link rel="stylesheet" href="../../../public/css/generalStyle.css">
    <title>Successful4</title>
</head>

<body>
    <header>
        <div class="content">
            <a href="../../../index.php"><i class="fab fa-apple"></i></a>
            <nav class="menu">
                <ul>
                    <li><a href="../../../index.php">Inicio</a></li>
                    <li> <span>Productos</span> <i class="fas fa-sort-down"></i>
                        <ul>
                            <li><a href="../../../public/view/search.php?searchCat=mac">Mac</a></li>
                            <li><a href="../../../public/view/search.php?searchCat=ipad">iPad</a></li>
                            <li><a href="../../../public/view/search.php?searchCat=iphone">iPhone</a></li>
                            <li><a href="../../../public/view/search.php?searchCat=watch">Watch</a></li>
                            <li><a href="../../../public/view/search.php?searchCat=tv">TV</a></li>
                            <li><a href="../../../public/view/search.php?searchCat=musica">Musica</a></li>
                            <li><a href="../../../public/view/search.php?searchCat=accesorios">Accesorios</a></li>
                        </ul>
                    </li>
                    <li> <span>Donde Comprar</span> <i class="fas fa-sort-down"></i>
                        <ul>
                            <!-- <?php __FILE__ ?>../../ -->
                            <li><a href="../../../public/view/storequito.php">Quito</a></li>
                            <li><a href="../../../public/view/storeguayaquil.php">Guayaquil</a></li>
                            <li><a href="../../../public/view/storecuenca.php">Cuenca</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="search">
                <div class="barSearch">
                    <input type="search" name="search" id="search" placeholder="Buscar">
                    <i class="fas fa-search"></i>
                </div>
                <a onclick="searchBtn()">Buscar</a>
            </div>
            <!-- <div class="buyCar itemsUser">
        <a href="../../../public/view/shoppingcart.php"><i class="fas fa-shopping-cart"></i></a>
    </div> -->
            <div class="sessionItems">
                <?php
                if (isset($_SESSION['isLogin'])) {
                    ?>
                <script>
                carNot('../../../public/controller/updateNotCart.php')
                </script>
                <div class="imgUser">
                    <a href="../../../public/view/shoppingcart.php"><i class="fas fa-shopping-cart"
                            id="fa-shopping-cart"></i></a>
                    <img src="../../../img/user/<?php echo $_SESSION['codigo']; ?>/<?php echo $_SESSION['img']; ?>"
                        alt="<?php echo $_SESSION['img']; ?>">
                </div>
                <nav class="menu perfil">
                    <ul>
                        <li><span><?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido']; ?></span> <i
                                class="fas fa-sort-down"></i>
                            <ul>
                                <li><a href="../view/index.php">Perfil</a>
                                </li>
                                <li><a href="../view/shoppinghistory.php">Historial</a>
                                </li>
                                <li><a href="../view/settings.php">Opciones</a></li>
                                <li><a href="../../../config/signout.php">Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>

                <?php
            } else {
                echo '<a href="login.php">Iniciar Sesión</a>';
                echo '<a href="signup.php">Registrarse</a>';
            }
            ?>
            </div>
    </header>

    <div class="headerImg pageError pageSuccess">
        <?php
        include '../../../config/configDB.php';
        $oldpass = isset($_POST["oldpass"]) ? trim($_POST["oldpass"]) : null;
        $newpass = isset($_POST["newpass"]) ? trim($_POST["newpass"]) : null;
        $repeatpass = isset($_POST["repeatpass"]) ? trim($_POST["repeatpass"]) : null;
        $date = date(date("Y-m-d H:i:s"));

        $sql = "SELECT usu_password FROM usuario WHERE usu_id=" . $_SESSION['codigo'] . ";";
        $result = $conn->query($sql);
        $resultP = $result->fetch_assoc();


        if (MD5($oldpass) == $resultP["usu_password"]) {
            if ($newpass == $repeatpass) {
                $sql = "UPDATE usuario SET 
                usu_password = MD5('$newpass'), 
                usu_fecha_modificacion='$date'   
                WHERE usu_id=" . $_SESSION['codigo'] . ";";

                if ($conn->query($sql)) {
                    ?>
        <div class="contentSucce">
            <h2>Contraseña actualizada con exito.</h2>
            <i class="far fa-check-circle"></i>
            <button onclick="window.location.href = '../view/settings.php'">Regresar</button>
        </div>
        <?php
            } else {
                ?>
        <div class="contentSucce">
            <h2>Error al actializar los datos.</h2>
            <p><?php echo mysqli_error($conn) ?></p>
            <p>Intente de nuevo...</p>
            <i class="far fa-times-circle"></i>
            <button onclick="window.location.href = '../view/settings.php'">Regresar</button>
        </div>
        <?php
            }
        } else {
            ?>
        <div class="contentSucce">
            <h2>Las contraseñas no coinciden.</h2>
            <p>Intente de nuevo...</p>
            <i class="far fa-times-circle"></i>
            <button onclick="window.location.href = '../view/settings.php'">Regresar</button>
        </div>
        <?php
        }
    } else {
        ?>
        <div class="contentSucce">
            <h2>La contraseña no existe en el sistema.</h2>
            <p>Intente de nuevo...</p>
            <i class="far fa-times-circle"></i>
            <button onclick="window.location.href = '../view/settings.php'">Regresar</button>
        </div>
        <?php
    }
    $conn->close();

    ?>
    </div>
    <footer>
        <?php
        //echo (getcwd());
        include("../../../global/php/footerPublic.php");
        ?>
    </footer>

</body>

</html>
</body>

</html>