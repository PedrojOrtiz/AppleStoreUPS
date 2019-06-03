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
                                    <li><a href="#">Ajustes</a></li>
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
            <h2>Inicio</h2>
            <div class="cardContent">
                <h2>Sucursal: <?php echo strtoupper($sucNombre) ?></h2>
                <div class="formData">
                <h3>Ordenes Pendientes</h3>
                    <table id="productos">

                        <colgroup>
                            <col style='width: 5%'>
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
                                <th>#</th>
                                <th>Nombre</th>
                                <th>CI/RUC</th>
                                <th>Metodo de pago</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody id="tableHistory">
                            <?php

                                $sqlOrd = "SELECT fc.fac_cab_id, fc.fac_cab_metodo_pago, fc.USUARIO_usu_id, fc.fac_cab_estado, fc.fac_cab_total, fc.fac_cab_fecha
                                            FROM factura_detalle fd, factura_cabecera fc
                                            WHERE fd.FACTURA_CABECERA_fac_cab_id = fc.fac_cab_id AND
                                                fd.SUCURSAL_suc_id = $sucId AND fc.fac_cab_estado LIKE 'pendiente'
                                            GROUP BY fc.fac_cab_id
                                            ORDER BY fc.fac_cab_fecha DESC";

                                $resultOrd = $conn->query($sqlOrd);
                                $i = 1;
                                if ($resultOrd->num_rows > 0) {
                                    $sumTotal = 0;
                                    while ($rowOrd = $resultOrd->fetch_assoc()) {
                                        $usuId = $rowOrd['USUARIO_usu_id'];
                                        $sqlU = "SELECT * FROM usuario WHERE usu_id = $usuId";
                                        $resultU = $conn->query($sqlU);
                                        $rowU = mysqli_fetch_assoc($resultU);

                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo strtoupper($rowU['usu_nombres'])?> <?php echo strtoupper($rowU['usu_apellidos'])?></td>
                                <td><?php echo $rowU['usu_cedula'] ?></td>
                                <td><?php echo $rowOrd['fac_cab_metodo_pago'] ?></td>
                                <td>$<?php echo $rowOrd['fac_cab_total'] ?></td>
                                <td><?php echo $rowOrd['fac_cab_estado'] ?></td>
                                <td><?php echo $rowOrd['fac_cab_fecha'] ?></td>
                                <td><a href="../controller/ver_orden.php?idO=<?php echo $rowOrd['fac_cab_id']?>&idU=<?php echo $rowU['usu_id']?>">Ver orden</a></td>
                            </tr>
                            <?php
                                        $i = $i + 1;
                                        $sumTotal = $sumTotal + $rowOrd['fac_cab_total'];
                                    }
                                    echo "
                                    
                                    <tr>
                                        <td colspan='7'> Total </td>
                                        <td> $sumTotal </td>
                                    </tr>
                                    
                                    ";
                                } else {
                                    echo '<td colspan="7"><h2>No hay facturas que mostrar</h2></td>';
                                }

                                $conn->close();

                            ?>

                        </tbody>
                    </table>
                    


                </div>
            </div>
        </section>
    </div>

    

</body>

</html>