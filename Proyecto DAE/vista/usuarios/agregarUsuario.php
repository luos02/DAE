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
        <div class="divFormulario">
                <form action="" method="post" name="frmRegistro" id="frmRegistro">
                <h1>Registro de usuarios</h1>
                <label id="d" for="">
                    <img id ="icon" src="../../assets/icon/circle-user-solid.svg" alt="">
                    <input type="number" class="user" placeholder="ID DAE" name="txtusuario" value="">
                </label>
                <br>
                <br>
                <label for="">
                    <img id ="icon" src="../../assets/icon/key-solid.svg" alt="">
                    <input type="password" class="pass" placeholder="Contraseña" name="txtpassword" value="">
                </label>
                <br>
                <br>
                <label for="">
                    <img id ="icon" src="../../assets/icon/roleIcon.png" alt="">
                    <input type="number" placeholder="Rol DAE" name="txtrol" value="">
                </label>
                <br>
                <br>
                <label for="">
                    Puede registrar eventos
                    <input type="checkbox" name="chkeventos" value="1">
                </label>
                <br>
                <br>
                <label for="">
                    Es parte de A y C
                    <input type="checkbox" name="chkayc" value="1">
                </label>
                <br>
                <br>
                <label for="">
                    Es parte de CAMID
                    <input type="checkbox" name="chkcamid" value="1">
                </label>
                <br>
                <br>
                <?php
                include("../../modelo/registro.php");
                ?>
                <button name="btnregistrar" id="btnUser">Registrar</button>
                </form>

        </div>

    </div>     
<?php
    require_once("../plantilla/pie.php");
?>