<?php
require_once("../plantilla/encabezado.php");
?>
    <div class="settings">
        <div id="menu">
            <h2 id="ti">Clases</h2>
            <a  id="pr1" class="pr" href="agregarclases.php">
                Agregar Clases
            </a>
            
            <a  id="pr2" class="pr"  href="listaclases.php">
                Ver Clases
            </a>

            <a  id="pr3" class="pr"  href="#">
                Tomar asistencia para clase
            </a>

            <a  id="pr4" class="pr"  href="agregaralumno.php">
                Registrar alumno para clase
            </a>
        
        </div>
        <div id="users">
            <ul>
                <li id="l1" class="li">Alumno 1 <div id="contbtn3">
                    Asistio<input  type="checkbox" name="" id="chList"><button class="botonesEdicion">Editar</button><button class="botonesEdicion">Eliminar</button>
                </div></li>
                


            </ul>
        </div>
    </div>
    
   
<?php
require_once("../plantilla/pie.php");
?>