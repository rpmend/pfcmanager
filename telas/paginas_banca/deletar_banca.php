<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosBanca.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

<?php
    $servicoBanca = new ServicosBanca();
?>

<?php
    $banca_id = $_GET["id"];
    $servicoBanca->deletarBanca($banca_id);
    header("location:index_banca.php");
?>

<?php
} else {
    header("location:../inicio/login.php");
}
?>