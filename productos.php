<!DOCTYPE html>
<html lang="es">
<?php
    require ("conexion.php");
    session_start();?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="shorcut icon" type="image/x-icon" href="">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2&display=swap" rel="stylesheet">
    <title>Alta Productos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
   

</head>
  <body>
 <div class="nav-content">
    <div class="nav-main">
     <img src="bebida.gif" alt="" class="nav-img">
     <ul class="nav-menu">
       <li><a href="Alta.php">Alta contactos</a></li>
       <li><a href="altaProductos.php" >Alta productos</a></li>
       <li><a href="productos.php" id="aquiestoy">Productos</a></li>
       <li><a href=""></a></li>
     </ul>
    </div>
  </div>
  <div class="buscarCorreo">
     <form action="productos.php" method="POST">
       <input type="text" name="txtBuscarProducto" placeholder="Ingresa nombre de producto" required><button type="submit" name="btnBuscarProducto" class="iconoEditar"><i class="fas fa-search"></i></button>
      </form>
     
  </div>

  <div id="datosPersonales">
    <h2>Lista de Productos</h2>

  </div>  
     <table class="lista-productos">
     
        
    
        <?php 
        if(isset($_POST["btnBuscarProducto"])){
          $idCone = conexion();
          $getBuscar = $_POST["txtBuscarProducto"];
          $consulta = "SELECT * FROM productos WHERE nombre='$getBuscar'";
          $resultado = mysqli_query($idCone,$consulta);
         $i = 0;
              while($row = mysqli_fetch_array($resultado)){
                $IdProducto = $row["Id"];
              $nombrePro = $row["nombre"];
              $unidadPro = $row["unidad"];
              $stockPro = $row["stock"];
              $precioPro = $row["precio"];
              $fechaAlta = $row["fechaAlta"];
              $descripcionPro = $row["descripcion"];
              
              $i++;              
              ?>           
                 <form action="productos.php" method="POST">
                <tbody>
                   <tr>    
                      <input type="hidden" name="stockCarrito" value="<?php echo $stockPro; ?>">
                     <td ><input type="hidden" name="idCarrito" value="<?php echo $IdProducto; ?>"><?php echo $IdProducto; ?></td> 
                     <td><input type="hidden" name="nombreCarrito" value="<?php echo $nombrePro; ?>"><?php echo $nombrePro; ?></td>
                    <td ><input type="hidden" name="cantidad" value="1"><?php echo $descripcionPro; ?></td>
                    <td ><input type="hidden" name="precioCarrito" value="<?php echo $precioPro; ?>">$<?php echo $precioPro; ?></td>
                    <td ><button type="submit" name="carrito" class="iconoEditar"><i class="fas fa-shopping-cart"></i></button></td>
                  </tr>
                  
                </tbody>
               </form>
                 </form>
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
              $descripcionPro = $row["descripcion"];
              
              $i++;              
              ?>           
                 <form action="productos.php" method="POST">
                <tbody>
                   <tr>    
                      <input type="hidden" name="stockCarrito" value="<?php echo $stockPro; ?>">
                     <td ><input type="hidden" name="idCarrito" value="<?php echo $IdProducto; ?>"><?php echo $IdProducto; ?></td> 
                     <td><input type="hidden" name="nombreCarrito" value="<?php echo $nombrePro; ?>"><?php echo $nombrePro; ?></td>
                    <td ><input type="hidden" name="cantidad" value="1"><?php echo $descripcionPro; ?></td>
                    <td ><input type="hidden" name="precioCarrito" value="<?php echo $precioPro; ?>">$<?php echo $precioPro; ?></td>
                    <td ><button type="submit" name="carrito" class="iconoEditar"><i class="fas fa-shopping-cart"></i></button></td>
                  </tr>
                  
                </tbody>
               </form>
                <?php }}?> 
              </table>
             
   <table class="carritoCompras">
     
     <thead>
        <tr>
          <th colspan="3" id="titulo-carrito"><h2>Carrito</h2></th>
          <th><i class="fas fa-shopping-cart"></i></th>
        </tr>
       <tr>
         <th>Nombre</th>
         <th>Cantidad</th>
         <th>Precio</th>
         <th>Total</th>
         <th></th>
        </tr>
      </thead>
     <?php 
    
  if(isset($_POST['carrito'])){
    $IdCarrito = $_POST['idCarrito'];
    $nombreCarrito = $_POST['nombreCarrito'];
    $cantidadCarrito = $_POST['cantidad'];
    $stockCarrito = $_POST['stockCarrito'];
    $precioCarrito = $_POST['precioCarrito'];
  if(!isset($_SESSION['CARRITO'])){
     $producto = array( 
      "ID" => $IdCarrito,
      "Nombre" => $nombreCarrito,
      "Cantidad" => $cantidadCarrito,
      "Stock" => $stockCarrito,
      "Precio" => $precioCarrito,
      ); 
      $_SESSION['CARRITO'][0]=$producto;
        
      }
      else{
        $IDproducto = array_column($_SESSION['CARRITO'],"ID");
        if(in_array($IdCarrito,$IDproducto)){
          
          foreach($_SESSION['CARRITO'] as $indice=>$producto){
            
            if($producto['Stock']==1){
              
              
            }else{
              
              $contarProductos= count($_SESSION['CARRITO']);
            $cantidadCarrito = 1+$producto["Cantidad"];
            $stockCarrito = $producto['Stock']-1;
            $producto = array( 
              "ID" => $IdCarrito,
              "Nombre" => $nombreCarrito,
              "Cantidad" => $cantidadCarrito,
              "Stock" => $stockCarrito,
              "Precio" => $precioCarrito,
            );  
            $_SESSION['CARRITO'][$contarProductos-1]=$producto;
          }          
        }
      }else{
            
            $contarProductos= count($_SESSION['CARRITO']);
            $producto = array( 
            "ID" => $IdCarrito,
            "Nombre" => $nombreCarrito,
            "Cantidad" => $cantidadCarrito,
            "Stock" => $stockCarrito,
            "Precio" => $precioCarrito,
          ); 
          
          $_SESSION['CARRITO'][$contarProductos]=$producto;
        }
        }
      }
      if(!empty($_SESSION['CARRITO'])){
        ?>
       <?php 
       $total=0;
       foreach($_SESSION['CARRITO'] as $indice=>$producto){?>
       <tr> 
         <td ><?php echo $producto["Nombre"]; ?></td>
         <td ><?php echo $producto["Cantidad"]; ?></td>
         <td >$ <?php echo $producto["Precio"]; ?></td>
         <td >$ <?php echo number_format($producto["Precio"]*$producto["Cantidad"],2);?></td>
         <td>
           <a href="productos.php?eliminar=<?php echo $producto["ID"];?>" id="iconoBorrar"><i class="far fa-trash-alt text-danger" ></i></a></td> 
        </tr>
        <?php $total=$total+($producto["Precio"]*$producto["Cantidad"]);?>
        <?php  } }else{
          $total = 0;
        } ?> 
        <tr>
          <tfoot>
            <td colspan="2"><input type="submit" value="Comprar"></td>
            <td ><h3>Total</h3></td>
            <td id="total-carrito"><h3>$<?php echo number_format($total,2)?></h3></td>
          </tfoot>
        </tr>
    <?php  ?>
      </table>
  <?php 
    if(isset($_GET['eliminar'])){
      $idprocarrito = $_GET['eliminar'];
      foreach($_SESSION['CARRITO'] as $indice=>$producto){
        
        
        if($producto['ID']==$idprocarrito){
          unset($_SESSION['CARRITO'][$indice]);
          echo'<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
          echo '<script >Swal.fire({title: "Producto eliminado",icon: "success",
            showConfirmButton: false,toast: true,position: "top-start"})</script>';
          echo"<script> setTimeout(\"location.href='productos.php'\",1000)</script>";
        }
      }
    }
  ?>    
      
      
      
      
    </body>
    </html>