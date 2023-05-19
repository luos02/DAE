<?php

function crearCB($tablaCB,$filaCB){
    include("../../controlador/conexion_db.php");
    $consultaCB=mysqli_query($conexion,"select ".$filaCB." from ".$tablaCB.";");
    $numFilasConsulta = mysqli_num_rows($consultaCB);
    for($i=0;$i<$numFilasConsulta;$i++){
        $filasConsulta=mysqli_fetch_array($consultaCB);
        echo"<option value='$filasConsulta[0]'>".$filasConsulta[0]."</option>";
    }
    mysqli_close($conexion);
}
?>