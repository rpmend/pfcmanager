<?php require_once("../../../banco/conexao.php"); ?>

<?php
//Alteração de status
$id_proj = $_GET["id"]; 
$update_projetos_status = "UPDATE projetos ";
$update_projetos_status .= "SET projeto_status = 0, ";
$update_projetos_status .= "projeto_equipe_id = null, ";
$update_projetos_status .= "projeto_entregavel1 = null, ";
$update_projetos_status .= "projeto_entregavel2 = null, ";
$update_projetos_status .= "projeto_entregavel3 = null, ";
$update_projetos_status .= "projeto_status1 = null, ";
$update_projetos_status .= "projeto_status2 = null, ";
$update_projetos_status .= "projeto_status3 = null ";
$update_projetos_status .= "WHERE projeto_id = {$id_proj} ";
echo $update_projetos_status;

$executar_update = mysqli_query($conexao, $update_projetos_status);
if(!$executar_update){
    die("Erro no update");
}else{
    header("location:../reserva.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<?php include_once("../compartilhado/head.php"); ?>

<body>
    <?php include_once("../compartilhado/header.php"); ?>
    <main>
        <div class="container">
            <div style="min-height: 780px">

            </div>
        </div>
    </main>
    <?php include_once("../compartilhado/footer.php"); ?>
    <script src="../compartilhado/script.js"></script>
</body>

</html>