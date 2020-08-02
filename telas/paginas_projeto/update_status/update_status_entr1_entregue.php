<?php require_once("../../../banco/conexao.php"); ?>

<?php
//Pegar status do entegavel no banco e armazenar em uma variavel
$id_proj = $_GET["id"];
$select_entregavel1_status = "SELECT projeto_status1 ";
$select_entregavel1_status .= "FROM projetos ";
$select_entregavel1_status .= "WHERE projeto_id = {$id_proj} ";

$conexao = conectar();
$entregavel1_status = mysqli_query($conexao, $select_entregavel1_status);
if (!$entregavel1_status) {
    die("Erro na consulta ao banco " . mysqli_errno($conexao));
}

$linha = mysqli_fetch_assoc($entregavel1_status);
echo ($linha["projeto_status1"]);

//Alteração de status
if ($linha["projeto_status1"] == 1) {
    $update_entregavel1_status = "UPDATE projetos ";
    $update_entregavel1_status .= "SET projeto_status1 = 0 ";
    $update_entregavel1_status .= "WHERE projeto_id = {$id_proj} ";
    echo $update_entregavel1_status;

    $conexao = conectar();
    $executar_update = mysqli_query($conexao, $update_entregavel1_status);
    if (!$executar_update) {
        die("Erro no update");
    } else {
        header("location:../gestao.php");
    }
} else {
    $update_entregavel1_status = "UPDATE projetos ";
    $update_entregavel1_status .= "SET projeto_status1 = 1 ";
    $update_entregavel1_status .= "WHERE projeto_id = {$id_proj} ";
    echo $update_entregavel1_status;

    $conexao = conectar();
    $executar_update = mysqli_query($conexao, $update_entregavel1_status);
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