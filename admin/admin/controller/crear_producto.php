<?php 

    include '../../../config/configDB.php';

    session_start();

    if (isset($_SESSION['codigo']))
        $id=$_SESSION['codigo'];

    if($_SESSION["rol"] != "admin")
        header("Location: ../controller/logout.php");

    $sqlUsuario = "SELECT * FROM usuario user, imagen img WHERE user.usu_id = $id AND img.USUARIO_usu_id = $id";

    $resultUsuario = $conn->query($sqlUsuario);
    $rowUsuario = mysqli_fetch_assoc($resultUsuario);

    $nombres = $rowUsuario['usu_nombres'];
    $apellidos = $rowUsuario['usu_apellidos'];
    $img = $rowUsuario['img_nombre'];

    $sucId = $rowUsuario['SUCURSAL_suc_id'];

    $sqlSucursal = "SELECT * FROM sucursal suc WHERE suc.suc_id = $sucId";

    $resultSucursal = $conn->query($sqlSucursal);
    $rowSucursal = mysqli_fetch_assoc($resultSucursal);

    $sucId = $rowSucursal['suc_id'];
    $sucNombre = $rowSucursal['suc_nombre'];
    $sucTelefono = $rowSucursal['suc_telefono'];
    $sucCelular = $rowSucursal['suc_celular'];
    $sucUrl = $rowSucursal['suc_url'];
    $sucEliminado = $rowSucursal['suc_eliminado'];


    /*$sqlPro =  "SELECT pro.pro_fecha_creacion, pro.pro_nombre, pro.pro_estado, pro.pro_precio, img.img_nombre, ps.pro_suc_stock
                FROM producto pro, imagen img, rating rat, producto_sucursal ps
                WHERE pro.pro_id = img.PRODUCTO_pro_id AND pro.pro_id = rat.PRODUCTO_pro_id AND pro.pro_id = ps.PRODUCTO_pro_id AND ps.SUCURSAL_suc_id = $sucId
                ORDER BY pro.pro_fecha_creacion DESC";*/

    $sqlPro =  "SELECT pro.pro_id, pro.pro_fecha_creacion, pro.pro_nombre, pro.pro_estado, pro.pro_precio, img.img_nombre, ps.pro_suc_stock
    FROM producto pro, imagen img, producto_sucursal ps
    WHERE pro. pro_id = img.PRODUCTO_pro_id AND pro.pro_id = ps.PRODUCTO_pro_id AND ps.SUCURSAL_suc_id = $sucId
    GROUP BY img.PRODUCTO_pro_id
    ORDER BY pro.pro_fecha_creacion DESC";

    if (!empty($_POST)) {

        $proNombre = isset($_POST["nombre"]) ? mb_strtoupper(trim($_POST["nombre"]), 'UTF-8') : null; 
        $proDescripcion = isset($_POST["descripcion"]) ? mb_strtoupper(trim($_POST["descripcion"]), 'UTF-8') : null;        
        $proPrecio = isset($_POST["precio"]) ? mb_strtoupper(trim($_POST["precio"]), 'UTF-8') : null; 
        $proDescuento = isset($_POST["descuento"]) ? mb_strtoupper(trim($_POST["descuento"]), 'UTF-8') : null;
        $proCategoria = $_POST['categoria'];

        $foto = $_FILES['foto']['name'];
        $temp = $_FILES['foto']['tmp_name'];
        $type = $_FILES['foto']['type'];

        $proStock = isset($_POST["stock"]) ? mb_strtoupper(trim($_POST["stock"]), 'UTF-8') : null;

        $sql = "SELECT MAX(pro_id) AS codigo  FROM producto;";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $codigoNewProduct = ($row['codigo'] + 1);

        $directorio = "../../../img/product/" . $codigoNewProduct . "/";
        mkdir($directorio, 0777, true);

        move_uploaded_file($temp, "../../../img/product/" . $codigoNewProduct . "/$foto");

        $sqlProducto = "INSERT INTO producto (
            pro_nombre, 
            pro_descripcion,  
            pro_precio, 
            pro_descuento,
            CATEGORIA_cat_id) VALUES (  
            '$proNombre', 
            '$proDescripcion', 
            $proPrecio, 
            $proDescuento,
            $proCategoria)";
        
        $sqlImg = "INSERT INTO imagen (
            img_nombre, 
            PRODUCTO_pro_id) VALUES (
            '$foto',
            '$codigoNewProduct')";

        $sqlProSuc = "INSERT INTO producto_sucursal (
            pro_suc_stock, 
            PRODUCTO_pro_id,
            SUCURSAL_suc_id) VALUES (
            $proStock,
            '$codigoNewProduct',
            $sucId)";

        $sqlRat = "INSERT INTO rating (
            PRODUCTO_pro_id VALUES  (
                '$codigoNewProduct'
            )";

        if ($conn->query($sqlProducto) === TRUE && $conn->query($sqlImg) === TRUE && $conn->query($sqlProSuc) === TRUE && $conn->query($sqlRat) === TRUE) {             
            header("Location: ../view/products.php");                 
        } else {             
            echo "Error al crear nuevo producto";
            echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";           
        }
        $conn->close();
    

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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/globalStyle.css">
    <link rel="stylesheet" href="../css/style2.css">
    <title>Productos</title>
</head>

<body>
    <header>
        <div class="content">        
            <div class="sessionItems">
                    <div class="header">
                        <ul class="nav">
                            <li> <a><?php echo strtoupper($nombres) ?> <?php echo strtoupper($apellidos) ?></a>
                                <ul>
                                    <li><a href="modify.php">Ajustes</a></li>
                                    <li><a href="../controller/logout.php">Cerrar Sesion</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <div class="imgUser">
                    <img src="../../../img/user/<?php echo $id; ?>/<?php echo ($img); ?>" alt="">
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <header>
            <div class="perfil">
                <li><a>APPLE STORE EC</a></li>
            </div>
            <nav>
                <ul>
                    <li><a href="../view/index.php"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="../view/orders.php"><i class="fas fa-chart-bar"></i> Ordenes</a></li>
                    <li><a href="../view/inbox.php"><i class="far fa-envelope"></i> Mensajes</a></li>
                    <li><a href="../view/products.php"><i class="fa fa-barcode"></i> Productos</a></li>
                    <li><a href="../view/clients.php"><i class="fas fa-users"></i> Clientes</a></li>
                    <li><a href="../view/settings.php"><i class="fas fa-cog"></i> Configuracion</a></li>
                </ul>
            </nav>
        </header>
        <section>
            <h2>Nuevo Producto</h2>
            <div class="content">
                <h2>Sucursal: <?php echo strtoupper($sucNombre) ?></h2>
                <div class="form">
                                
                    <form method="POST" enctype="multipart/form-data" action=""> 
 
                        <label for="nombres">Nombre:</label> 
                        <input type="text" id="nombre" name="nombre" value="" placeholder="Nombre del producto..." required>

                        <label for="descripcion">Descripcion:</label> 
                        <input type="text" id="descripcion" name="descripcion" value="" placeholder="Descripcion del producto..." required>            

                        <label for="precio">Precio:</label> 
                        <input type="number" id="precio" name="precio" value="" placeholder="$ Precio del producto..." required>

                        <label for="stock">Cantidad:</label> 
                        <input type="number" id="stock" name="stock" value="" placeholder=" Cantidad del producto..." required>

                        <label for="descuento">Descuento:</label> 
                        <input type="number" id="descuento" name="descuento" value="" placeholder="% Descuento..."> 

                        <label for="categoria">Seleccionar Categoria:</label>
                        <select name="categoria" id="categoria" type="number" onchange="stock(this)" required>
                            <option value="1">Mac</option>
                            <option value="2">iPad</option>
                            <option value="3">iPhone</option>
                            <option value="4">Watch</option>
                            <option value="5">TV</option>
                            <option value="6">Accesorios</option>
                        </select>
                        <br>

                        <label for="fotos">Seleccione una o varias fotos del producto.</label>
                        <input type="file" name="foto" id="foto" required>

                        <div class="btns">
                            <input type="submit" value="Crear">
                        </div>

                    </form>   

                </div>
            </div>
        </section>
    </div>

    

</body>

</html>