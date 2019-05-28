<div class="content">
    <a href="../../../index.php"><i class="fab fa-apple"></i></a>
    <nav class="menu">
        <ul>
            <li><a href="../../../index.php">Inicio</a></li>
            <li> <span>Productos</span> <i class="fas fa-sort-down"></i>
                <ul>
                    <li><a href="#">Mac</a></li>
                    <li><a href="#">iPad</a></li>
                    <li><a href="#">iPhone</a></li>
                    <li><a href="#">Watch</a></li>
                    <li><a href="#">TV</a></li>
                    <li><a href="#">Musica</a></li>
                    <li><a href="#">Accesorios</a></li>
                </ul>
            </li>
            <li> <span>Donde Comprar</span> <i class="fas fa-sort-down"></i>
                <ul>
                    <!-- <?php __FILE__ ?>../../ -->
                    <li><a href="../../../public/view/storequito.php">Quito</a></li>
                    <li><a href="../../../public/view/storeguayaquil.php">Guayaquil</a></li>
                    <li><a href="../../../public/view/storecuenca.php">Cuenca</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="search">
        <div class="barSearch">
            <input type="search" name="search" id="search" placeholder="Buscar">
            <i class="fas fa-search"></i>
        </div>
        <a href="#">Buscar</a>
    </div>
    <!-- <div class="buyCar itemsUser">
        <a href="../../../public/view/shoppingcart.php"><i class="fas fa-shopping-cart"></i></a>
    </div> -->
    <div class="sessionItems">
        <?php
        if (isset($_SESSION['isLogin'])) {
            ?>

        <div class="imgUser">
            <a href="../../../public/view/shoppingcart.php"><i class="fas fa-shopping-cart"></i></a>
            <img src="../../../img/user/<?php echo $_SESSION['codigo']; ?>/<?php echo $_SESSION['img']; ?>"
                alt="<?php echo $_SESSION['img']; ?>">
        </div>
        <nav class="menu perfil">
            <ul>
                <li><span><?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido']; ?></span> <i
                        class="fas fa-sort-down"></i>
                    <ul>
                        <li><a href="index.php">Perfil</a>
                        </li>
                        <li><a href="shoppinghistory.php">Historial</a>
                        </li>
                        <li><a href="settings.php">Opciones</a></li>
                        <li><a href="#">Salir</a></li>
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