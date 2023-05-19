<?php
include("../../controlador/conexion_db.php");

$consultarNoCLases=mysqli_query($conexion,"SELECT COUNT(*) FROM clase;");
$row = mysqli_fetch_array($consultarNoCLases);
$total = $row[0];
$consultarInfoClases=mysqli_query($conexion,"select * from clase");

if($total>0){
    for($i=0;$i<$total;$i++){
        $arregloClases=mysqli_fetch_array($consultarInfoClases);
        echo"<li>$arregloClases[1] | Clave plantel: $arregloClases[2] Clave impartidor: $arregloClases[3] Clave periodo: $arregloClases[4] &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a href='editarclase.php?idclase=".$arregloClases[0]."' class='botonesDetalles'>Detalles</a></li><br>";
    }
}else{
    echo"No hay ninguna clase registrada todavia";
}

mysqli_close($conexion);

?>