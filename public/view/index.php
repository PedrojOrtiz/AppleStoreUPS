<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    //header("Location: ../admin/index.php");
    if ($_SESSION['rol'] == 'admin') {
        header("Location: ../../admin/admin/view/index.php");
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
    <title>Apple Store EC</title>
</head>

<body>
    <header>
        <?php
        include_once("../../global/php/headerPublic.php");
        ?>
    </header>
    <div class="headerImg storeImg storeGuayaqil storeIndex">
        <div class="bg">
            <h1>Apple store EC</h1>
        </div>
    </div>
    <div class="content">
        <section>
            <a href="#">
                <h2>Ultimos productos</h2>
            </a>
            <div class="contentCards">



                <article>
                    <?php
                    include '../../config/configDB.php';
                    $sql = "SELECT pro.pro_fecha_creacion, pro.pro_id, pro.pro_nombre, pro.pro_descripcion, pro.pro_precio, img.img_nombre, AVG(rat.rat_calificacion) AS rat_calificacion
                            FROM producto pro, imagen img, rating rat 
                            WHERE pro.pro_id = img.PRODUCTO_pro_id AND
                                pro.pro_id = rat.PRODUCTO_pro_id AND
                                pro.pro_estado=0 
                            ORDER BY 1 DESC limit 8;";

                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>

                            <div class="contentImg">
                                <div class="cardImg">
                                    <a href="product.php?producto=<?php echo $row['pro_id']; ?>"><img src="../../img/product/<?php echo $row['pro_id']; ?>/<?php echo $row['img_nombre']; ?>" alt="<?php echo $row['img_nombre']; ?>"></a>
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

                        <?php
                    }
                }
                $conn->close();
                ?>
                </article>





                <article>
                    <div class="contentImg">
                        <div class="cardImg">
                            <a href="product.php"><img src="../../img/product/xsmax.jpg" alt="producto"></a>
                        </div>
                        <span>Nuevo</span>
                        <div class="ranking">
                            <i class="fas fa-star"></i>
                            <span>4.5</span>
                        </div>
                    </div>
                    <div class="contentDescription">
                        <div class="descripProduct">
                            <a href="product.php">
                                <h2>iPhone XS MAX</h2>
                            </a>
                            <p>Presentamos el iPhone XSMAX con dos tamaños de pantalla Super Retina,
                                incluida la más grande que ha tenido nunca un iPhone. Face ID aún más rápido.
                            </p>
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

        <section>
            <a href="#">
                <h2>En descuento</h2>
            </a>
            <div class="contentCards">

                <article>
                    <?php
                    include '../../config/configDB.php';
                    $sql = "SELECT pro.pro_descuento, pro.pro_id, pro.pro_nombre, pro.pro_descripcion, pro.pro_precio, img.img_nombre, AVG(rat.rat_calificacion) AS rat_calificacion
                            FROM producto pro, imagen img, rating rat 
                            WHERE pro.pro_id = img.PRODUCTO_pro_id AND
                                pro.pro_id = rat.PRODUCTO_pro_id AND
                                pro.pro_descuento > 0 AND
                                pro.pro_estado=0
                            ORDER BY 1 DESC limit 8;";

                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>

                            <div class="contentImg">
                                <div class="cardImg">
                                    <a href="product.php"><img src="../../img/product/<?php echo $row['pro_id']; ?>/<?php echo $row['img_nombre']; ?>" alt="<?php echo $row['img_nombre']; ?>"></a>
                                </div>
                                <span><?php echo $row['pro_descuento']; ?>%</span>
                                <div class="ranking">
                                    <i class="fas fa-star"></i>
                                    <span><?php echo $row['rat_calificacion']; ?></span>
                                </div>
                            </div>
                            <div class="contentDescription">
                                <div class="descripProduct">
                                    <a href="product.php">
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
                        <span>10%</span>
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="contentDescription">
                        <div class="descripProduct">
                            <a href="#">
                                <h2>iPhone X</h2>
                            </a>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laboriosam cupiditate harum,
                                possimus repudiandae vitae voluptas et amet perspiciatis rerum fugiat, commodi beatae
                                corporis fuga laudantium ducimus excepturi iste nobis magnam!
                                Esse eveniet exercitationem reprehenderit aut alias doloremque enim debitis officiis
                                quis libero velit reiciendis earum deserunt, laudantium accusamus dolore praesentium
                                laborum consequatur aliquam, recusandae officia eos! Asperiores consectetur aliquid
                                dolorem.
                            </p>
                        </div>
                        <span>$1.599</span>
                    </div>
                </article>

                <article>
                    <div class="contentImg">
                        <div class="cardImg">
                            <a href="#"><img src="../../img/product/producto.jpg" alt="producto"></a>
                        </div>
                        <span>10%</span>
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="contentDescription">
                        <div class="descripProduct">
                            <a href="#">
                                <h2>iPhone X</h2>
                            </a>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laboriosam cupiditate harum,
                                possimus repudiandae vitae voluptas et amet perspiciatis rerum fugiat, commodi beatae
                                corporis fuga laudantium ducimus excepturi iste nobis magnam!
                                Esse eveniet exercitationem reprehenderit aut alias doloremque enim debitis officiis
                                quis libero velit reiciendis earum deserunt, laudantium accusamus dolore praesentium
                                laborum consequatur aliquam, recusandae officia eos! Asperiores consectetur aliquid
                                dolorem.
                            </p>
                        </div>
                        <span>$1.599</span>
                    </div>
                </article>

                <article>
                    <div class="contentImg">
                        <div class="cardImg">
                            <a href="#"><img src="../../img/product/producto.jpg" alt="producto"></a>
                        </div>
                        <span>10%</span>
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
                        <span>20%</span>
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
                        <span>10%</span>
                        <i class="far fa-heart"></i>
                        <input type="number" name="" id="" min="">
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