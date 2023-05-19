<?php
include("../../controlador/conexion_db.php");

if(isset($_POST["btnCrearEvento"])){
    if(strlen($_POST['txtIDEvento'])<1 || strlen($_POST['txtNoEvento'])<1) {
        ?>
            <h3>No se pudo registrar el evento</h3>
            <?php
    }else{
        
        
        
        //excel
        if(isset($_FILES['archivoExcel']['name'])){
            $carpeta_archivos="../../subidas/";
        $archivo_subido=$carpeta_archivos.basename($_FILES['archivoExcel']['name']);
        $archivoCorrecto=1;
        $tipoArchivo=strtolower(pathinfo($archivo_subido,PATHINFO_EXTENSION));
        $isfirst = true;
        $lista = array();

        if(file_exists($archivo_subido)){
            echo"Ya existe el archivo\n";
            $archivoCorrecto=0;
        }

        if ($_FILES["archivoExcel"]["size"] > 500000) {
            echo "El archivo es demasiado grande<br>";
            $archivoCorrecto = 0;
        }

        if($tipoArchivo!="csv"){
            echo "Error, solo se permiten archivos con extensión .csv<br>";
            $archivoCorrecto = 0;
        }
        
        if ($archivoCorrecto == 0) {
            echo "No se subió el archivo<br>";
        }
        else{
            if(move_uploaded_file($_FILES["archivoExcel"]["tmp_name"], $archivo_subido)) {
                $archivoManejado=basename( $_FILES["archivoExcel"]["name"]);
                echo "Se subió el archivo ". htmlspecialchars($archivoManejado)."<br>";
                $rutaArchivoManejado=$carpeta_archivos."/".$archivoManejado;
                try{
                    if($lectorArchivo=fopen($rutaArchivoManejado,'r')){
                        while($datos=fgetcsv($lectorArchivo,200,',')){
                            $sql = "";
                            if($isfirst){
                                $isfirst = false;
                            }
                            else{
                                $sql = "insert INTO datos2 (id_evento,correo_Electrónico, cantidad, tipo_de_entrada, Asistente_no, Tipo_de_pedido) VALUES (".trim($_POST['txtIDEvento']).",'$datos[0]', '$datos[1]', '$datos[2]', '$datos[3]', '$datos[4]');";
                                array_push($lista,$sql);
                            }
                        }
                        fclose($lectorArchivo);
                    }
                }catch(Exception $e){
                    ?>
                    <h3>No se pudo subir el evento</h3>
                    <?php
                    echo $e;
                }

            }
            else{
                echo "Hubo un error al subir el archivo<br>";
            }
        }
        }
        //fin excel


        if(strlen($_POST['txtIDEvento'])>0 && strlen($_POST['txtNoEvento'])>0){
            $idEvento=trim($_POST['txtIDEvento']);
        $nombreEvento=trim($_POST['txtNoEvento']);
        $horaIEvento=trim($_POST['txtHoraInicioEvento']);
        $horaFEvento=trim($_POST['txtHoraFinEvento']);
        $fechaIEvento=trim($_POST['txtFechaInicioEvento']);
        $fechaFEvento=trim($_POST['txtFechaFinEvento']);
        $arregloTablasAgregar=array('plantel','disponibilidad','coordinacion','tipo_evento');
        $arregloColumnasAgregar=array('id_plantel','id_disponibilidad','id_coordinacion','id_tipo_evento');
        $arregloCBs=array("plantelEvento",'disponEvento','coordEvento','tipoEvento');
        $arregloResultadosCBs=array('nombre_plantel','estado','coordinacion','tipo');
        $arregloRecibidos=array();
        $arreglosIDs=array();
        for($i=0;$i<4;$i++){
            $resultadoBusqueda[$i]=mysqli_query($conexion,"select ".$arregloColumnasAgregar[$i]." from ".$arregloTablasAgregar[$i]." where ".$arregloResultadosCBs[$i]."= '".$_POST[$arregloCBs[$i]]."';");
            $arregloIDGuardar=mysqli_fetch_array($resultadoBusqueda[$i]);
            $arregloRecibidos[$i]=$arregloIDGuardar[0];
        }
        $queryInsertar="insert into acontecimiento values('$idEvento','$nombreEvento','$horaIEvento','$horaFEvento','$fechaIEvento','$fechaFEvento','$arregloRecibidos[0]','$arregloRecibidos[1]','$arregloRecibidos[2]','$arregloRecibidos[3]');";
        try{
            $cant = count($lista);

                for ($i=0; $i < $cant ; $i++) { 
                    $resultado=mysqli_query($conexion,$lista[$i]);
                }

                $resultado2=mysqli_query($conexion,$queryInsertar);
                ?>
                <h3>Evento registrado</h3>
                <?php
            }catch(Exception $e){
                ?>
                <h3>No se pudo registrar el evento</h3>
                <?php
            }
        }
    }
}

mysqli_close($conexion);
?>