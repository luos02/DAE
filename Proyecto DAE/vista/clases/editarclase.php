<?php

    include("../../modelo/armarCB.php");

    $id = $_GET['idclase'];
    include("../../controlador/conexion_db.php");
    $editar=mysqli_query($conexion,"select * FROM clase WHERE id_clase = $id;");
    $row = mysqli_fetch_array($editar);
    require_once("../plantilla/encabezado.php");
?>
    
    <div id="agregar">
        <form action="" method="POST" id="frmEditarEvento">
            
            <h2>Editar evento</h2>
            <br>
            <label id="d" for="">Clave de la clase
            <input type="text" id="nE" name="txtIDClase" readonly value="<?php echo $row[0]; ?>">
            </label>
            <br>

            <label id="d" for="">Descripcion de la clase    
            <input type="text" id="nE" name="txtDescClase" value="<?php echo $row[1]; ?>">
            </label>
            <br><br>

            <label  for="">Plantel donde se imparte la clase
                <select name="slctPlantelClase" id="">
                    <?php
                        crearCB("plantel","nombre_plantel",$row[2]);
                    ?>
                </select>
            </label>
            <br><br>

            <label  for="">Impartidor de la clase
                <select name="slctImpartidorClase" id="">
                    <?php
                            include("conexion_db.php");
                            $consultaCB="select nombre_persona from persona inner join logins on id_persona=id_persona_log where logins.rol=1;";
                            $resultadoConsulta=mysqli_query($conexion,$consultaCB);
                            $numFilasConsulta = mysqli_num_rows($resultadoConsulta);
                            for($i=0;$i<$numFilasConsulta;$i++){
                                $filasConsulta=mysqli_fetch_array($resultadoConsulta);
                                echo"<option value='$filasConsulta[0]'>".$filasConsulta[0]."</option>";
                            }
                            mysqli_close($conexion);
                        ?>
                </select>
            </label>
            <br><br>

            <label for="">Periodo escolar de la clase
                    <select name="slctPeriodoClase" id="">
                        <?php
                        crearCB("periodo","id_periodo");
                        ?>
                    </select>
            </label>
            <br><br>
    
            <button id="start" name="btnEditarClase">Actualizar</button>
            <br>
            <button id="start" name="btnEliminarClase">Eliminar</button>
        

        </form>
        
        <?php
            include("../../modelo/eliminarClase.php");
        ?>

    </div>   


<?php
require_once("../plantilla/pie.php");
?>