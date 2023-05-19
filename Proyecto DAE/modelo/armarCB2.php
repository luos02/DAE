<?php

function crearCB($tablaCB,$filaCB,$data){
    include("../../controlador/conexion_db.php");
    $consultaCB=mysqli_query($conexion,"select ".$filaCB." from ".$tablaCB.";");
    $numFilasConsulta = mysqli_num_rows($consultaCB);

    for($i=0;$i<$numFilasConsulta;$i++){
        $filasConsulta=mysqli_fetch_array($consultaCB);
        if($filasConsulta[0] == $data){
            echo"<option value='$filasConsulta[0] selected'>".$filasConsulta[0]."</option>";
        }
        else{
            echo"<option value='$filasConsulta[0]'>".$filasConsulta[0]."</option>";
        }
        
    }

    mysqli_close($conexion);
}
?>