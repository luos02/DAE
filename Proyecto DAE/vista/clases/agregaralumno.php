<?php
require_once("../plantilla/encabezado.php");
?>
      
    <div class="settings">
        <div id="menu">
            <h2 id="ti">Usuarios</h2>
            <a  id="pr1" class="pr" href="agregarclases.php">
                Agregar Clases
            </a>
            
            <a  id="pr2" class="pr"  href="listaclases.php">
                Ver Clases
            </a>

            <a  id="pr3" class="pr"  href="asistencia.php">
                Tomar asistencia para clase
            </a>

            <a  id="pr4" class="pr"  href="#">
                Registrar alumno para clase
            </a>
        


        </div>
        <div id="usersAgregarAlumno">
            
                <form class="agregarA"  action="">
                    <h1 class="title">Agregar Alumno</h1>
                    <label id="d" for="">
                        
                        <input type="text" id="user" placeholder="Alumno" value="">
                    </label>
                    <br>
                    <label for="">
                        <input type="text" id="user" placeholder="Carrera" value="">
                    </label>
                       <br>
                    <label for="">
                        <input type="text" id="user" placeholder="Semestre" value="">
                    </label>
                    <br><br>
                    <button id="bn" type="button">Agregar</button>
                </form>
    
        

        </div>

    </div>
    

        
     
<?php
require_once("../plantilla/pie.php");
?>