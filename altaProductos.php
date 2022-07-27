<!DOCTYPE html>
<html lang="es">
<?php
    require ("conexion.php");?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="shorcut icon" type="image/x-icon" href="">
    <title>Alta Productos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
   

</head>
  <body>
  <?php	
	if(isset($_GET['editar'])){
      $idCone = conexion();
			$editar_id = $_GET['editar'];
			$consulta = "SELECT * FROM productos WHERE Id='$editar_id'";
			$ejecutar = mysqli_query($idCone,$consulta);
			$fila = mysqli_fetch_array($ejecutar);
      $ID = $fila['Id'];
			$nombre = $fila['nombre'];
			$unidad = $fila['unidad'];
			$stock = $fila['stock'];
      $precio = $fila['precio'];
      $descripcion = $fila['descripcion'];
      $nombrebtn = 'actualizar';
      $textbtn = 'Modificar';
      $deshabilitar = 'disabled';
      $titulo = 'Modificar Producto';
    }else{
      $ID = '';
      $nombre = '';
			$unidad = '';
			$stock = '';
      $precio = '';
      $descripcion = '';
      $nombrebtn = 'btnInsertar';
      $textbtn = 'Agregar';
      $deshabilitar = '';
      $titulo = 'Agregar Nuevo Producto';
    }
 
?>
 <div class="nav-content">
    <div class="nav-main">
     <img src="bebida.gif" alt="" class="nav-img">
     <ul class="nav-menu">
       <li><a href="Alta.php">Alta contactos</a></li>
       <li><a href="altaProductos.php" id="aquiestoy">Alta productos</a></li>
       <li><a href="productos.php">Productos</a></li>
       <li><a href=""></a></li>
     </ul>
    </div>
  </div>
  <div class="buscarCorreo">
     <form action="altaProductos.php" method="POST">
       <input type="text" name="txtBuscarProducto" placeholder="Ingresa ID de producto" required><button type="submit" name="btnBuscarProducto" class="iconoEditar"><i class="fas fa-search"></i></button>
      </form>
     
  </div>

  <div id="datosPersonales">
    <h2><?php echo$titulo; ?></h2>
    <br>
        <form class="form-personales" action="altaProductos.php" method="post">
        <input type="number" name="txtID" placeholder="ID" value="<?php echo $ID; ?>" <?php echo $deshabilitar?> required>
        <input type="hidden" name="txtIdproducto" placeholder="Idproducto" value="<?php echo $ID; ?>">
        <input type="text" name="Nombre" placeholder="Nombre" value="<?php echo $nombre; ?>" required>        
            <input type="text" name="Unidad" placeholder="Unidad" value="<?php echo $unidad; ?>" required>        
                <input type="number" name="Stock" placeholder="Stock" value="<?php echo $stock; ?>"  required>
                    <input  type="floatval" name="Precio" placeholder="Precio" value="<?php echo $precio; ?>" required> <textarea name="descripcion" ><?php echo$descripcion; ?></textarea>
                    <input  type ="submit" name='<?php echo $nombrebtn; ?>' value="<?php echo $textbtn; ?>">
                  </form>
                  
                </div>
       <?php
    
     if(isset($_POST['btnInsertar'])){

       $idCone = conexion();
       $ID = $_POST['txtID'];
       $Nombre = $_POST['Nombre'];
       $Unidad = $_POST['Unidad'];
       $Stock = $_POST['Stock'];
       $Precio = $_POST['Precio'];
       $descripcion = $_POST['descripcion'];
       $sql = "INSERT INTO productos (Id,nombre,unidad,stock,precio,fechaAlta,descripcion) values ($ID,'$Nombre','$Unidad',$Stock,$Precio,NOW(),'$descripcion')";
       $resultado = mysqli_query($idCone,$sql) or die ("Error de la query") ;
       if($resultado){
        echo'<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo "<script src='alert.js'></script>";
        echo"<script> setTimeout(\"location.href='altaProductos.php'\",3000)</script>";
        }else{
          echo"<p><h1>No se completo: $Nombre </h2></p>";
        }    
        mysqli_close($idCone);
      }
      
      ?>

      
     <table class="style-table">
       <tr> 
         <th><h3>ID</h3></th>  
         <th><h3>Nombre</h3></th>
         <th><h3>Unidad</h3></th>
         <th><h3>Stock</h3></th>
         <th><h3>Precio</h3></th>
         <th><h3>Fecha de Alta</h3></th>
         <th></th>
         <th></th>
        </tr>
        <?php 
        if(isset($_POST["btnBuscarProducto"])){
          $idCone = conexion();
          $getBuscar = $_POST["txtBuscarProducto"];
          $consulta = "SELECT * FROM productos WHERE Id='$getBuscar'";
          $resultado = mysqli_query($idCone,$consulta);
         $i = 0;
              while($row = mysqli_fetch_array($resultado)){
              $IdProducto = $row["Id"];
              $nombrePro = $row["nombre"];
              $unidadPro = $row["unidad"];
              $stockPro = $row["stock"];
              $precioPro = $row["precio"];
              $fechaAlta = $row["fechaAlta"];
              $i++;              
              ?>
              <tr> 
              <td><?php echo $IdProducto; ?></td>
              <td><?php echo $nombrePro; ?></td>
              <td><?php echo $unidadPro; ?></td>
              <td><?php echo $stockPro; ?></td>
              <td>$ <?php echo $precioPro; ?></td>
              <td><?php echo $fechaAlta; ?></td>
              <td><a href="altaProductos.php?editar=<?php echo$IdProducto?>" class="iconoEditar"><i class="far fa-edit text-info" ></i></a></td>
              <td><a href="altaProductos.php?borrar=<?php echo$IdProducto?>" id="iconoBorrar"><i class="far fa-trash-alt text-danger" ></i></a></td>
              </tr>
          <?php  } }else{
$idCone = conexion();           
$consulta = "SELECT * FROM productos";
  $resultado = mysqli_query($idCone,$consulta);
   $i = 0;
          while($row = mysqli_fetch_array($resultado)){ 
            $IdProducto = $row["Id"];
            $nombrePro = $row["nombre"];
            $unidadPro = $row["unidad"];
            $stockPro = $row["stock"];
            $precioPro = $row["precio"];
            $fechaAlta = $row["fechaAlta"];
            $i++;              
            ?>
            <tr> 
            <td><?php echo $IdProducto; ?></td>
            <td><?php echo $nombrePro; ?></td>
            <td><?php echo $unidadPro; ?></td>
            <td><?php echo $stockPro; ?></td>
            <td>$ <?php echo $precioPro; ?></td>
            <td><?php echo $fechaAlta; ?></td>
            <td><a href="altaProductos.php?editar=<?php echo$IdProducto?>" class="iconoEditar"><i class="far fa-edit text-info" ></i></a></td>
            <td><a href="altaProductos.php?borrar=<?php echo$IdProducto?>" id="iconoBorrar"><i class="far fa-trash-alt text-danger" ></i></a></td>
          </tr>

          <?php }}?> 
          
                </table>
                <?php
    
    if(isset($_GET['borrar'])){
     
      $idCone = conexion();
      $borrar_Pro = $_GET['borrar'];
      $sql = "DELETE FROM productos WHERE Id='$borrar_Pro'";
    $resultado = mysqli_query($idCone,$sql) or die ("Error de la query") ;
    if($resultado){
      echo'<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
      echo '<script >Swal.fire({title: "Producto eliminado",icon: "success",
        showConfirmButton: false,toast: true,position: "top-start"})</script>';
      echo"<script> setTimeout(\"location.href='altaProductos.php'\",1000)</script>";
     }else{
       echo"<p><h1>No se completo: $borrar_Pro </h2></p>";
     }    
     mysqli_close($idCone);
   }
   
     ?>
   
     <?php

if(isset($_POST['actualizar'])){
    $idCone = conexion();
    $IdProducto = $_POST['txtIdproducto'];
    $actualizarNombre = $_POST['Nombre'];
    $actualizarUnidad = $_POST['Unidad'];
    $actualizarStock = $_POST['Stock'];
    $actualizarPrecio = $_POST['Precio'];
    $descripcion = $_POST['descripcion'];
    $consulta = "UPDATE productos SET nombre='$actualizarNombre', unidad='$actualizarUnidad', stock='$actualizarStock',precio='$actualizarPrecio',fechaAlta=NOW(),descripcion='$descripcion' WHERE Id='$IdProducto'";
    $ejecutar = mysqli_query($idCone, $consulta);
    if($ejecutar){
      echo'<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
      echo "<script src='alert.js'></script>";
      echo"<script> setTimeout(\"location.href='altaProductos.php'\",3000)</script>";
    }		
  }
  

?>

            
               
               
                </body>
                </html>