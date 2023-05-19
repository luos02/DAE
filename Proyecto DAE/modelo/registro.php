<?php
include("../../controlador/conexion_db.php");
if(isset($_POST['btnregistrar'])){
    if(strlen($_POST['txtusuario'])<1 || strlen($_POST['txtpassword'])<1) {
        echo("Usuario o contraseña no válidos");
    }else{
        $usuario=trim($_POST['txtusuario']);
        $pass=trim($_POST['txtpassword']);
        $rol=trim($_POST['txtrol']);
        $arreglochks = array('chkeventos','chkayc','chkcamid');
        for($i=0;$i<3;$i++){
            if(!isset($_POST[$arreglochks[$i]])){
                $arreglochks[$i]=0;
            }else{
                $arreglochks[$i]=1;
            }
        }
        $queryInsertar="call insertarUsuario('$pass','$usuario',$rol,$arreglochks[0],$arreglochks[1],$arreglochks[2]);";
        try{
            $resultado=mysqli_query($conexion,$queryInsertar);
            ?>
            <h3>Usuario registrado</h3>
            <?php
        }catch(Exception $e){
            ?>
            <h3>No se pudo registrar el usuario</h3><p>Probablemente no exista ese ID DAE o el usuario ya esté registrado</p>
            <?php
        }
    }
}

mysqli_close($conexion);

?>