<?php
include("../../modelo/armarCB.php");
include("../../controlador/conexion_db.php");

if($conexion){
    if(isset($_POST["btnAgregarClase"])){
            $descClase=$_POST["txtDescClaseAgregar"];
            $impClase=$_POST["slctImpartidorClaseAgregar"];
            $plantelClase=$_POST["slctPlantelClaseAgregar"];
            $periodoClase=$_POST["slctPeriodoClaseAgregar"];
            $arregloTablasAgregar=array('persona','plantel');
            $arregloColumnasAgregar=array('id_persona','id_plantel');
            $arregloCBs=array($impClase,$plantelClase);
            $arregloResultadosCBs=array('nombre_persona','nombre_plantel');
            $arregloRecibidos=array();
            for($i=0;$i<2;$i++){
                $resultadoBusqueda[$i]=mysqli_query($conexion,"select ".$arregloColumnasAgregar[$i]." from ".$arregloTablasAgregar[$i]." where ".$arregloResultadosCBs[$i]."= '".$arregloCBs[$i]."';");
                $arregloIDGuardar=mysqli_fetch_array($resultadoBusqueda[$i]);
                $arregloRecibidos[$i]=$arregloIDGuardar[0];
            }
            buscarRolClases($descClase,$arregloRecibidos,$periodoClase);
        }
        if(isset($_POST["btnBuscarRolClasesAgregar"])){
            crearClase($conexion);
        }
    }else{
    echo"<h3>Hay un error en la conexión con la base de datos</h3>";
}


function buscarRolClases($descClase,$arregloRecibidos,$periodoClase){
    echo"
    <form action='#' method='post' id='frmBuscarRolClase'>
    <h3>Inicia sesión con un usuario con rol 0 para crear una clase</h3>
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
    <input type='hidden' id='' value='".$descClase."' name='hdDescClaseAgregar'>
    <input type='hidden' id='user' value='".$arregloRecibidos[0]."' name='hdImpartidorClaseAgregar'>
    <input type='hidden' id='' value='".$arregloRecibidos[1]."' name='hdPlantelClaseAgregar'>
    <input type='hidden' id='' value='".$periodoClase."' name='hdPeriodoClaseAgregar'>
    <button name='btnBuscarRolClasesAgregar'>Iniciar sesión</button>
    </form>";
}


function crearClase($conexion){
    include("../../controlador/conexion_db.php");
    if(strlen($_POST['txtUsuarioRolClases'])>0 && strlen($_POST['txtPasswordRolClases'])>0){
        $usuarioRol=$_POST["txtUsuarioRolClases"];
        $passwordRol=$_POST["txtPasswordRolClases"];
        $consultaRol=mysqli_query($conexion,"select count(*) as filasRol from logins where id_persona_log='".$usuarioRol."' and passwords='".$passwordRol."' and rol=0;");
        if($consultaRol){
            $noFilasRol=mysqli_fetch_assoc($consultaRol);
            if($noFilasRol['filasRol']==1){
                try{
                    $descClase=$_POST["hdDescClaseAgregar"];
                    $impartidorClase=$_POST["hdImpartidorClaseAgregar"];
                    $plantelClase=$_POST["hdPlantelClaseAgregar"];
                    $periodoClase=$_POST["hdPeriodoClaseAgregar"];
                    $consultaAgregar="insert into clase (descripcion_clase,id_impartidor,id_plantel_clase,id_periodo_clase) values ('$descClase',$impartidorClase,$plantelClase,'$periodoClase');";
                    mysqli_query($conexion,$consultaAgregar);
                    ?>
                    <script>
                        alert("Se creó exitosamente la clase");
                    </script>
                    <?php
                }catch(Exception $e){
                    echo $e;
                    /*?>
                    <script>
                        alert("No se pudo crear la clase, probablemente ya exista una clase con esa descripción");
                    </script>
                    <?php*/
                }
            }else{
                echo"<h2>Error, probablemente no exista el usuario ingresado o no cuente con el rol necesario para crear clases</h2>";
            }
        }
    }else{
        echo"<h2>Usuario o contraseña vacíos, intente de nuevo</h2>";
    }
    mysqli_close($conexion);
}
?>


<?php
require_once("../plantilla/encabezado.php");
?>
      
    <div class="settings">
        <div id="menu">
            <h2 id="ti">Clases</h2>
            <a  id="pr1" class="pr" href="#">
                Agregar Clases
            </a>
            
            <a  id="pr2" class="pr"  href="listaclases.php">
                Ver Clases
            </a>

            <a  id="pr3" class="pr"  href="asistencia.php">
                Tomar asistencia para clase
            </a>

            <a  id="pr4" class="pr"  href="agregaralumno.php">
                Registrar alumno para clase
            </a>
    </div>
        <div id="users">
            
                <form class="agregarCl"  action="" method="POST">
                    <h1 class="title">Crear clase</h1>
                    <br>
                    <label id="d" for="">
                        <input type="text" id="user" placeholder="Descripción de la clase" value="" name="txtDescClaseAgregar">
                    </label>
                    <br>
                    <label for="">Impartidor de la clase
                    <select name="slctImpartidorClaseAgregar" id="">
                        <?php
                            $consultaCB="select nombre_persona from persona inner join logins on id_persona=id_persona_log where logins.rol=1;";
                            $resultadoConsulta=mysqli_query($conexion,$consultaCB);
                            $numFilasConsulta = mysqli_num_rows($resultadoConsulta);
                            for($i=0;$i<$numFilasConsulta;$i++){
                                $filasConsulta=mysqli_fetch_array($resultadoConsulta);
                                echo"<option value='$filasConsulta[0]'>".$filasConsulta[0]."</option>";
                            }
                            mysqli_close($conexion);
                        ?>
                    </select>
                    </label>
                    <br>
                    <label for="">Plantel donde se impartirá la clase
                    <select name="slctPlantelClaseAgregar" id="">
                        <?php
                        crearCB("plantel","nombre_plantel");
                        ?>
                    </select>
                    </label>
                    <br>
                    <label for="">Periodo escolar de la clase
                    <select name="slctPeriodoClaseAgregar" id="">
                        <?php
                        crearCB("periodo","id_periodo");
                        ?>
                    </select>
                    </label>
                    <br><br>
                    <button id="bn" name="btnAgregarClase">Agregar</button>
                </form>
        </div>
    </div>
<?php
require_once("../plantilla/pie.php");
?>