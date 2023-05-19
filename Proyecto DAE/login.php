<?php
function validarLogin(){
    include("controlador/conexion_db.php");

    if(isset($_POST["txtUsuario"]) && isset($_POST["txtPassword"])){
        $usuarioIngresadoLogin=$_POST["txtUsuario"];
        $passwordIngresadoLogin=$_POST["txtPassword"];
        $consultaLogin=mysqli_query($conexion,"select count(*) as filasLogin from logins where id_persona_log='".$usuarioIngresadoLogin."' and passwords='".$passwordIngresadoLogin."';");
        if($consultaLogin){
            $noFilasLogin=mysqli_fetch_assoc($consultaLogin);
            if($noFilasLogin['filasLogin']==1){
                header("Location: vista/principal/Select.php");
            }else{
                echo"<h2>Usuario o contraseña incorrectos, intente de nuevo</h2>";
            }
        }
    }
    
    mysqli_close($conexion);
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>

    <header> 
        <img id="logo" src="icon/logoBlanco.svg" alt="">
    </header>
           
    <div id="principal">
        <form action="" method="POST">
            <h1 class="title">Inicio de sesión</h1>
            <label id="d" for="">
                <img id ="icon" src="icon/circle-user-solid.svg" alt="">
                <input type="number" id="user" placeholder="ID DAE" value="" name="txtUsuario">
            </label>
            <br>
            <label for="">
                <img id ="icon" src="icon/key-solid.svg" alt="">
                <input type="password" id="pass" placeholder="Contraseña" value="" name="txtPassword">
            </label>
            <button id="start">Ingresar</button>
            <?php
                validarLogin();
            ?>
        </form>
    </div>   
    <footer>
        @Universidad Autonoma de Guadalajara
    </footer>


</body>
</html>