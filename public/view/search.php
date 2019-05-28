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
        <section>
            <h2>Resultados para "iPhone"</h2>
            <div class="contentCards">
                <article>
                    <div class="contentImg">
                        <div class="cardImg">
                            <a href="#"><img src="../../img/product/producto.jpg" alt="producto"></a>
                        </div>
                        <span>Nuevo</span>
                        <i class="fas fa-heart"></i>
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