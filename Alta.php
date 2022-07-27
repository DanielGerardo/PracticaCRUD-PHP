<!DOCTYPE html>
<html lang="es">
<?php
    require ("conexion.php");?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="shorcut icon" type="image/x-icon" href="">
    <title>Agenda 2021</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
   

</head>
  <body>
  <div class="nav-content">
    <div class="nav-main">
     <img src="bebida.gif" alt="" class="nav-img">
     <ul class="nav-menu">
       <li><a href="Alta.php"id="aquiestoy">Alta contactos</a></li>
       <li><a href="altaProductos.php">Alta productos</a></li>
       <li><a href="productos.php">Productos</a></li>
       <li><a href=""></a></li>
     </ul>
    </div>
  </div>
  <?php	
	if(isset($_GET['editar'])){
      $idCone = conexion();
			$editar_id = $_GET['editar'];
			$consulta = "SELECT * FROM contactos WHERE correo='$editar_id'";
			$ejecutar = mysqli_query($idCone,$consulta);
			$fila = mysqli_fetch_array($ejecutar);
			$nombre = $fila['nombre'];
			$direccion = $fila['direccion'];
			$correo = $fila['correo'];
      $telefono = $fila['telefono'];
      $nombrebtn = 'actualizar';
      $textbtn = 'Modificar';
      $deshabilitar = 'disabled';
      $titulo = 'Modificar Contacto';
    }else{
      $nombre = '';
			$direccion = '';
			$correo = '';
      $telefono = '';
      $nombrebtn = 'btnInsertar';
      $textbtn = 'Agregar';
      $deshabilitar = '';
      $titulo = 'Agregar Nuevo Contacto';
    }
 
?>
  
  <div class="buscarCorreo">
     <form action="Alta.php" method="POST">
       <input type="text" name="txtBuscarCorreo" placeholder="Buscar Correo" required><button type="submit" name="btnBuscarCorreo" class="iconoEditar"><i class="fas fa-search"></i></button>
      </form>
     
  </div>

  <div id="datosPersonales">
    <h2><?php echo$titulo; ?></h2>
    <br>
        <form class="form-personales" action="Alta.php" method="post">
        <input type="text" name="Nombre" placeholder="Nombre" value="<?php echo $nombre; ?>" required>        
            <input type="text" name="Direccion" placeholder="Direccion" value="<?php echo $direccion; ?>" required>        
                <input type="text" name="Correo" placeholder="Correo" value="<?php echo $correo; ?>" <?php echo $deshabilitar?> required>
                    <input type="text" name="Telefono" placeholder="Telefono" value="<?php echo $telefono; ?>"  required>  
                    <input  type ="submit" name='<?php echo $nombrebtn; ?>' value="<?php echo $textbtn; ?>">
                  </form>
                  
                </div>
       <?php
    
     if(isset($_POST['btnInsertar'])){

       $idCone = conexion();
       $Nombre = $_POST['Nombre'];
       $Direccion = $_POST['Direccion'];
       $Correo = $_POST['Correo'];
       $Telefono = $_POST['Telefono'];
       
       $sql = "INSERT INTO contactos (nombre,direccion,correo,telefono,fechaAlta) values ('$Nombre','$Direccion','$Correo','$Telefono',NOW())";
       $resultado = mysqli_query($idCone,$sql) or die ("Error de la query") ;
       if($resultado){
        echo'<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo "<script src='alert.js'></script>";
        echo"<script> setTimeout(\"location.href='Alta.php'\",3000)</script>";
        }else{
          echo"<p><h1>No se completo: $Nombre </h2></p>";
        }    
        mysqli_close($idCone);
      }
      
      ?>

      
     <table class="style-table">
       <tr> 
           
         <th><h3>Nombre</h3></th>
         <th><h3>Direccion</h3></th>  
         <th><h3>Correo</h3></th>
         <th><h3>Telefono</h3></th>
         <th><h3>Fecha de Alta</h3></th>
         <th></th>
         <th></th>
        </tr>
        <?php 
        if(isset($_POST["btnBuscarCorreo"])){
          $idCone = conexion();
          $getBuscar = $_POST["txtBuscarCorreo"];
          $consulta = "SELECT * FROM contactos WHERE correo='$getBuscar'";
          $resultado = mysqli_query($idCone,$consulta);
         $i = 0;
              while($row = mysqli_fetch_array($resultado)){
              
              $nombreUser = $row["nombre"];
              $direccionUser = $row["direccion"];
              $correoUser = $row["correo"];
              $telUser = $row["telefono"];
              $fechaAlta = $row["fechaAlta"];
              $i++;              
              ?>
              <tr> 
              <td><?php echo $nombreUser; ?></td>
              <td><?php echo $direccionUser; ?></td>
              <td><?php echo $correoUser; ?></td>
              <td><?php echo $telUser; ?></td>
              <td><?php echo $fechaAlta; ?></td>
              <td><a href="Alta.php?editar=<?php echo $correoUser; ?>" class="iconoEditar"><i class="far fa-edit text-info" ></i></a></td>
              <td><a href="Alta.php?borrar=<?php echo $correoUser; ?>" id="iconoBorrar"><i class="far fa-trash-alt text-danger" ></i></a></td>
              </tr>
          <?php  } }else{
$idCone = conexion();           
$consulta = "SELECT * FROM contactos";
  $resultado = mysqli_query($idCone,$consulta);
   $i = 0;
          while($row = mysqli_fetch_array($resultado)){ 
          $nombreUser = $row["nombre"];
          $direccionUser = $row["direccion"];
          $correoUser = $row["correo"];
          $telUser = $row["telefono"];
          $fechaAlta = $row["fechaAlta"];
          
          $i++;              
          ?>     
          <tr> 
          <td><?php echo $nombreUser; ?></td>
          <td><?php echo $direccionUser; ?></td>
          <td><?php echo $correoUser; ?></td>
          <td><?php echo $telUser; ?></td>
          <td><?php echo $fechaAlta; ?></td>
          <td><a href="Alta.php?editar=<?php echo $correoUser; ?>" class="iconoEditar"><i class="far fa-edit text-info" ></i></a></td>
          <td><a href="Alta.php?borrar=<?php echo $correoUser; ?>" id="iconoBorrar"><i class="far fa-trash-alt text-danger" ></i></a></td>
          </tr>

          <?php }}?> 
          
                </table>
                <?php
    
    if(isset($_GET['borrar'])){
     
      $idCone = conexion();
      $borrar_user = $_GET['borrar'];
      $sql = "DELETE FROM contactos WHERE correo='$borrar_user'";
    $resultado = mysqli_query($idCone,$sql) or die ("Error de la query") ;
    if($resultado){
      echo'<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
      echo '<script >Swal.fire({title: "Producto eliminado",icon: "success",
        showConfirmButton: false,toast: true,position: "top-start"})</script>';
      echo"<script> setTimeout(\"location.href='Alta.php'\",1000)</script>";
     }else{
       echo"<p><h1>No se completo: $borrar_user </h2></p>";
     }    
     mysqli_close($idCone);
   }
   
     ?>
   
     <?php

if(isset($_POST['actualizar'])){
  $getCorreo = $correoUser;
  $consultaIdUser = "SELECT (Id) FROM contactos WHERE correo='$getCorreo'";
  $resultadoIdUser = mysqli_query($idCone, $consultaIdUser);  
  $idFila = mysqli_fetch_array($resultadoIdUser);
  $IdUser = $idFila['Id'];
  
  if($idFila){
    $idCone = conexion();
    $actualizarNombre = $_POST['Nombre'];
    $actualizarDireccion = $_POST['Direccion'];
    $actualizarCorreo = $correoUser;
    $actualizarTelefono = $_POST['Telefono'];
    
    $consulta = "UPDATE contactos SET nombre='$actualizarNombre', direccion='$actualizarDireccion', correo='$actualizarCorreo',telefono='$actualizarTelefono',fechaAlta=NOW() WHERE Id='$IdUser'";
    $ejecutar = mysqli_query($idCone, $consulta);
    if($ejecutar){
      echo'<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
      echo "<script src='alert.js'></script>";
      echo"<script> setTimeout(\"location.href='Alta.php'\",3000)</script>";
    }		
  }
  }
  
?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
                           
                </body>
                </html>