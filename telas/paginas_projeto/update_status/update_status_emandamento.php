<?php require_once("../../../banco/conexao.php"); ?>

<?php
//Alteração de status
$id_proj = $_GET["id"]; 
$update_projetos_status = "UPDATE projetos ";
$update_projetos_status .= "SET projeto_status = 2, ";
$update_projetos_status .= "projeto_motivocancelamento = null ";
$update_projetos_status .= "WHERE projeto_id = {$id_proj} ";
echo $update_projetos_status;

$conexao = conectar();
$executar_update = mysqli_query($conexao, $update_projetos_status);
if(!$executar_update){
    die("Erro no update");
}else{
    header("location:../gestao.php");
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