<div class="content">
    <a href="../../index.php"><i class="fab fa-apple"></i></a>
    <nav class="menu">
        <ul>
            <li><a href="../../index.php">Inicio</a></li>
            <li> <span>Productos</span> <i class="fas fa-sort-down"></i>
                <ul>
                    <li><a href="search.php?searchCat=mac">Mac</a></li>
                    <li><a href="search.php?searchCat=ipad">iPad</a></li>
                    <li><a href="search.php?searchCat=iphone">iPhone</a></li>
                    <li><a href="search.php?searchCat=watch">Watch</a></li>
                    <li><a href="search.php?searchCat=tv">TV</a></li>
                    <li><a href="search.php?searchCat=musica">Musica</a></li>
                    <li><a href="search.php?searchCat=accesorios">Accesorios</a></li>
                </ul>
            </li>
            <li> <span>Donde Comprar</span> <i class="fas fa-sort-down"></i>
                <ul>
                    <!-- <?php __FILE__ ?>../../ -->
                    <li><a href="storequito.php">Quito</a></li>
                    <li><a href="storeguayaquil.php">Guayaquil</a></li>
                    <li><a href="storecuenca.php">Cuenca</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="search">
        <div class="barSearch">
            <input type="search" name="search" id="search" placeholder="Buscar" onkeyup="searchBox(this)">
            <i class="fas fa-search"></i>
        </div>
        <a onclick="searchBtn()">Buscar</a>
    </div>
    <!-- <div class="buyCar itemsUser">
        <a href="../../public/view/shoppingcart.php"><i class="fas fa-shopping-cart"></i></a>
    </div> -->
    <div class="sessionItems">
        <?php
        if (isset($_SESSION['isLogin'])) {
            ?>

        <div class="imgUser">
            <a href="../../public/view/shoppingcart.php"><i class="fas fa-shopping-cart"></i></a>
            <img src="../../img/user/<?php echo $_SESSION['codigo']; ?>/<?php echo $_SESSION['img']; ?>"
                alt="<?php echo $_SESSION['img']; ?>">
        </div>
        <nav class="menu perfil">
            <ul>
                <li><span><?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido']; ?></span> <i
                        class="fas fa-sort-down"></i>
                    <ul>
                        <li><a href="../../admin/user/view/index.php">Perfil</a>
                        </li>
                        <li><a href="../../admin/user/view/shoppinghistory.php">Historial</a>
                        </li>
                        <li><a href="../../admin/user/view/settings.php">Opciones</a></li>
                        <li><a href="../../config/signout.php">Salir</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <?php
    } else {
        echo '<a href="login.php">Iniciar Sesión</a>';
        echo '<a href="signup.php">Registrarse</a>';
    }
    ?>

    </div>
</div>
<script src="../js/funciones.js"></script>