<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    //header("Location: ../admin/index.php");
    if ($_SESSION['rol'] == 'admin') {
        //header("Location: ../admin/index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
        } else {
            echo 'Error';
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
                    $sqlimagen = 'SELECT  img_nombre FROM imagen WHERE PRODUCTO_pro_id=1;';
                    $resultimagen = $conn->query($sqlimagen);
                    $i = 0;

                    if ($resultimagen->num_rows > 0) {
                        while ($rowimagen = $resultimagen->fetch_assoc()) {
                            $imagenunica = $rowimagen['img_nombre'];
                            ?>
                            <script>
                                galeria('../../img/product/<?php echo $_GET['producto'] . '/' . $rowimagen['img_nombre'] ?>',
                                    <?php echo $i, '' ?>)
                            </script>
                            <?php
                            $i = $i + 1;
                        }
                    }
                    ?>

                    <i class="fas fa-angle-left" onclick="cambiarImagen(0)"></i>
                    <div class="contetImg">
                        <img id="galeria" src="../../img/product/<?php echo $_GET['producto'] . '/' . $imagenunica ?>" alt="">
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
                    <p><span>IVA: </span>12%</p>
                    <p><span id="shopTotal">Total: </span>$<?php $iva = (($precio * 0.12) + $precio);
                                                            $precioTotalProd = ($iva - ($iva * ($descuento / 100)));
                                                            echo $precioTotalProd; ?></p>
                </div>
                <div class="productBtns">
                    <div class="valoration" id="valoration" onmousemove="elemento(event)">
                        <p class="clasificacion">
                            <input id="radio1" type="radio" name="estrellas" value="5" onclick="prodValoration(this) ">
                            <label for="radio1">★</label>
                            <input id="radio2" type="radio" name="estrellas" value="4" onclick="prodValoration(this) ">
                            <label for="radio2">★</label>
                            <input id="radio3" type="radio" name="estrellas" value="3" onclick="prodValoration(this) ">
                            <label for="radio3">★</label>
                            <input id="radio4" type="radio" name="estrellas" value="2" onclick="prodValoration(this) ">
                            <label for="radio4">★</label>
                            <input id="radio5" type="radio" name="estrellas" value="1" onclick="prodValoration(this) ">
                            <label for="radio5">★</label>
                        </p>

                        <span id="clasificacion">3.0</span>
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
                <article>
                    <?php
                    $sql = "SELECT pro.pro_id, pro.pro_nombre, pro.pro_descripcion, pro.pro_precio, img.img_nombre, AVG(rat.rat_calificacion) AS rat_calificacion 
                            FROM producto pro, imagen img, rating rat, categoria cat
                            WHERE pro.pro_id = img.PRODUCTO_pro_id AND
                            pro.pro_id = rat.PRODUCTO_pro_id AND
                            cat.cat_id = pro.CATEGORIA_cat_id AND
                            pro.pro_estado=0 AND
                            cat.cat_id =3
                            limit 4;";

                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>

                            <div class="contentImg">
                                <div class="cardImg">
                                    <a href="product.php?producto=<?php echo $row['pro_id']; ?>"><img src="../../img/product/<?php echo $row['pro_id']; ?>/<?php echo $row['img_nombre']; ?>" alt="<?php echo $row['img_nombre']; ?>"></a>
                                </div>
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

                        <?php
                    }
                }
                $conn->close();
                ?>
                </article>


                <article>
                    <div class="contentImg">
                        <div class="cardImg">
                            <a href="#"><img src="../../img/product/producto.jpg" alt="producto"></a>
                        </div>
                        <span>Nuevo</span>
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="contentDescription">
                        <div class="descripProduct">
                            <a href="#">
                                <h2>iPhone X</h2>
                            </a>
                            <p>Lorem ipsum dolor sit.</p>
                        </div>
                        <span>$1.599</span>
                    </div>
                </article>


                <article>
                    <div class="contentImg">
                        <div class="cardImg">
                            <a href="#"><img src="../../img/product/producto.jpg" alt="producto"></a>
                        </div>
                        <span>Nuevo</span>
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="contentDescription">
                        <div class="descripProduct">
                            <a href="#">
                                <h2>iPhone X</h2>
                            </a>
                            <p>Lorem ipsum dolor sit.</p>
                        </div>
                        <span>$1.599</span>
                    </div>
                </article>
                <article>
                    <div class="contentImg">
                        <div class="cardImg">
                            <a href="#"><img src="../../img/product/producto.jpg" alt="producto"></a>
                        </div>
                        <span>Nuevo</span>
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="contentDescription">
                        <div class="descripProduct">
                            <a href="#">
                                <h2>iPhone X</h2>
                            </a>
                            <p>Lorem ipsum dolor sit.</p>
                        </div>
                        <span>$1.599</span>
                    </div>
                </article>
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