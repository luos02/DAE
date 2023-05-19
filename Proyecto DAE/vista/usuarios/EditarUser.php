<?php

function validarDatos(){
    include("../../controlador/conexion_db.php");
    if(isset($_POST["btnValidarDatos"])){
        $usuarioIngresado=$_POST["txtUsuario"];
        $passwordIngresado=$_POST["txtPassword"];
        $consultaValidar=mysqli_query($conexion,"select count(*) as filasLogin from logins where id_persona_log='".$usuarioIngresado."' and passwords='".$passwordIngresado."';");
        if($consultaValidar){
            $noFilasValidar=mysqli_fetch_assoc($consultaValidar);
            if($noFilasValidar['filasLogin']==1){
                $consultaUsuario=mysqli_query($conexion,"select * from logins where id_persona_log='".$usuarioIngresado."';");
                $filaUsuario=mysqli_fetch_array($consultaUsuario);
                mysqli_close($conexion);
                echo"                </form>   
                <form action='#' id='frmEditar' method='post'>
                    <h1>Editar</h1>
                    <h2>Editando al usuario: ".$usuarioIngresado."</h2>
                    <label id='d' for=''>
                    <img id ='icon' src='../../assets/icon/circle-user-solid.svg' alt=''>
                    <input type='number' class='user' value='".$usuarioIngresado."' name='txtUsuarioActualizar' readonly>
                    </label>
                    <label for=''><h4>Contraseña</h4>
                        <img id ='icon' src='../../assets/icon/key-solid.svg' alt=''>
                        <input type='text' id='pass' value='".$filaUsuario[1]."' name='txtPasswordActualizar'>
                    </label>
                    <label for=''><h4>Rol</h4>
                        <img id ='icon' src='../../assets/icon/roleIcon.png' alt=''>
                        <input type='number' name='txtRolActualizar' value='".$filaUsuario[3]."'>
                    </label>
                    <br>
                    <br>
                    <label for=''><h4>Puede registrar eventos</h4>
                        <input type='checkbox' name='chkeventosActualizar' value='1'>
                    </label>
                    <br>
                    <br>
                    <label for=''><h4>Es parte de A y C</h4>
                        <input type='checkbox' name='chkaycActualizar' value='1'>
                    </label>
                    <br>
                    <br>
                    <label for=''><h4>Es parte de CAMID</h4>
                        <input type='checkbox' name='chkcamidActualizar' value='1'>
                    </label>
                    <br>
                    <br>
                    <button id='bn' name='btnGuardarCambios'>Guardar cambios</button>";
                echo"</form>";
            }else{
                echo"<h2>Usuario o contraseña incorrectos, intente de nuevo</h2>";
            }
        }
    }
}

if(isset($_POST['btnGuardarCambios'])){
    actualizarDatos($_POST["txtUsuarioActualizar"]);
    $usuarioIngresado='';
}

function actualizarDatos($usuarioIngresado){
    include("../../controlador/conexion_db.php");
    if(strlen($_POST['txtPasswordActualizar'])<1 || ($_POST['txtRolActualizar']<0 && $_POST['txtRolActualizar']>10)){
        ?>
        <script>
            alert("Nueva contraseña o rol vacíos, intente de nuevo");
        </script>
        <?php
    }else{
        $pass=trim($_POST['txtPasswordActualizar']);
        $rol=trim($_POST['txtRolActualizar']);
        $arreglochks = array('chkeventosActualizar','chkaycActualizar','chkcamidActualizar');
        for($i=0;$i<3;$i++){
            if(!isset($_POST[$arreglochks[$i]])){
                $arreglochks[$i]=0;
            } else {
                $arreglochks[$i]=1;
            }
        }
        $queryActualizar="update logins set passwords='$pass',rol='$rol',regisEventos='$arreglochks[0]',ayc='$arreglochks[1]',camid='$arreglochks[2]' where id_persona_log='$usuarioIngresado';";
        $exitoConsulta=false;
        try{
            mysqli_query($conexion,$queryActualizar);
            $exitoConsulta=true;
        }catch(Exception $e){
        }
    mysqli_close($conexion);
    if($exitoConsulta){
        ?>
        <script>
            alert("Usuario actualizado correctamente");
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("No se pudo actualizar el usuario, intente de nuevo");
        </script>
        <?php
    }
    }
}
?>


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
                <form class="agregar"  action="" method="post">
                    <h1 class="title">Buscar usuario para editar</h1>
                    <h2>Introduce un usuario para editarlo</h2>
                    <label id="d" for="">
                        <img id ="icon" src="../../assets/icon/circle-user-solid.svg" alt="">
                        <input type="text" id="user" placeholder="Usuario" value="" name="txtUsuario">
                    </label>
                    <br>
                    <label for="">
                        <img id ="icon" src="../../assets/icon/key-solid.svg" alt="">
                        <input type="password" id="pass" placeholder="Contraseña" value="" name="txtPassword">
                    </label>
                    <button id="bn" name="btnValidarDatos">Buscar usuario</button>
                    <?php
                    validarDatos();
                    ?>             
        </div>
    </div>

<?php
require_once("../plantilla/pie.php");
?>