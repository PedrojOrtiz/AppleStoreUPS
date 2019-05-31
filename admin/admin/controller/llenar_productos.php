<?php

    include '../../../config/configDB.php';

    session_start();

    if (isset($_SESSION['codigo']))
        $id=$_SESSION['codigo'];

    if($_SESSION["rol"] != "admin")
        header("Location: ../controller/logout.php");

    //$nom = $_GET['nombre'];

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



    $sqlPro =  "SELECT pro.pro_id, pro.pro_fecha_creacion, pro.pro_nombre, pro.pro_estado, pro.pro_precio, img.img_nombre, ps.pro_suc_stock, pro.pro_fecha_modificacion
            FROM producto pro, imagen img, producto_sucursal ps
            WHERE pro.pro_id = img.PRODUCTO_pro_id AND pro.pro_id = ps.PRODUCTO_pro_id AND ps.SUCURSAL_suc_id = $sucId
            GROUP BY img.PRODUCTO_pro_id
            ORDER BY pro.pro_fecha_creacion DESC";


    $resultPro = $conn->query($sqlPro);

    if ($resultPro->num_rows > 0) { 

        $resultPro = $conn->query($sqlPro);

        echo    "
                    <colgroup>
                        <col style='width: 5%'>
                        <col style='width: 5%'>
                        <col style='width: 5%'>
                        <col style='width: 5%'>
                        <col style='width: 5%'>
                        <col style='width: 5%'>
                        <col style='width: 5%'>
                        <col style='width: 5%'>
                    </colgroup>

                    <thead>
                        <tr>
                            <th>Creado</th>
                            <th>Modificado</th>
                            <th>Imagen</th>  
                            <th>Nombre</th>
                            <th>Precio</th> 
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Acciones</th>        
                        </tr>
                    </thead>

                    <tr>
                    ";

        
        while($row = $resultPro->fetch_assoc()) {  

            echo "<tr>";   
                echo "<td>" . $row['pro_fecha_creacion'] . "</td>";

                if ($row['pro_fecha_modificacion'] == "") {
                    echo "<td>-</td>";
                } else {
                    echo "<td>" . $row['pro_fecha_modificacion'] . "</td>";
                }   
                echo "  <div class='cardImg'> 
                            <td> <img src='../../../img/product/".$row['pro_id']."/".$row['img_nombre']."' alt='".$row['img_nombre']."' height='80' width='80' > </td> 
                        </div> ";
                echo "<td>" . $row['pro_nombre'] ."</td>";
                echo "<td> $" . $row['pro_precio'] ."</td>";
                echo "<td>" . $row['pro_suc_stock'] ."u.</td>";
                if ($row['pro_estado'] == 0) {
                    echo "<td>Activo</td>";
                } else if ($row['pro_estado'] == 1) {
                    echo "<td>Inactivo</td>";
                }
                if ($row['pro_estado'] == 0) {
                echo "  <td> 
                            <a href='../controller/modificar_producto.php?id=".$row['pro_id']."' id='sbutton'> Modificar </a><br><br>";
                            
                echo       "<a href='../controller/eliminar_producto.php?id=".$row['pro_id']."' id='sbutton'> Eliminar </a>";  
                }
                                          
                echo       "</td>";                                            
            echo "</tr>";
        }

    } else { 

        echo "<tr>";                 
        echo "<td colspan='4'> No hay productos en esta sucursal </td>";                 
        echo "</tr>"; 

    }
        
    

    $conn->close();

?>