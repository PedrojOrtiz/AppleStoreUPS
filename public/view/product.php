<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    if ($_SESSION['rol'] == 'admin') {
        header("Location: ../../admin/admin/view/index.php");
    }
}
if (!isset($_GET['producto'])) {
    header("Location: index.php");
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
    <script src="../js/funciones.js"></script>
    <title>Producto</title>
</head>

<body>


    <header>
        <?php
        include("../../global/php/headerPublic.php");
        ?>
    </header>


    <div class="content">
        <?php
        include '../../config/configDB.php';
        $sql = "SELECT c.cat_id, p.pro_nombre, p.pro_descripcion, p.pro_precio, p.pro_descuento
                FROM producto p, categoria c
                WHERE p.pro_id=" . $_GET['producto'] . " AND c.cat_id=p.CATEGORIA_cat_id;";

        $result = $conn->query($sql);
        if (isset($_GET['producto']) && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nombre = $row['pro_nombre'];
            $descripcion = $row['pro_descripcion'];
            $precio = $row['pro_precio'];
            $descuento = $row['pro_descuento'];
            $categoria = $row['cat_id'];
        }
        //Stock
        $sqlStock = "SELECT ps.pro_suc_stock FROM producto p, producto_sucursal ps, sucursal s
                                WHERE p.pro_id= ps.PRODUCTO_pro_id AND
                                s.suc_id= ps.SUCURSAL_suc_id AND 
                                s.suc_id=1;";

        $resultStock = $conn->query($sqlStock);
        $rowStock = $resultStock->fetch_assoc();
        $stok = $rowStock['pro_suc_stock'];

        ?>

        <section class="product">
            <div class="productSlide">
                <div class="productSlideImg">

                    <?php
                    $sqlimagen = 'SELECT  img_nombre FROM imagen WHERE PRODUCTO_pro_id=' . $_GET['producto'] . ';';
                    $resultimagen = $conn->query($sqlimagen);
                    $i = 0;

                    if ($resultimagen->num_rows > 0) {
                        while ($rowimagen = $resultimagen->fetch_assoc()) {
                            $imagenunica = $rowimagen['img_nombre'];
                            ?>
                    <script>
                    galeria('../../img/product/<?php echo $_GET['producto'] . '/' . $rowimagen['img_nombre'] ?>',
                        <?php echo $i ?>)
                    </script>
                    <?php
                            $i = $i + 1;
                        }
                    }
                    ?>

                    <i class="fas fa-angle-left" onclick="cambiarImagen(0)"></i>
                    <div class="contetImg">
                        <img id="galeria" src="../../img/product/<?php echo $_GET['producto'] . '/' . $imagenunica ?>"
                            alt="">
                    </div>
                    <i class="fas fa-angle-right" onclick="cambiarImagen(1)"></i>
                </div>
                <!-- <a href="">Next</a> -->
            </div>
            <div class="productInfo">
                <h2><?php echo $nombre; ?></h2>
                <h3>Descripcion</h3>
                <p><?php echo $descripcion; ?></p>
                <span>$<?php echo $precio; ?></span>
                <div class="dataStore">
                    <div>
                        <label for="selectStore">Seleccionar tienda:</label>
                        <select id="selectStore" onchange="stock(this)">
                            <option value="quito">Guayaquil</option>
                            <option value="guayaquil">Quito</option>
                            <option value="cuenca">Cuenca</option>
                        </select>
                    </div>

                    <p><span>Stock:</span> <span id="stok"><?php echo $stok; ?></span></p>
                </div>
                <div class="productPrice">
                    <p><span>Sub-Total: </span>$<?php echo $precio; ?></p>
                    <p><span>Descuento: </span><?php echo $descuento; ?>%</p>
                    <p><span id="shopTotal">Total: </span>$<?php $precioTotalProd = $precio - ($precio * $descuento / 100);
                                                            echo $precioTotalProd; ?></p>
                </div>
                <div class="productBtns">
                    <div class="valoration" id="valoration" onmousemove="elemento(event)">
                        <p class="clasificacion">
                            <input id="radio1" type="radio" name="estrellas" value="5"
                                onclick="prodValoration(this, <?php echo $_GET['producto'] ?>) ">
                            <label for="radio1">★</label>
                            <input id="radio2" type="radio" name="estrellas" value="4"
                                onclick="prodValoration(this, <?php echo $_GET['producto'] ?>) ">
                            <label for="radio2">★</label>
                            <input id="radio3" type="radio" name="estrellas" value="3"
                                onclick="prodValoration(this, <?php echo $_GET['producto'] ?>) ">
                            <label for="radio3">★</label>
                            <input id="radio4" type="radio" name="estrellas" value="2"
                                onclick="prodValoration(this, <?php echo $_GET['producto'] ?>) ">
                            <label for="radio4">★</label>
                            <input id="radio5" type="radio" name="estrellas" value="1"
                                onclick="prodValoration(this, <?php echo $_GET['producto'] ?>) ">
                            <label for="radio5">★</label>
                        </p>
                        <?php
                        if (isset($_SESSION['codigo'])) {
                            $sqlRatP = "SELECT rat.rat_calificacion
                                    FROM producto pro, rating rat, usuario usu
                                    WHERE pro.pro_id = rat.PRODUCTO_pro_id AND
                                    usu.usu_id = rat.USUARIO_usu_id AND
                                    pro.pro_estado=0 AND
                                    usu.usu_id=" . $_SESSION['codigo'] . " AND
                                    pro.pro_id=" . $_GET['producto'] . ";";
                        } else {

                            $sqlRatP = "SELECT COALESCE(AVG(rat.rat_calificacion),0) AS rat_calificacion FROM producto pro, rating rat 
                                            WHERE rat.PRODUCTO_pro_id = pro.pro_id AND
                                            pro.pro_id=" . $_GET['producto'] . ";";
                        }

                        $resultRatP = $conn->query($sqlRatP);
                        //echo $resultRatP->num_rows;
                        if ($resultRatP->num_rows > 0) {
                            $resultCal = $resultRatP->fetch_assoc();
                            echo '<span id="clasificacion">' . $resultCal['rat_calificacion'] . '</span>';
                        } else {
                            echo '<span id="clasificacion">Sin calificar</span>';
                        }
                        ?>

                    </div>
                    <div class="btns">
                        <button onclick="cartAdd(<?php echo $_GET['producto']; ?>)">
                            <i class="fas fa-cart-plus"></i>
                            Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <a href="#">
                <h2>Productos relacionados</h2>
            </a>
            <div class="contentCards">

                <?php
                $sql = "SELECT pro.pro_id, pro.pro_nombre, pro.pro_descripcion, pro.pro_precio, img.img_nombre 
                            FROM producto pro, imagen img, categoria cat
                            WHERE pro.pro_id = img.PRODUCTO_pro_id AND
                            cat.cat_id = pro.CATEGORIA_cat_id AND
                            pro.pro_estado=0 AND
                            cat.cat_id = pro.CATEGORIA_cat_id AND
                            pro.pro_id = " . $_GET['producto'] . "
                            limit 4;";

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                <article>
                    <div class="contentImg">
                        <div class="cardImg">
                            <a href="product.php?producto=<?php echo $row['pro_id']; ?>"><img
                                    src="../../img/product/<?php echo $row['pro_id']; ?>/<?php echo $row['img_nombre']; ?>"
                                    alt="<?php echo $row['img_nombre']; ?>"></a>
                        </div>
                        <div class="ranking">
                            <i class="fas fa-star"></i>
                            <?php
                                    $sqlRating = "SELECT COALESCE(AVG(rat.rat_calificacion),0) AS rat_calificacion FROM producto pro, rating rat 
                                            WHERE rat.PRODUCTO_pro_id = pro.pro_id AND
                                            pro.pro_id=" . $row['pro_id'] . ";";

                                    $resultRating = $conn->query($sqlRating);
                                    $rowRating = $resultRating->fetch_assoc();
                                    echo '<span>' . $rowRating['rat_calificacion'] . '</span>';
                                    ?>
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
                <?php
                }
            }
            $conn->close();
            ?>

            </div>
        </section>
    </div>

    <footer>
        <?php
        include("../../global/php/footerPublic.php");
        ?>
    </footer>

</body>

</html>