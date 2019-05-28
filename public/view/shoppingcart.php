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
    <script src="../js/funciones.js"></script>
    <title>Carrito</title>
</head>

<body>
    <header>
        <?php
        include("../../global/php/headerPublic.php");
        ?>
    </header>

    <div id="floatWindow">
        <div class="contentWindow">
            <!-- FORMULARIO  -->
            <div class="form">
                <form action="">
                    <h2>Pagar con tarjeta</h2>
                    <p>Introdisca los datos de su tarjeta</p>
                    <input type="text" name="numbreCard" id="numbreCard" placeholder="1234 1234 1234 1234" required>
                    <div class="nombres">
                        <input type="text" name="dateCard" id="dateCard" placeholder="MM/YY" required>
                        <input type="text" name="cvcCard" id="cvcCard" placeholder="CVC" required>
                    </div>

                    <input type="text" name="nameCard" id="nameCard" placeholder="Nombre del propietario" required>
                    <input type="text" name="countryCard" id="countryCard" placeholder="Pais" required>
                    <div class="btns">
                        <input type="submit" value="Pagar">
                    </div>
                </form>
            </div>

            <!-- ESTADOS DEL PAGO -->
            <!-- <div class="confirmVtn">
                <h2>Gracias por su compra.</h2>
                <p>Pago realizado con exito</p>
                <i class="far fa-check-circle"></i>
                <h2>No se pudo realizar el pago.</h2>
                <i class="far fa-times-circle"></i>
                <div class="btns">
                    <input type="button" value="Inicio" onclick="window.location.href = 'index.html'">
                    <input type="button" value="Ver Compras"
                        onclick="window.location.href = '../../admin/user/view/shoppinghistory.html'">
                </div>
            </div> -->
            <i class=" fas fa-times" onclick="cluseWindow()"></i>
        </div>

    </div>

    <div class="content">
        <section class="product">
            <div class="productSlide cart">
                <article>
                    <div class="cartImg">
                        <img src="../../img/product/product2.png" alt="imagen">
                    </div>
                    <div class="cartDescription">
                        <h2>iPhone X</h2>
                        <h3>Descripcion</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, sint aut, alias dolorum
                            optio
                            ut tempora voluptatibus voluptatum ad, qui recusandae cumque. Temporibus officiis
                            nobis sunt
                            perferendis, nulla enim ea unde cum sequi animi dignissimos voluptas et iusto
                            delectus modi
                            at pariatur vel amet sit quod aliquid! Asperiores, magni vel.</p>
                        <h3>Tienda</h3>
                        <span>Guayaquil</span>
                    </div>
                    <span>$749</span>
                    <i class="fas fa-times"></i>
                </article>

                <article>
                    <div class="cartImg">
                        <img src="../../img/product/product2.png" alt="imagen">
                    </div>
                    <div class="cartDescription">
                        <h2>iPhone X</h2>
                        <h3>Descripcion</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt neque ipsum ea
                            itaque ullam
                            dolore!</p>
                        <div class="store">
                            <h3>Tienda</h3>
                            <span>Guayaquil</span>
                        </div>
                    </div>
                    <span>$749</span>
                    <i class="fas fa-times"></i>
                </article>

                <article>
                    <div class="cartImg">
                        <img src="../../img/product/producto.jpg" alt="imagen">
                    </div>
                    <div class="cartDescription">
                        <h2>iPhone X</h2>
                        <h3>Descripcion</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt neque ipsum ea
                            itaque ullam
                            dolore!</p>
                        <div class="store">
                            <h3>Tienda</h3>
                            <span>Guayaquil</span>
                        </div>
                    </div>
                    <span>$749</span>
                    <i class="fas fa-times"></i>
                </article>

            </div>

            <div class="productInfo bill">
                <div class="billInfo">
                    <div class="nameBill">
                        <h2>Factura</h2>
                        <p>Richard Torres</p>
                        <span>Av. Jaime Roldos y 3 de Noviembre</span>
                        <span class="data">0106464456,Cuenca,Azuay</span>
                    </div>
                    <button onclick="window.location.href = '../../admin/user/view/index.php'">
                        <i class="far fa-edit"></i> Editar
                    </button>
                </div>
                <div class="buydetall">
                    <h2>Detalle</h2>
                    <div class="price">
                        <p><span>Sub-Total: </span>$749.00</p>
                        <p><span>Total: </span>$749.00</p>
                    </div>
                    <div class="btns">
                        <button onclick="openWindow()">
                            <i class="far fa-credit-card"></i> Tarjeta
                        </button>
                    </div>
                </div>
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