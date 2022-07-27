<?php
function conexion (){
    $host = "localhost";
    $usuario = "root";
    $clave = "";
    $base = 'agenda';

    $idCone = mysqli_connect($host,$usuario,$clave,$base) or die ("Error no hay conexión");
     
    return $idCone;
}
?>