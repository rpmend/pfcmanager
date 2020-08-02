<?php require_once("../../../banco/conexao.php"); ?>

<?php
//Pegar status do entegavel no banco e armazenar em uma variavel
$id_proj = $_GET["id"];
$select_entregavel3_status = "SELECT projeto_status3 ";
$select_entregavel3_status .= "FROM projetos ";
$select_entregavel3_status .= "WHERE projeto_id = {$id_proj} ";

$conexao = conectar();
$entregavel3_status = mysqli_query($conexao, $select_entregavel3_status);
if (!$entregavel3_status) {
    die("Erro na consulta ao banco " . mysqli_errno($conexao));
}

$linha = mysqli_fetch_assoc($entregavel3_status);
echo ($linha["projeto_status3"]);

//Alteração de status
if ($linha["projeto_status3"] == 1) {
    $update_entregavel3_status = "UPDATE projetos ";
    $update_entregavel3_status .= "SET projeto_status3 = 0 ";
    $update_entregavel3_status .= "WHERE projeto_id = {$id_proj} ";
    echo $update_entregavel3_status;

    $conexao = conectar();
    $executar_update = mysqli_query($conexao, $update_entregavel3_status);
    if (!$executar_update) {
        die("Erro no update");
    } else {
        header("location:../gestao.php");
    }
} else {
    $update_entregavel3_status = "UPDATE projetos ";
    $update_entregavel3_status .= "SET projeto_status3 = 1 ";
    $update_entregavel3_status .= "WHERE projeto_id = {$id_proj} ";
    echo $update_entregavel3_status;

    $conexao = conectar();
    $executar_update = mysqli_query($conexao, $update_entregavel3_status);
    if (!$executar_update) {
        die("Erro no update");
    } else {
        header("location:../gestao.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<?php include_once("../compartilhado/head.php"); ?>

<body>
    <?php include_once("../header.php"); ?>
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