<?php 

    include '../../../config/configDB.php';

    session_start();

    if (isset($_SESSION['codigo']))
        $id=$_SESSION['codigo'];

    if($_SESSION["rol"] != "admin")
        header("Location: ../controller/logout.php");

    $idProducto = $_REQUEST['id'];

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

    $sqlPro =  "SELECT pro.pro_id, pro.pro_fecha_creacion, pro.pro_nombre, pro.pro_estado, pro.pro_precio, img.img_nombre, ps.pro_suc_stock, pro.pro_descripcion, pro.pro_descuento
    FROM producto pro, imagen img, producto_sucursal ps
    WHERE pro.pro_id = img.PRODUCTO_pro_id AND pro.pro_id = ps.PRODUCTO_pro_id AND ps.SUCURSAL_suc_id = $sucId AND pro.pro_id = $idProducto
    GROUP BY img.PRODUCTO_pro_id";

    $resultPro=$conn->query($sqlPro);
    $rowPro= mysqli_fetch_assoc($resultPro);

    $nombreAnterior = $rowPro['pro_nombre'];
    $descripcionAnterior = $rowPro['pro_descripcion'];
    $precioAnterior = $rowPro['pro_precio'];
    $descuentoAnterior = $rowPro['pro_descuento'];
    $stockAnterior = $rowPro['pro_suc_stock'];

    $proNombre = isset($_POST["nombre"]) ? mb_strtoupper(trim($_POST["nombre"]), 'UTF-8') : null; 
    $proDescripcion = isset($_POST["descripcion"]) ? mb_strtoupper(trim($_POST["descripcion"]), 'UTF-8') : null;        
    $proPrecio = isset($_POST["precio"]) ? mb_strtoupper(trim($_POST["precio"]), 'UTF-8') : null; 
    $proDescuento = isset($_POST["descuento"]) ? mb_strtoupper(trim($_POST["descuento"]), 'UTF-8') : null;
    $proCategoria = $_POST['categoria'];

    $proStock = isset($_POST["stock"]) ? mb_strtoupper(trim($_POST["stock"]), 'UTF-8') : null;

    $sql = "SELECT MAX(pro_id) AS codigo  FROM producto;";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $codigoNewProduct = ($row['codigo'] + 1);

    $sqlProducto = "UPDATE producto SET
        pro_estado = 1,
        pro_fecha_modificacion = SYSDATE()
        WHERE pro_id = $idProducto";

    if ($conn->query($sqlProducto) === TRUE) {             
        header("Location: ../view/products.php");                 
    } else {             
        echo "Error al eliminar producto";
        echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";           
    }
    $conn->close();
    



?>