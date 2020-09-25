<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosArea.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

<?php
$servicoArea = new ServicosArea();
?>

<?php
    $servicoArea->deletarArea($_GET["id"]);
    header("location:index_area.php");
?>

<?php
} else {
    header("location:../inicio/login.php");
}
?>