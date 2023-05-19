<?php
include("../../controlador/conexion_db.php");

if($conexion){
    if(isset($_POST["btnEliminarClase"])){
        buscarRolEliminarClases($_POST["txtIDClase"],0,null,null,null,null);
    }
    if(isset($_POST["btnEditarClase"])){
        buscarRolEliminarClases($_POST["txtIDClase"],1,$_POST["txtDescClase"],$_POST["slctPlantelClase"],$_POST["slctImpartidorClase"],$_POST["slctPeriodoClase"]);
    }
    if(isset($_POST["btnBuscarRolClasesElim"])){
        $usuarioRol=trim($_POST["txtUsuarioRolClases"]);
        $passwordRol=trim($_POST["txtPasswordRolClases"]);
        $consultaRol=mysqli_query($conexion,"select count(*) as filasRol from logins where id_persona_log='".$usuarioRol."' and passwords='".$passwordRol."' and rol=0;");
        if($consultaRol){
            $noFilasRol=mysqli_fetch_assoc($consultaRol);
            if($noFilasRol['filasRol']==1){
                eliminarClase($conexion);
                mysqli_close($conexion);
            }else{
                ?>
                <script>
                    alert("Error, probablemente no exista el usuario ingresado o no cuente con el rol necesario para eliminar clases");
                </script>
                <?php
            }
        }else{
            ?>
            <script>
                alert("Ocurrió un error, por favor intente de nuevo");
            </script>
            <?php
        }
    }
    if(isset($_POST["btnBuscarRolClasesEdit"])){
        $usuarioRol=trim($_POST["txtUsuarioRolClases"]);
        $passwordRol=trim($_POST["txtPasswordRolClases"]);
        $consultaRol=mysqli_query($conexion,"select count(*) as filasRol from logins where id_persona_log='".$usuarioRol."' and passwords='".$passwordRol."' and rol=0;");
        if($consultaRol){
            $noFilasRol=mysqli_fetch_assoc($consultaRol);
            if($noFilasRol['filasRol']==1){
                editarClase($conexion);
                mysqli_close($conexion);
            }else{
                ?>
                <script>
                    alert("Error, probablemente no exista el usuario ingresado o no cuente con el rol necesario para eliminar clases");
                </script>
                <?php
            }
        }else{
            ?>
            <script>
                alert("Ocurrió un error, por favor intente de nuevo");
            </script>
            <?php
        }
    }
}else{
    echo"<h3>Hay un error de conexión con la base de datos</h3>";
}
    
    

function buscarRolEliminarClases($idClase,$editaroeliminar,$descClase,$plantelClase,$impartidorClase,$periodoClase){
    if($editaroeliminar==0){
        echo"
        <form action='#' method='post' id='frmBuscarRolClase'>
        <h3>Inicia sesión con un usuario con rol 0 para eliminar una clase</h3>
        <label id='d' for=''>
            <img id ='icon' src='../../assets/icon/circle-user-solid.svg' alt=''>
            <input type='number' class='user' placeholder='ID DAE' name='txtUsuarioRolClases' value=''>
        </label>
        <br>
        <br>
        <label for=''>
            <img id ='icon' src='../../assets/icon/key-solid.svg' alt=''>
            <input type='password' class='pass' placeholder='Contraseña' name='txtPasswordRolClases' value=''>
        </label>
        <br><br>
        <input type='hidden' id='' value='".$idClase."' name='hdIDClaseEliminar'>
        <button name='btnBuscarRolClasesElim'>Iniciar sesión</button>
        </form>";
    }else if($editaroeliminar==1){
        echo"
        <form action='#' method='post' id='frmBuscarRolClase'>
        <h3>Inicia sesión con un usuario con rol 0 para editar una clase</h3>
        <label id='d' for=''>
            <img id ='icon' src='../../assets/icon/circle-user-solid.svg' alt=''>
            <input type='number' class='user' placeholder='ID DAE' name='txtUsuarioRolClases' value=''>
        </label>
        <br>
        <br>
        <label for=''>
            <img id ='icon' src='../../assets/icon/key-solid.svg' alt=''>
            <input type='password' class='pass' placeholder='Contraseña' name='txtPasswordRolClases' value=''>
        </label>
        <br><br>
        <input type='hidden' id='' value='".$idClase."' name='hdIDClaseEditar'>
        <input type='hidden' id='' value='".$descClase."' name='hdDescClaseEditar'>
        <input type='hidden' id='user' value='".$plantelClase."' name='hdPlantelClaseEditar'>
        <input type='hidden' id='' value='".$impartidorClase."' name='hdImpartidorClaseEditar'>
        <input type='hidden' id='' value='".$periodoClase."' name='hdPeriodoClaseEditar'>
        <button name='btnBuscarRolClasesEdit'>Iniciar sesión</button>
        </form>";
    }
}



function eliminarClase($conexion){
    if(strlen($_POST["hdIDClaseEliminar"])<0){
        ?>
        <h3>No se pudo eliminar la clase</h3>
        <?php
    }else{
        $idClase=trim($_POST['hdIDClaseEliminar']);
        $queryEliminarClase = "delete from clase where id_clase = $idClase;";
        try{
            $resultado=mysqli_query($conexion,$queryEliminarClase);
            ?>
            <script>
                alert("Se ha eliminado la clase");
            </script>
            <?php
        }catch(Exception $e){
            ?>
            <script>
                alert("No se pudo eliminar la clase");
            </script>
            <?php
        }

    }
}


function editarClase($conexion){
    if(strlen($_POST['hdIDClaseEditar'])<1 || strlen($_POST['hdDescClaseEditar'])<1) {
        ?>
            <h3>No se pudo editar el evento</h3>
            <?php
    }else{
        $idClase=trim($_POST['hdIDClaseEditar']);
        $nombreClase=trim($_POST['hdDescClaseEditar']);
        $periodoClase=$_POST['hdPeriodoClaseEditar'];
        $idImpartidor=$_POST['hdImpartidorClaseEditar'];
        $idPlantel=$_POST['hdPlantelClaseEditar'];
        $queryEditar = "update clase set descripcion_clase = '$nombreClase', id_impartidor='$idImpartidor', id_plantel_clase='$idPlantel', id_periodo_clase='$periodoClase' where id_clase=$idClase;";
        try{
            mysqli_query($conexion,$queryEditar);
            ?>
            <h3>Clase editada</h3>
            <?php
        }catch(Exception $e){
            ?>
            <h3>No se pudo editar la clase</h3>
            <?php
        }
    }
}

?>