<?php
require_once("../plantilla/encabezadoEventos.php");
?>
       
    <div id="principal">
        <div id="edent">
            <h2>Eventos</h2>
            <a  id="pr1" href="Agregar.php">
                Agregar
            </a>
        
        </div>
        <?php
            include("visualizarEventos.php");
        ?>  
          
    </div>  
<?php
require_once("../plantilla/pie.php");
?>