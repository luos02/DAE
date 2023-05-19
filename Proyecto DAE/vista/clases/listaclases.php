<?php
require_once("../plantilla/encabezado.php");
?>
    <div class="settings">
        <div id="menu">
            <h2 id="ti">Clases</h2>
            <a  id="pr1" class="pr" href="agregarclases.php">
                Agregar Clases
            </a>
            
            <a  id="pr2" class="pr"  href="#">
                Ver Clases
            </a>

            <a  id="pr3" class="pr"  href="asistencia.php">
                Tomar asistencia para clase
            </a>

            <a  id="pr4" class="pr"  href="agregaralumno.php">
                Registrar alumno para clase
            </a>
        
        </div>
        <div id="divClases">
            <ul>
        <?php
            include("visualizarClases.php");
        ?> 
        </ul> 
        </div>
    </div>
    
<?php
require_once("../plantilla/pie.php");
?>