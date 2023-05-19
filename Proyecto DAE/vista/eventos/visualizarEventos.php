<?php
include("../../controlador/conexion_db.php");
$consultarNoEventos=mysqli_query($conexion,"SELECT COUNT(*) FROM acontecimiento;");
$consultarIdEventos=mysqli_query($conexion,"select DISTINCT id_evento FROM datos2;");
$id_lista = array();
while ($fila = mysqli_fetch_assoc($consultarIdEventos)) {
    $id_lista[] = $fila['id_evento'];
}
$row = mysqli_fetch_array($consultarNoEventos);
$total = $row[0];
$consultarInfoEventos=mysqli_query($conexion,"select * from acontecimiento");
if($total>0){
    for($i=0;$i<$total;$i++){
        $arregloEventos=mysqli_fetch_array($consultarInfoEventos);
        $consultarNoAsistentes=mysqli_query($conexion,"select COUNT(*) FROM datos2 where id_evento = '$arregloEventos[0]';");
        $arregloAsistentes = mysqli_fetch_array($consultarNoAsistentes);

        echo"<details><summary> • Asistentes: $arregloAsistentes[0] </br> • $arregloEventos[1] </br> • $arregloEventos[2]&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </br> <a href='editarevento.php?idevento=".$arregloEventos[0]."' class='botonesDetalles'>Detalles</a></summary></details>";
    }
}else{
    echo"No hay ningun evento todavia";
}

mysqli_close($conexion);

?>