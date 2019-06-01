<?php
session_start();
//Pendiente query para la tienda 
if (isset($_GET['carId'])) {
    include '../../config/configDB.php';
    $sql = "SELECT * FROM carrito WHERE 
    car_id=" . $_GET['carId'] . ";";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['car_cantidad'] > 1) {
        $cantidad = $row['car_cantidad'] - 1;
        $sql = "UPDATE carrito SET
                    car_cantidad ='$cantidad'
                    WHERE car_id=" . $_GET['carId'] . ";";
        $conn->query($sql);
        writeContent();
    } elseif ($row['car_cantidad'] <= 1) {
        $sqlDropCart = "DELETE FROM carrito WHERE car_id=" . $_GET['carId'] . ";";
        $conn->query($sqlDropCart);
        writeContent();
    }
} else {
    echo '<h2>No hay la variable.</h2>';
}

function writeContent()
{
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
    echo '<h2>No hay productos.</h2>';
}
}