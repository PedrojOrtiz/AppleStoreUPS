<?php 

    include '../../../config/configDB.php';

    session_start();

    if (isset($_SESSION['codigo']))
        $id=$_SESSION['codigo'];

    if($_SESSION["rol"] != "admin")
        header("Location: ../controller/logout.php");

    $idOrd = $_REQUEST['idO'];
    $idUsu = $_REQUEST['idU'];

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

    $sucId = $rowSucursal['suc_id'];
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
    <title>Productos</title>
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
                    <li><a href="../view/index.php"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="../view/orders.php"><i class="fas fa-chart-bar"></i> Ordenes</a></li>
                    <li><a href="../view/inbox.php"><i class="far fa-envelope"></i> Mensajes</a></li>
                    <li><a href="../view/products.php"><i class="fa fa-barcode"></i> Productos</a></li>
                    <li><a href="../view/clients.php"><i class="fas fa-users"></i> Clientes</a></li>
                    <li><a href="../view/settings.php"><i class="fas fa-cog"></i> Configuracion</a></li>
                </ul>
            </nav>
        </header>
        <section>
            <h2>Ver Orden</h2>
            <div class="content">
                <h2>Sucursal: <?php echo strtoupper($sucNombre) ?></h2>
                <div class="form">
                                

                <h2>Factura</h2>
            <div class="cardContent invoice">
                <div class="invoiceHeader">
                    <div class="invoicePrint">
                        <h2>Factura</h2>
                    </div>
                </div>
                <div class="invoiceBody">
                    <div class="ivoiceBodyDetall">
                        <?php


                        $sql = "SELECT * FROM factura_cabecera fc, usuario u, direccion d
                        WHERE fc.USUARIO_usu_id = $idUsu AND
                        d.USUARIO_usu_id = $idUsu AND
                        fc.fac_cab_id = $idOrd";

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

                            <colgroup>
                                <col style='width: 5%'>
                                <col style='width: 5%'>
                                <col style='width: 5%'>
                                <col style='width: 5%'>
                                <col style='width: 5%'>
                                <col style='width: 5%'>
                                <col style='width: 5%'>
                            </colgroup>
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
                                                fc.fac_cab_id = $idOrd
                                                GROUP BY suc.suc_id";

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
                                    <td>$<?php echo $row['pro_precio']; ?></td>

                                    
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
                        <h2>USD <?php echo round($result['fac_cab_total'], 2) 
                        //$conn->close();
                        ?></h2>
                    </div>
                </div>
            </div>


                </div>
            </div>
        </section>
    </div>

    

</body>

</html>