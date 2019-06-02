<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    //header("Location: ../admin/index.php");
    if ($_SESSION['rol'] == 'admin') {
        //header("Location: ../admin/index.php");
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
    <script src="../js/funciones.js"></script>
    <title>Carrito</title>
</head>

<body>
    <header>
        <?php
        include("../../global/php/headerPublic.php");
        ?>
    </header>

    <div id="floatWindow">
        <div class="contentWindow" id="payWindow">
            <!-- FORMULARIO  -->
            <div class="form">
                <form action="../controller/payments.php" method="post">
                    <h2>Pagar con tarjeta</h2>
                    <p>Introdisca los datos de su tarjeta</p>
                    <input type="text" name="numbreCard" id="numbreCard" placeholder="1234 1234 1234 1234" required>
                    <div class="nombres">
                        <input type="text" name="dateCard" id="dateCard" placeholder="MM/YY" required>
                        <input type="text" name="cvcCard" id="cvcCard" placeholder="CVC" required>
                    </div>

                    <input type="text" name="nameCard" id="nameCard" placeholder="Nombre del propietario" required>
                    <input type="text" name="countryCard" id="countryCard" placeholder="Pais" required>
                    <div class="btns">
                        <input type="submit" value="Pagar">
                    </div>
                </form>
            </div>

            <!-- ESTADOS DEL PAGO -->
            <!-- <div class="confirmVtn">
                <h2>Gracias por su compra.</h2>
                <p>Pago realizado con exito</p>
                <i class="far fa-check-circle"></i>

                <h2>No se pudo realizar el pago.</h2>
                <i class="far fa-times-circle"></i>

                <div class="btns">
                    <input type="button" value="Inicio" onclick="window.location.href = 'index.html'">
                    <input type="button" value="Ver Compras"
                        onclick="window.location.href = '../../admin/user/view/shoppinghistory.html'">
                </div>
            </div> -->
            <i class=" fas fa-times" onclick="cluseWindow()"></i>
        </div>

    </div>

    <div class="content">
        <section class="product">
            <div class="productSlide cart" id="cart">

                <?php
                //Pendiente query para la tienda 
                include '../../config/configDB.php';
                $sql = "SELECT * FROM carrito WHERE
                        USUARIO_usu_id=" . $_SESSION['codigo'] . ";";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $sqlP = "SELECT * FROM carrito c, producto p, imagen i WHERE
                        p.pro_id = i.PRODUCTO_pro_id AND
                        c.USUARIO_usu_id=" . $_SESSION['codigo'] . " AND
                        p.pro_id=" . $row['PRODUCTO_pro_id'] . "
                        GROUP BY 1;";

                        $resultP = $conn->query($sqlP);
                        $rowP = $resultP->fetch_assoc();
                        ?>

                <article>
                    <div class="cartImg">
                        <img src="../../img/product/<?php echo $rowP['pro_id'] . '/' . $rowP['img_nombre'] ?>"
                            alt="<?php echo $rowP['img_nombre'] ?>">
                    </div>
                    <div class="cartDescription">
                        <h2><?php echo $rowP['pro_nombre'] ?></h2>
                        <h3>Descripcion</h3>
                        <p><?php echo $rowP['pro_descripcion'] ?></p>
                        <div class="inf">
                            <div>
                                <h3>Tienda:</h3>
                                <?php
                                        $sqlSuc = 'SELECT suc_nombre FROM sucursal WHERE suc_id=' . $row['SUCURSAL_suc_id'] . ';';
                                        $resultSuc = $conn->query($sqlSuc);
                                        $rowSuc = $resultSuc->fetch_assoc();
                                        echo '<span>' . $rowSuc['suc_nombre'] . '</span>';
                                        ?>
                            </div>
                            <div>
                                <h3>Cantidad:</h3>
                                <span><?php echo $row['car_cantidad'] ?></span>
                            </div>
                        </div>
                    </div>
                    <span>$<?php echo $rowP['pro_precio'] ?></span>
                    <!--Parametro para eliminar -->
                    <i class="fas fa-times" onclick="cartDelete(<?php echo $row['car_id'] ?>)"></i>
                </article>

                <?php

                }
                //echo '<h2>Si hay productos.</h2>';
            } else {
                echo '<h2 style="color: #FF6565">No hay productos.</h2>';
            }
            ?>

            </div>

            <div class="productInfo bill">
                <div class="billInfo">
                    <div class="nameBill">
                        <?php
                        $sqlUser = "SELECT * FROM usuario, direccion 
                        WHERE usuario.usu_id=direccion.USUARIO_usu_id AND 
                        usuario.usu_id = " . $_SESSION['codigo'] . ";";

                        $sqlUser = $conn->query($sqlUser);

                        $sqlUser = $sqlUser->fetch_assoc();
                        if ($sqlUser['usu_nombres'] != '' && $sqlUser['usu_apellidos'] != '' && $sqlUser['usu_cedula'] != '' && $sqlUser['dir_nombre'] != '' && $sqlUser['dir_calle_principal'] != '' && $sqlUser['dir_calle_secundaria'] != '' && $sqlUser['dir_ciudad'] != '' && $sqlUser['dir_provincia'] != '' && $sqlUser['dir_codigo_postal'] != '') {
                            ?>
                        <h2>Factura</h2>
                        <p><?php echo $sqlUser['usu_nombres'] . ' ' . $sqlUser['usu_apellidos'] ?></p>
                        <span><?php echo $sqlUser['dir_nombre'] . ', ' . $sqlUser['dir_calle_principal'] . ', ' . $sqlUser['dir_calle_secundaria'] ?></span>
                        <span
                            class="data"><?php echo $sqlUser['usu_cedula'] . ', ' . $sqlUser['dir_ciudad'] . ', ' . $sqlUser['dir_provincia'] ?></span>

                        <?php
                            $usuDates = true;
                        } else {
                            $usuDates = false;
                            echo '<h3 style="color: #FF6565">Por favor complete la informacion de su perfil.</h3>';
                            echo '<p>Para continuar con el pago...</p>';
                        }
                        ?>
                    </div>
                    <button onclick="window.location.href = '../../admin/user/view/index.php'">
                        <i class="far fa-edit"></i> Editar
                    </button>
                </div>
                <div class="buydetall" id="buydetall">
                    <?php
                    $sqlSubTot = "SELECT SUM(c.car_cantidad*(p.pro_precio-(p.pro_precio*(p.pro_descuento/100)))) AS sub_total FROM carrito c, producto p WHERE 
                                        c.PRODUCTO_pro_id = p.pro_id AND 
                                        c.USUARIO_usu_id = " . $_SESSION['codigo'] . ";";

                    $sqlSubTot = $conn->query($sqlSubTot);
                    $subTot = $sqlSubTot->fetch_assoc();
                    $subTotal = $subTot['sub_total'];
                    $total = ($subTotal * 1.12);

                    ?>
                    <h2>Detalle</h2>
                    <div class="price">
                        <p><span>Sub-Total: </span>$<?php echo round($subTotal, 2) ?></p>
                        <p><span>IVA: </span>12%</p>
                        <p><span>Total: </span>$<?php echo round($total, 2) ?></p>
                    </div>
                    <?php
                    if ($subTotal > 0 && $usuDates) {
                        ?>
                    <div class="btns">
                        <button onclick="openWindow()">
                            <i class="far fa-credit-card"></i> Tarjeta
                        </button>
                    </div>
                    <?php
                }
                ?>
                </div>
            </div>
        </section>
    </div>

    <footer>
        <?php
        include("../../global/php/footerPublic.php");
        ?>
    </footer>

</body>

</html>