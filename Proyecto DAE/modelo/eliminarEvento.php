<?php
include("../../controlador/conexion_db.php");

if(isset($_POST["btnEliminarEvento"])){
    if(strlen($_POST['txtIDEvento'])<1 ){
        ?>
        <h3>No se pudo eliminar el evento</h3>
        <?php
    }else{
        
        $idEvento=trim($_POST['txtIDEvento']);
        
        $queryEliminarPedido = "delete from pedido where id_evento_pedido = $idEvento;";
        $queryEliminar = "delete from acontecimiento where id_acontecimiento = $idEvento;";
        try{
            $resultado=mysqli_query($conexion,$queryEliminarPedido);
            $resultado=mysqli_query($conexion,$queryEliminar);
            header("Location: principal.php");

        }catch(Exception $e){
            ?>
            <h3>No se pudo eliminar el evento</h3>
            <?php
        }

    }
}
mysqli_close($conexion);
?>