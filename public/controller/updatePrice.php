<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    if ($_SESSION['rol'] == 'admin') {
        header("Location: ../../admin/admin/view/index.php");
    }
}
include '../../config/configDB.php';
$sqlSubTot = "SELECT SUM(c.car_cantidad*(p.pro_precio-(p.pro_precio*(p.pro_descuento/100)))) AS sub_total FROM carrito c, producto p WHERE 
                c.PRODUCTO_pro_id = p.pro_id AND 
                c.USUARIO_usu_id = " . $_SESSION['codigo'] . ";";

$sqlSubTot = $conn->query($sqlSubTot);
$subTot = $sqlSubTot->fetch_assoc();
$subTotal = $subTot['sub_total'];
$total = $subTotal + ($subTotal * 1.12);

?>
<h2>Detalle</h2>
<div class="price">
    <p><span>Sub-Total: </span>$<?php echo $subTotal ?></p>
    <p><span>IVA: </span>12%</p>
    <p><span>Total: </span>$<?php echo $total ?></p>
</div>
<?php
if ($subTotal > 0) {
    ?>
<div class="btns">
    <button onclick="openWindow()">
        <i class="far fa-credit-card"></i> Tarjeta
    </button>
</div>
<?php
}
?>