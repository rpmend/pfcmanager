<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosProjeto.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

<?php
    $servicoProjeto = new ServicosProjeto();
?>

<?php
    $projeto_id = $_GET["id"];
    $servicoProjeto->deletarProjeto($projeto_id);
    header("location:index_projeto.php");
?>

<?php
} else {
    header("location:../inicio/login.php");
}
?>