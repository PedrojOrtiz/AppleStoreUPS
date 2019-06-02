<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    //header("Location: ../admin/index.php");
    if ($_SESSION['rol'] == 'admin') {
        //header("Location: ../admin/index.php");
    }
    if (!isset($_GET['fac_cab_id'])) {
        //eroor redirigir 
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../../../public/css/globalStyle.css">

    <title>Factura</title>
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
            <h2>Factura</h2>
            <div class="cardContent invoice">
                <div class="invoiceHeader">
                    <div class="invoiceDetail">
                        <h2>Apple Store EC</h2>
                        <p>Cuenca, Azuay</p>
                        <p>Tel. 0978781341</p>
                    </div>
                    <div class="invoicePrint">
                        <h2>Factura</h2>
                        <button><i class="fas fa-print"></i> Imprimir</button>
                    </div>
                </div>
                <div class="invoiceBody">
                    <div class="ivoiceBodyDetall">
                        <?php
                        include '../../../config/configDB.php';


                        $sql = "SELECT * FROM factura_cabecera fc, usuario u, direccion d
                        WHERE fc.USUARIO_usu_id=u.usu_id AND
                        d.USUARIO_usu_id = u.usu_id AND
                        fc.fac_cab_id=" . $_GET['fac_cab_id'] . ";";

                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $result = $result->fetch_assoc();
                            ?>
                        <div class="invoiceDetailTo">
                            <h3>Factura a:</h3>
                            <p><span><?php echo $result['usu_nombres'] ?></span>
                                <span><?php echo $result['usu_apellidos'] ?></span></p>
                            <p>Cl. <span><?php echo $result['usu_cedula'] ?></span></p>
                            <p><?php echo $result['dir_nombre'] . ', ' . $result['dir_calle_principal'] . ', ' . $result['dir_calle_secundaria'] ?>
                            </p>
                            <p>Tel. <span><?php echo $result['usu_telefono'] ?></span></p>
                        </div>
                        <div class="invoiceDetailStatus">
                            <p><span>Fecha: </span><?php echo $result['fac_cab_fecha'] ?></p>
                            <p><span>Status: </span><span class="status"><?php echo $result['fac_cab_estado'] ?></span>
                            </p>
                            <p><span>Codigo de orden: </span><?php echo $result['fac_cab_id'] ?></p>
                        </div>
                        <?php
                    } else {
                        //redirigir
                    }
                    ?>
                    </div>

                    <article>
                        <table>
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Producto</td>
                                    <td>Descripcion</td>
                                    <td>Tienda</td>
                                    <td>Cantidad</td>
                                    <td>Precio</td>
                                    <td>Rutas</td>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <td colspan="10">
                                        <div class="links">
                                            <a href="#"><i class="fas fa-angle-left"></i></a>
                                            <a class="active" href="#">1</a>
                                            <a href="#">2</a>
                                            <a href="#">3</a>
                                            <a href="#">4</a>
                                            <a href="#"><i class="fas fa-chevron-right"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>

                            <div id="floatWindow">
                                <div class="contentMap">
                                    <i class="fas fa-times" onclick="cluseWindow()"></i>
                                    <div id="map"></div>
                                </div>
                            </div>

                            <tbody>
                                <?php
                                $sql = "SELECT * FROM factura_detalle fd, factura_cabecera fc, producto pro, sucursal suc, imagen img
                                        WHERE fd.FACTURA_CABECERA_fac_cab_id = fc.fac_cab_id AND
                                                fd.PRODUCTO_pro_id=pro.pro_id AND
                                                fd.SUCURSAL_suc_id = suc.suc_id AND
                                                img.PRODUCTO_pro_id = pro.pro_id AND
                                                fc.fac_cab_id=" . $_GET['fac_cab_id'] . "
                                                GROUP BY suc.suc_id;";

                                $resultDet = $conn->query($sql);
                                $i = 1;
                                if ($resultDet->num_rows > 0) {
                                    while ($row = $resultDet->fetch_assoc()) {

                                        ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><a
                                            href="../../../public/view/product.php?producto=<?php echo $row['pro_id']; ?>">
                                            <img src="../../../img/product/<?php echo $row['pro_id']; ?>/<?php echo $row['img_nombre']; ?>"
                                                alt="<?php echo $row['img_nombre']; ?>">
                                            <p><?php echo $row['pro_nombre']; ?></p>
                                        </a>
                                    </td>
                                    <td><?php echo $row['pro_descripcion']; ?></td>
                                    <td><a
                                            href="../../../public/view/<?php echo $row['suc_url']; ?>"><?php echo $row['suc_nombre']; ?></a>
                                    </td>
                                    <td><?php echo $row['fac_det_cantidad']; ?></td>

                                    <?php
                                            $sqlSubTot = "SELECT SUM(c.car_cantidad*(p.pro_precio-(p.pro_precio*(p.pro_descuento/100)))) AS sub_total FROM carrito c, producto p WHERE 
                                                            c.PRODUCTO_pro_id = p.pro_id AND 
                                                            c.USUARIO_usu_id = " . $_SESSION['codigo'] . ";";

                                            $sqlSubTot = $conn->query($sqlSubTot);
                                            $subTot = $sqlSubTot->fetch_assoc();
                                            ?>

                                    <td>$ <?php echo round($subTot['sub_total'], 2); ?></td>
                                    <!--CAMBIAR LA DIRECCION START A UNA REAL-->

                                    <td><a onclick="mapDirection(<?php echo $row['suc_id'] ?>)">Ver ruta</a>
                                    </td>
                                </tr>

                                <?php
                                        $i = $i + 1;
                                    }
                                } else {
                                    //error redirigir
                                }
                                ?>
                                <div id="mapDir">
                                    <input id="start" type="hidden" name="" value="Gualaceo">
                                    <input id="end" type="hidden" name="" value="Cuenca">
                                </div>

                                <!-- <tr>
                                    <td>1</td>
                                    <td><a href="">
                                            <img src="../../../img/product/producto.jpg" alt="">
                                            <p>Lorem</p>
                                        </a>
                                    </td>
                                    <td>Este es el de la prueba de mapa.</td>
                                    <td><a href="">Guayaquil</a></td>
                                    <td>4</td>
                                    <td>$700.00</td>
                                    <td><a onclick="openWindow()">Ver ruta</a>
                                    </td>

                                </tr> -->

                            </tbody>
                        </table>
                    </article>
                    <div class="invoiceFooter">
                        <p><span>Sub-total: </span> $<?php echo round($result['fac_cab_subtotal'], 2) ?></p>
                        <p><span>IVA: </span> 12%</p>
                        <h2>USD <?php echo round($result['fac_cab_total'], 2) ?></h2>
                        <button id="cancelar"
                            onclick="window.location.href = '../controller/deleteInvoice.php?fac_cab_id=<?php echo $_GET['fac_cab_id'] ?>'">Eliminar</button>
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
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWSPPYtqD1tZgvQ-pPzLRXttQoVCOM9Jc&callback&callback=initMap">
    </script>
    <script src="../js/map.js"></script>

</body>

</html>