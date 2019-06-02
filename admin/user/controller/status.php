<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    if ($_SESSION['rol'] == 'admin') {
        header("Location: ../../admin/view/index.php");
    }
} else {
    header("Location: ../../../index.php");
}
include '../../../config/configDB.php';
if (isset($_GET['idx'])) {

    if ($_GET['idx'] == 'todo') {

        $sql = "SELECT * FROM factura_cabecera
                                    WHERE USUARIO_usu_id=" . $_SESSION['codigo'] . " AND
                                    fac_cab_eliminado=0;";

        $result = $conn->query($sql);
        $i = 1;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
<tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['fac_cab_id'] ?></td>
    <td><?php echo $row['fac_cab_metodo_pago'] ?></td>
    <td>$<?php echo $row['fac_cab_total'] ?></td>
    <?php
                    if ($row['fac_cab_estado'] == 'pendiente') {
                        echo "<td><span>" . $row['fac_cab_estado'] . "</span></td>";
                    } else {
                        echo '<td><span style="background-color: #69E4A6" >' . $row['fac_cab_estado'] . '</span></td>';
                    }
                    ?>

    <td><?php echo $row['fac_cab_fecha'] ?></td>
    <td><a href="invoice.php?fac_cab_id=<?php echo $row['fac_cab_id'] ?>">Ver orden</a>
    </td>
</tr>
<?php
                $i = $i + 1;
            }
        } else {
            echo '<td colspan="7"><h2>No hay facturas que mostrar</h2></td>';
        }
    } else {
        $sql = "SELECT * FROM factura_cabecera
                                    WHERE USUARIO_usu_id=" . $_SESSION['codigo'] . " AND
                                    fac_cab_eliminado=0 AND
                                    fac_cab_estado='" . $_GET['idx'] . "';";

        $result = $conn->query($sql);
        $i = 1;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
<tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['fac_cab_id'] ?></td>
    <td><?php echo $row['fac_cab_metodo_pago'] ?></td>
    <td>$<?php echo $row['fac_cab_total'] ?></td>
    <?php
                    if ($row['fac_cab_estado'] == 'pendiente') {
                        echo "<td><span>" . $row['fac_cab_estado'] . "</span></td>";
                    } else {
                        echo '<td><span style="background-color: #69E4A6" >' . $row['fac_cab_estado'] . '</span></td>';
                    }
                    ?>

    <td><?php echo $row['fac_cab_fecha'] ?></td>
    <td><a href="invoice.php?fac_cab_id=<?php echo $row['fac_cab_id'] ?>">Ver orden</a>
    </td>
</tr>
<?php
                $i = $i + 1;
            }
        } else {
            echo 'No hay facturas';
        }
    }
} else {
    header("Location: ../view/shoppinghistory.php");
}