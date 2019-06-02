<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    if ($_SESSION['rol'] == 'admin') {
        header("Location: ../../admin/admin/view/index.php");
    }
} else {
    header("Location: ../view/index.php");
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
    <title>Successful4</title>
</head>

<body>
    <header>
        <?php
        //echo (getcwd());
        include("../../global/php/headerPublic.php");
        ?>
    </header>

    <div class="headerImg pageError pageSuccess">
        <?php
        include '../../config/configDB.php';

        $cardNumber = isset($_POST["numbreCard"]) ? trim($_POST["numbreCard"]) : null;
        $dateCard = isset($_POST["email"]) ? trim($_POST["email"]) : null;
        $cvcCard = isset($_POST["cvcCard"]) ? trim($_POST["cvcCard"]) : null;
        $nameCard = isset($_POST["nameCard"]) ? mb_strtolower(trim($_POST["nameCard"]), 'UTF-8') : null;
        $countryCard = isset($_POST["countryCard"]) ? mb_strtolower(trim($_POST["countryCard"]), 'UTF-8') : null;
        $date = date(date("Y-m-d H:i:s"));

        //echo 'NUMERO DE TARJETA' . $cardNumber . '<br>';

        $sql = "SELECT * FROM tarjeta WHERE
            USUARIO_usu_id=" . $_SESSION['codigo'] . ";";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $sqlCard = "UPDATE tarjeta SET
            tar_nombre='$nameCard',
            tar_numero='$cardNumber',
            tar_fecha_exp='$dateCard',
            tar_codigo_seguridad='$cvcCard',
            tar_pais='$countryCard'
            WHERE tar_id=" . $row['tar_id'] . ";";
        } else {
            $sqlCard = "INSERT INTO tarjeta (
        tar_tipo, 
        tar_nombre,  
        tar_numero, 
        tar_fecha_exp, 
        tar_codigo_seguridad, 
        tar_pais,
        USUARIO_usu_id) VALUES (  
        'visa', 
        '$nameCard', 
        '$cardNumber', 
        '$dateCard', 
        '$cvcCard',
        '$countryCard',
        " . $_SESSION['codigo'] . ");";
        }
        if ($conn->query($sqlCard)) {

            $sqlCart = "SELECT * FROM carrito WHERE
                        USUARIO_usu_id=" . $_SESSION['codigo'] . ";";

            $resultCart = $conn->query($sqlCart);
            //echo 'Datos del carrito. ' . $resultCart->num_rows;
            if ($resultCart->num_rows > 0) {

                $sqlTarUsu = "SELECT * FROM tarjeta WHERE
                                USUARIO_usu_id=" . $_SESSION['codigo'] . ";";
                $sqlTarUsu = $conn->query($sqlTarUsu);
                $sqlTarUsu = $sqlTarUsu->fetch_assoc();
                $cardUser = $sqlTarUsu['tar_id'];
                //echo 'Tarjeta usuario' . $cardUser;

                $sqlSubTot = "SELECT SUM(c.car_cantidad*(p.pro_precio-(p.pro_precio*(p.pro_descuento/100)))) AS sub_total FROM carrito c, producto p WHERE 
                        c.PRODUCTO_pro_id = p.pro_id AND 
                        c.USUARIO_usu_id = " . $_SESSION['codigo'] . ";";
                $sqlSubTot = $conn->query($sqlSubTot);
                $subTot = $sqlSubTot->fetch_assoc();
                $subTotal = $subTot['sub_total'];

                // echo 'SUBTOTAL: ' . $subTotal . '<br>';
                $total = ($subTotal * 1.12);
                // echo 'TOTAL: ' . $total . '<br>';

                $sqlCabFact = "INSERT INTO factura_cabecera (
                        fac_cab_metodo_pago,  
                        fac_cab_fecha, 
                        fac_cab_subtotal, 
                        fac_cab_total, 
                        TARJETA_tar_id, 
                        USUARIO_usu_id) VALUES (  
                        'tarjeta', 
                        '$date', 
                        '$subTotal', 
                        '$total', 
                        '$cardUser',
                        " . $_SESSION['codigo'] . ");";

                $sql = "SELECT MAX(fac_cab_id) AS codigo  
                FROM factura_cabecera;";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $codigoNewFacCab = ($row['codigo']);
                //echo 'Codigo de la cabecera.' . $codigoNewFacCab;

                if ($conn->query($sqlCabFact)) {
                    while ($rowCart = $resultCart->fetch_assoc()) {
                        $sqlDetFact = "INSERT INTO factura_detalle (
                                fac_det_cantidad, 
                                PRODUCTO_pro_id,  
                                SUCURSAL_suc_id, 
                                FACTURA_CABECERA_fac_cab_id) 
                                VALUES (  
                                " . $rowCart['car_cantidad'] . ", 
                                " . $rowCart['PRODUCTO_pro_id'] . ", 
                                " . $rowCart['SUCURSAL_suc_id'] . ", 
                                '$codigoNewFacCab');";

                        if ($conn->query($sqlDetFact)) {
                            $sql = "SELECT pro_suc_stock  
                            FROM producto_sucursal
                            WHERE PRODUCTO_pro_id=" . $rowCart['PRODUCTO_pro_id'] . " AND
                            SUCURSAL_suc_id=" . $rowCart['SUCURSAL_suc_id'] . ";";

                            $result = $conn->query($sql);
                            $rowStok = $result->fetch_assoc();
                            $rowStok = $rowStok['pro_suc_stock'] - 1;

                            //echo 'detalle agregado <br>';
                            $sqlStok = "UPDATE producto_sucursal SET
                                pro_suc_stock='$rowStok'
                                WHERE PRODUCTO_pro_id=" . $rowCart['PRODUCTO_pro_id'] . " AND
                                SUCURSAL_suc_id=" . $rowCart['SUCURSAL_suc_id'] . ";";
                            $conn->query($sqlStok);

                            $sqlDropCart = "DELETE FROM carrito WHERE USUARIO_usu_id =" . $_SESSION['codigo'] . ";";
                            $conn->query($sqlDropCart);


                            //echo 'Detalle agregado stok en: ' . $rowStok . '<br>';
                        } else {
                            ?>
        <div class="contentSucce">
            <h2>Error al agregar los datos.</h2>
            <p>Intente de nuevo...</p>
            <i class="far fa-times-circle"></i>
            <button onclick="window.location.href = '../view/shoppingcart.php'">Inicio</button>
        </div>
        <?php
                    }
                }

                $conn->close();
                ?>
        <div class="contentSucce">
            <h2>Pago realizado con exito</h2>
            <p>Gracias por su compra..</p>
            <i class="far fa-check-circle"></i>
            <button onclick="window.location.href = '../view/index.php'">Inicio</button>
        </div>
        <?php
            } else {
                ?>
        <div class="contentSucce">
            <h2>Error al agregar los datos.</h2>
            <p>Intente de nuevo...</p>
            <i class="far fa-times-circle"></i>
            <button onclick="window.location.href = '../view/shoppingcart.php'">Inicio</button>
        </div>
        <?php
                //echo 'error al introducir la cabecera';
                //echo mysqli_error($conn);
            }
        } else {
            ?>
        <div class="contentSucce">
            <h2>Error al agregar los datos.</h2>
            <p>Intente de nuevo...</p>
            <i class="far fa-times-circle"></i>
            <button onclick="window.location.href = '../view/shoppingcart.php'">Inicio</button>
        </div>
        <?php
        }
    } else {
        ?>
        <div class="contentSucce">
            <h2>La tarjeta no es correcta.</h2>
            <p>Intente de nuevo...</p>
            <i class="far fa-times-circle"></i>
            <button onclick="window.location.href = '../view/shoppingcart.php'">Inicio</button>
        </div>
        <?php
    }
    ?>

    </div>
    <footer>
        <?php
        //echo (getcwd());
        include("../../global/php/footerPublic.php");
        ?>
    </footer>

</body>

</html>
</body>

</html>