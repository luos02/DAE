<?php
require_once("../plantilla/encabezado.php");
?>
      
    <div class="settings">
        <div id="menu">
            <h2 id="ti">Usuarios</h2>
            <a  id="pr1" class="pr" href="agregarUsuario.php">
                Agregar
            </a>
            <a  id="pr2" class="pr"  href="settings.php">
                Ver Usuarios
            </a>
            <a  id="pr3" class="pr"  href="EditarUser.php">
                Editar Usuario
            </a>

        </div>
        <div id="users">
            
        <ul>
                <?php
                include("../../modelo/visualizarUsuarios.php");
                ?>
                


        </ul>

        </div>

    </div>
    
<?php
require_once("../plantilla/pie.php");
?>