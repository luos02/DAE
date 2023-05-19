<?php

    include("../../modelo/armarCB2.php");

    $id = $_GET['idevento'];
    include("../../controlador/conexion_db.php");
    $editar=mysqli_query($conexion,"select * FROM acontecimiento WHERE id_acontecimiento = $id;");
    $row = mysqli_fetch_array($editar);
    $fecha_formateada1 = date("Y-m-d", strtotime($row[4]));
    $fecha_formateada2 = date("Y-m-d", strtotime($row[5]));
    $hora_formateada1 = date("H:i", strtotime($row[2]));
    $hora_formateada2 = date("H:i", strtotime($row[3]));
?>

<?php
require_once("../plantilla/encabezadoEventos.php");
?>
    
    <div id="agregar">
        <form action="" method="POST">
            
            <h2>Editar evento</h2>
            <br>
            <label id="d" for="">Clave del evento
            <input type="text" id="nE" name="txtIDEvento" readonly value="<?php echo $row[0]; ?>">
            </label>
            <br>

            <label id="d" for="">Nombre del evento    
            <input type="text" id="nE" name="txtNoEvento" value="<?php echo $row[1]; ?>">
            </label>
            <br>
            

            <label  for="">Fecha de inicio del evento
                <input type="date" class="fecha" name="txtFechaInicioEvento" value = "<?php echo $fecha_formateada1; ?>">
            </label>
            <br>

            <label  for="">Fecha de termino del evento
                <input type="date" class="fecha" name="txtFechaFinEvento" value= "<?php echo $fecha_formateada2; ?>">
            </label>
            <br>

            <label  for="">Hora de inicio del evento
                <input type="time" class="fecha" name="txtHoraInicioEvento" value= "<?php echo $hora_formateada1; ?>">
            </label>
            <br>

            <label  for="">Hora de termino del evento
                <input type="time" class="fecha" name="txtHoraFinEvento" value= "<?php echo $hora_formateada2; ?>">
            </label>
            <br>

            <label  for="">Plantel de ubicacion del evento
                <select name="plantelEvento" id="">
                    <?php
                        crearCB("plantel","nombre_plantel",$row[6]);
                    ?>
                </select>
            </label>
            <br><br>

            <label  for="">Disponibilidad del evento
                <select name="disponEvento" id="">
                    <?php
                        crearCB("disponibilidad","estado",$row[7]);
                    ?>
                </select>
            </label>
            <br><br>

            <label  for="">Coordinacion a cargo del evento
                <select name="coordEvento" id="">
                    <?php
                        crearCB("coordinacion","coordinacion",$row[8]);
                    ?>
                </select>
            </label>
            <br><br>

            <label  for="">Tipo de evento
                <select name="tipoEvento" id="">
                    <?php
                        crearCB("tipo_evento","tipo",$row[9]);
                    ?>
                </select>
            </label>
            <br><br>
    
            <button id="start" name="btnEditarEvento">Actualizar</button>

            <button id="start" name="btnEliminarEvento">Eliminar</button>
        

        </form>
        
        <?php
            include("../../modelo/editarEventosRegis.php");
            include("../../modelo/eliminarEvento.php");
        ?>

    </div>   
<?php
require_once("../plantilla/pie.php");
?>