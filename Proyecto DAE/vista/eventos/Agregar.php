<?php
?>

<?php
include("../../modelo/armarCB.php");
require_once("../plantilla/encabezadoEventos.php");
?>
    
    <div id="agregar">
        <form action="" method="POST" enctype="multipart/form-data">
            
            <h2>Registrar evento</h2>
            <br>
            <label id="d" for="">Clave del evento
            <input type="number" id="nE" name="txtIDEvento">
            </label>
            <br>

            <label id="d" for="">Nombre del evento    
            <input type="text" id="nE" name="txtNoEvento">
            </label>
            <br>
            

            <label  for="">Fecha de inicio del evento
                <input type="date" class="fecha" name="txtFechaInicioEvento">
            </label>
            <br>

            <label  for="">Fecha de termino del evento
                <input type="date" class="fecha" name="txtFechaFinEvento">
            </label>
            <br>

            <label  for="">Hora de inicio del evento
                <input type="time" class="fecha" name="txtHoraInicioEvento">
            </label>
            <br>

            <label  for="">Hora de termino del evento
                <input type="time" class="fecha" name="txtHoraFinEvento">
            </label>
            <br>

            <label  for="">Plantel de ubicacion del evento
                <select name="plantelEvento" id="">
                    <?php
                        crearCB("plantel","nombre_plantel");
                    ?>
                </select>
            </label>
            <br><br>

            <label  for="">Disponibilidad del evento
                <select name="disponEvento" id="">
                    <?php
                        crearCB("disponibilidad","estado");
                    ?>
                </select>
            </label>
            <br><br>

            <label  for="">Coordinacion a cargo del evento
                <select name="coordEvento" id="">
                    <?php
                        crearCB("coordinacion","coordinacion");
                    ?>
                </select>
            </label>
            <br><br>

            <label  for="">Tipo de evento
                <select name="tipoEvento" id="">
                    <?php
                        crearCB("tipo_evento","tipo");
                    ?>
                </select>
            </label>
            <br><br>

            <label  id="arch" for="">Tomar información de asistencia de:
                <input type="file" id="archivo" name="archivoExcel">
            </label>
    
            <button id="start" name="btnCrearEvento">Ingresar</button>
        

        </form>
        
        <?php
            include("../../modelo/registroEventos.php");
        ?>

    </div>   
<?php
require_once("../plantilla/pie.php");
?>