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
        <section class="product">
            <div class="productSlide">
                <div class="productSlideImg">
                    <i class="fas fa-angle-left"></i>
                    <img src="../../img/product/product2.png" alt="">
                    <i class="fas fa-angle-right"></i>
                </div>
                <a href="">Next</a>
            </div>
            <div class="productInfo">
                <h2>iPhone X</h2>
                <h3>Descripcion</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Odio mollitia eius voluptate fugit ducimus
                    qui dolor cumque animi at. Error.</p>
                <span>$749.00</span>
                <div class="dataStore">
                    <div>
                        <label for="selectStore">Seleccionar tienda:</label>
                        <select id="selectStore">
                            <option value="quito">Quito</option>
                            <option value="guayaquil">Guayaquil</option>
                            <option value="cuenca">Cuenca</option>
                        </select>
                    </div>
                    <p><span>Stock:</span> 10</p>
                </div>
                <div class="productPrice">
                    <p><span>Sub-Total: </span>$749.00</p>
                    <p><span>Descuento: </span>0%</p>
                    <p><span>Total: </span>$749.00</p>
                </div>
                <div class="productBtns">
                    <div class="valoration" id="valoration" onmousemove="elemento(event)">
                        <!--Cambiar por esta estrella -->
                        <i class="fas fa-star"></i>
                        <!--Fin-->
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <span>3.0</span>
                    </div>
                    <div class="btns">
                        <button>
                            <i class="fas fa-cart-plus"></i>
                            Agregar al carrito
                        </button>
                        <i class="far fa-heart"></i>
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