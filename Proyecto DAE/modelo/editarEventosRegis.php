<?php
include("../../controlador/conexion_db.php");

if(isset($_POST["btnEditarEvento"])){
    if(strlen($_POST['txtIDEvento'])<1 || strlen($_POST['txtNoEvento'])<1) {
        ?>
            <h3>No se pudo editar el evento</h3>
            <?php
    }else{
        $idEvento=trim($_POST['txtIDEvento']);
        $nombreEvento=trim($_POST['txtNoEvento']);
        $horaIEvento=trim($_POST['txtHoraInicioEvento']);
        $horaFEvento=trim($_POST['txtHoraFinEvento']);
        $fechaIEvento=trim($_POST['txtFechaInicioEvento']);
        $fechaFEvento=trim($_POST['txtFechaFinEvento']);
        //Tablas
        $arregloTablasAgregar=array('plantel','disponibilidad','coordinacion','tipo_evento');
        //id
        $arregloColumnasAgregar=array('id_plantel','id_disponibilidad','id_coordinacion','id_tipo_evento');
        //
        $arregloCBs=array("plantelEvento",'disponEvento','coordEvento','tipoEvento');
        $arregloResultadosCBs=array('nombre_plantel','estado','coordinacion','tipo');
        $arregloRecibidos=array();
        $arreglosIDs=array();

        for($i=0;$i<4;$i++){
            $resultadoBusqueda[$i]=mysqli_query($conexion,"select ".$arregloColumnasAgregar[$i]." from ".$arregloTablasAgregar[$i]." where ".$arregloResultadosCBs[$i]."= '".$_POST[$arregloCBs[$i]]."';");
            $arregloIDGuardar=mysqli_fetch_array($resultadoBusqueda[$i]);
            $arregloRecibidos[$i]=$arregloIDGuardar[0];
        }
        $queryEditar = "update acontecimiento set descripcion_evento = '$nombreEvento', hora_inicio = '$horaIEvento', hora_fin = '$horaFEvento', fecha_inicio = '$fechaIEvento', fecha_fin='$fechaFEvento', id_plantel_acon = '$arregloRecibidos[0]', id_disponibilidad_acon = '$arregloRecibidos[1]',id_coordinacion_acon = $arregloRecibidos[2], id_tipo_acon = $arregloRecibidos[3] where id_acontecimiento=$idEvento;";
        try{
            $resultado=mysqli_query($conexion,$queryEditar);
            ?>
            <h3>Evento editado</h3>
            <meta http-equiv="refresh" content="1">
            <?php
        }catch(Exception $e){
            ?>
            <h3>No se pudo editar el evento</h3>
            <?php
        }
    }
}

mysqli_close($conexion);
?>