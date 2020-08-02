<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosTurma.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

<?php
    $servicoTurma = new ServicosTurma();
?>

<?php
    $turma_id = $_GET["id"];
    $servicoTurma->deletarTurma($turma_id);
    header("location:index_turma.php");
?>

<?php
} else {
    header("location:../inicio/login.php");
}
?>