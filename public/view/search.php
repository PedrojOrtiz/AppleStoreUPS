<?php
session_start();
if (isset($_SESSION['isLogin'])) {
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../css/globalStyle.css">
    <link rel="stylesheet" href="../css/generalStyle.css">
    <title>Producto</title>
</head>

<body>
    <header>
        <?php
        include("../../global/php/headerPublic.php");
        ?>
    </header>

    <div class="content">
        <h2>Resultados</h2>
        <section id="contentCards">
            <h2>Resultados para "<?php if (isset($_GET['searchCat'])) {
                                        echo $_GET['searchCat'];
                                    } elseif (isset($_GET['searchName'])) {
                                        echo $_GET['searchName'];
                                    }
                                    ?>"</h2>
            <div class="contentCards">
                <?php
                include '../../config/configDB.php';
                if (isset($_GET['searchCat'])) {
                    $sql = "SELECT pro.pro_fecha_creacion, pro.pro_id, pro.pro_nombre, pro.pro_descripcion, pro.pro_precio, img.img_nombre, cat.cat_nombre
                    FROM producto pro, imagen img, categoria cat
                    WHERE pro.pro_id = img.PRODUCTO_pro_id AND
                        cat.cat_id = pro.CATEGORIA_cat_id AND
                        cat.cat_nombre = '" . $_GET['searchCat'] . "' AND
                        pro.pro_estado=0
                        GROUP BY pro.pro_id;";
                } elseif (isset($_GET['searchName'])) {
                    $sql = "SELECT pro.pro_fecha_creacion, pro.pro_id, pro.pro_nombre, pro.pro_descripcion, pro.pro_precio, img.img_nombre, cat.cat_nombre
                    FROM producto pro, imagen img, categoria cat
                    WHERE pro.pro_id = img.PRODUCTO_pro_id AND
                        cat.cat_id = pro.CATEGORIA_cat_id AND
                        pro.pro_nombre LIKE '%" . $_GET['searchName'] . "%' AND
                        pro.pro_estado=0
                        GROUP BY pro.pro_id;";
                } else {
                    $sql = "SELECT pro.pro_fecha_creacion, pro.pro_id, pro.pro_nombre, pro.pro_descripcion, pro.pro_precio, pro_descuento, img.img_nombre
                                FROM producto pro, imagen img, rating rat
                                WHERE pro.pro_id = img.PRODUCTO_pro_id AND
                                    pro.pro_estado=0;";
                }


                $result = $conn->query($sql);
                //echo $result->num_rows;
                //Error en esta linea el resultado debuelve uno aun cuando no haya elementos en el resultado del query
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

                        <?php
                                if (isset($_GET['searchCat'])) {
                                    if (isset($row['pro_descuento']) != 0) {
                                        ?>
                        <span>
                            <?php
                                            echo $row['pro_descuento'] . "%";
                                            ?>
                        </span>
                        <?php
                                } else {
                                    ?>
                        <span>
                            <?php echo $row['cat_nombre']; ?>
                        </span>
                        <?php
                                }
                            }
                            ?>

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
            } else {
                echo 'No existe la categoria';
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