<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <form method="POST" action="borrar.php">
     <input type="text" name="nombre" placeholder="Nombre" required>
     <input type="submit" name="btnBorrar" value="Borrar">

    </form>

    <?php
    $server="localhost";
    $base="agenda";
    $usuario="root";
    $pass="";

    $conexion=mysqli_connect($server,$usuario,$pass);
    mysqli_select_db($conexion,$base);

    $nombre=$_POST['nombre'];

           $consultaDelete = "DELETE from contactos WHERE nombre ='".$nombre."'";
           $consultaTabla = "SELECT * FROM contactos";
           $resultadoDelete = mysqli_query($conexion,$consultaDelete);
           $resultadoTabla = mysqli_query($conexion,$consultaTabla);

           //require ("mostrar.php");
           echo'<table border="2px">';
           echo'<tr> 
              
              <th>Nombre</th>
              <th>Direccion</th>
              <th>Correo</th>
              <th>Telefono</th>
              </th>
              ';
              while($row = mysqli_fetch_array($resultadoTabla)){
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