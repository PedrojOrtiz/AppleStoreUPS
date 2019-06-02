<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    if ($_SESSION['rol'] == 'admin') {
        header("Location: ../../admin/admin/view/index.php");
    }
}
include '../../config/configDB.php';
$sqlStock = "SELECT ps.pro_suc_stock FROM producto p, producto_sucursal ps, sucursal s
                WHERE p.pro_id= ps.PRODUCTO_pro_id AND
                s.suc_id= ps.SUCURSAL_suc_id AND 
                s.suc_id=" . $_GET['idx'] . ";";

$resultStock = $conn->query($sqlStock);
$rowStock = $resultStock->fetch_assoc();
echo $rowStock['pro_suc_stock'];