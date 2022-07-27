<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Alta de Registros</title>
</head>
<body>
    <?php
    require ("conexion.php");

    $idCone = conexion();

     $Nombre = $_POST['Nombre'];
     $Direccion = $_POST['Direccion'];
     $Correo = $_POST['Correo'];
     $Telefono = $_POST['Telefono'];

     $sql = "INSERT INTO contactos (nombre,direccion,correo,telefono) values ('$Nombre','$Direccion','$Correo','$Telefono')";
     $resultado = mysqli_query($idCone,$sql) or die ("Error de la query") ;
     if($resultado){
        echo "<script>alert('Registro con exito!')</script>";
        echo "<script>window.open('Alta.html', '_self')</script>";
     }else{
        echo"<p><h1>No se completo: $Nombre </h2></p>";
     }

     mysqli_close($idCone);
     ?>
</body>
</html>