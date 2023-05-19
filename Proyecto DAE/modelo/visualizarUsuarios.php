<?php
include("../../controlador/conexion_db.php");

function buscarRol($idPersonaEliminar){
    echo"<form action='#' method='post'>
    <h3>Inicia sesión con un usuario con rol 0 para eliminar a otro usuario</h3>
    <label id='d' for=''>
        <img id ='icon' src='../../assets/icon/circle-user-solid.svg' alt=''>
        <input type='number' class='user' placeholder='ID DAE' name='txtUsuarioRol' value=''>
    </label>
    <br>
    <br>
    <label for=''>
        <img id ='icon' src='../../assets/icon/key-solid.svg' alt=''>
        <input type='password' class='pass' placeholder='Contraseña' name='txtPasswordRol' value=''>
    </label>
    <br><br>
    <button name='btnBuscarRol".$idPersonaEliminar."'>Iniciar sesión</button>
    </form>";
}




function eliminarUsuario($consultaEliminar,$conexion){
    if(strlen($_POST['txtUsuarioRol'])>0 && strlen($_POST['txtPasswordRol'])>0) {
        $usuarioRol=$_POST["txtUsuarioRol"];
        $passwordRol=$_POST["txtPasswordRol"];
        $consultaRol=mysqli_query($conexion,"select count(*) as filasRol from logins where id_persona_log='".$usuarioRol."' and passwords='".$passwordRol."' and rol=0;");
        if($consultaRol){
            $noFilasRol=mysqli_fetch_assoc($consultaRol);
            if($noFilasRol['filasRol']==1){
                try{
                    $consultaEliminar=mysqli_query($conexion,$consultaEliminar);
                    if($consultaEliminar){
                        echo"<h3>Se eliminó el usuario</h3>";    
                    }else{
                        echo"<h3>Ocurrió un error, no se pudo borrar el usuario</h3>";    
                    }
                }catch(Exception $e){
                    echo"<h3>Ocurrió un error, no se pudo borrar el usuario</h3>";    
                }
            }else{
                echo"<h2>Ocurrió un error, probablemente no exista el usuario ingresado o no cuente con el rol necesario para borrar a otros usuarios</h2>";
            }
        }
    }else{
        echo"<h2>Usuario o contraseña vacíos, intente de nuevo</h2>".$consultaEliminar." asfasdfasdf";
    }
    mysqli_close($conexion);
}  


if($conexion){
    try{
        $consultaFilas=mysqli_query($conexion,"select count(*) as numUsuarios from logins;");
        $arregloFilas=mysqli_fetch_array($consultaFilas);
        $numFilas=$arregloFilas[0];
        if($numFilas<=0){
            echo"<h3>No hay ningún usuario registrado todavía</h3>";    
        }
        $consultaImpresion=mysqli_query($conexion,"select id_persona_log,rol,regisEventos,ayc,camid from logins;");
        for($i=0;$i<$numFilas;$i++){
            $usuarioActual=mysqli_fetch_array($consultaImpresion);
            $arregloChks=array(3);
            for($j=2;$j<5;$j++){
                if($usuarioActual[$j]==1){
                    $arregloChks[$j-2]="Sí";
                }else{
                    $arregloChks[$j-2]="No";
                }
            }
            echo "<li class='liUsuario'><form action='#' method='POST'>Usuario: ".$usuarioActual[0]."<br> Rol: ".$usuarioActual[1]."<br> Puede registrar eventos: ".$arregloChks[0]."<br> Es parte de arte y cultura: ".$arregloChks[1]."<br> Es parte de CAMID: ".$arregloChks[2]." <button class='eliminar' name='btnEliminarUsuario".$usuarioActual[0]."'>Eliminar</button></form></li>";
            $idPersonaEliminar=$usuarioActual[0];


            //eliminarUbuscsuario($usuarioActual[0],$conexion);
            if(isset($_POST["btnEliminarUsuario".$idPersonaEliminar])){
                buscarRol($idPersonaEliminar);
            }
            if(isset($_POST["btnBuscarRol".$idPersonaEliminar])){
                $consultaEliminar="delete from logins where id_persona_log=".$idPersonaEliminar.";";
                eliminarUsuario($consultaEliminar,$conexion);
            }
        }
    }catch(Exception $e){
        echo"<h3>Ocurrió un error, no se pueden desplegar los usuarios</h3>";
    }
}
?>