<?php
include '../../config/configDB.php';
$sql = "SELECT pro.pro_fecha_creacion, pro.pro_id, pro.pro_nombre, pro.pro_descripcion, pro.pro_precio, img.img_nombre, AVG(rat.rat_calificacion) AS rat_calificacion, cat.cat_nombre
                    FROM producto pro, imagen img, rating rat, categoria cat
                    WHERE pro.pro_id = img.PRODUCTO_pro_id AND
                        pro.pro_id = rat.PRODUCTO_pro_id AND
                        cat.cat_id = pro.CATEGORIA_cat_id AND
                        pro.pro_nombre LIKE '" . $_GET['searchName'] . "%' AND
                        pro.pro_estado=1;";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
<h2>Resultados para "<?php echo $_GET['searchName']; ?>"</h2>
<div class="contentCards">
    <article>
        <div class="contentImg">
            <div class="cardImg">
                <a href="product.php?producto=<?php echo $row['pro_id']; ?>"><img
                        src="../../img/product/<?php echo $row['pro_id']; ?>/<?php echo $row['img_nombre']; ?>"
                        alt="<?php echo $row['img_nombre']; ?>"></a>
            </div>
            <span>Nuevo</span>
            <div class="ranking">
                <i class="fas fa-star"></i>
                <span><?php echo $row['rat_calificacion']; ?></span>
            </div>
        </div>
        <div class="contentDescription">
            <div class="descripProduct">
                <a href="product.php?producto=<?php echo $row['pro_id']; ?>">
                    <h2><?php echo $row['pro_nombre']; ?></h2>
                </a>
                <p><?php echo $row['pro_descripcion']; ?></p>
            </div>
            <span>$<?php echo $row['pro_precio']; ?></span>
        </div>
    </article>
</div>
<?php
}
} else {
    echo '<h1>No hay resultados</h1>';
}
$conn->close();
?>