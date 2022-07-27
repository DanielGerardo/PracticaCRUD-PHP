<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Lista de contactos</title>
</head>
<body>
    <?php 
    $servidor = "localhost";
    $base = "agenda";
    $usuario = "root";
    $contra = "";
    
    $conexion= mysqli_connect($servidor,$usuario,$contra);
    mysqli_select_db($conexion,$base) or die("Error en la conexion base");

      $consulta = "SELECT * FROM contactos";
      $resultado = mysqli_query($conexion,$consulta);
         echo'<table class="style-table" >';
         echo'<tr> 
              
              <th>Nombre</th>
              <th>Direccion</th>
              <th>Correo</th>
              <th>Telefono</th>
              </th>
              ';
              while($row = mysqli_fetch_array($resultado)){
              echo'<tr>';
              
              echo'<td>' . $row["nombre"] . "</td>";
              echo'<td>' . $row["direccion"] . "</td>";
              echo'<td>' . $row["correo"] . "</td>";
              echo'<td>' . $row["telefono"] . "</td>";
              echo '</tr>';

              
              }

              echo '</table>';
            
    ?>
</body>
</html>