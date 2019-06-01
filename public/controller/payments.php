<?php
session_start();
include '../../config/configDB.php';

$cardNumber = isset($_POST["numbreCard"]) ? trim($_POST["numbreCard"]) : null;
$dateCard = isset($_POST["email"]) ? trim($_POST["email"]) : null;
$cvcCard = isset($_POST["cvcCard"]) ? trim($_POST["cvcCard"]) : null;
$nameCard = isset($_POST["nameCard"]) ? mb_strtolower(trim($_POST["nameCard"]), 'UTF-8') : null;
$countryCard = isset($_POST["countryCard"]) ? mb_strtolower(trim($_POST["countryCard"]), 'UTF-8') : null;
$date = date(date("Y-m-d H:i:s"));

echo 'NUMERO DE TARJETA' . $cardNumber . '<br>';

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

        echo 'SUBTOTAL: ' . $subTotal . '<br>';
        $total = $subTotal + ($subTotal * 1.12);
        echo 'TOTAL: ' . $total . '<br>';

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

                    echo 'detalle agregado <br>';
                    $sqlStok = "UPDATE producto_sucursal SET
                                pro_suc_stock='$rowStok'
                                WHERE PRODUCTO_pro_id=" . $rowCart['PRODUCTO_pro_id'] . " AND
                                SUCURSAL_suc_id=" . $rowCart['SUCURSAL_suc_id'] . ";";
                    $conn->query($sqlStok);

                    $sqlDropCart = "DELETE FROM carrito WHERE USUARIO_usu_id =" . $_SESSION['codigo'] . ";";
                    $conn->query($sqlDropCart);


                    echo 'Detalle agregado stok en: ' . $rowStok . '<br>';
                } else {
                    echo 'ecrror al agregar el detalle';
                    echo mysqli_error($conn);
                }
            }

            $conn->close();
            echo 'Pago realizado con exito <br>';
        } else {
            echo 'error al introducir la cabecera';
            echo mysqli_error($conn);
        }
    } else {
        echo 'No hay datos en el carrito';
    }
} else {
    echo 'La tarjeta no pudo ser agregada';
    echo mysqli_error($conn);
}