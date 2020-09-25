<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosGpe.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

<?php
    $servicoGpe = new ServicosGpe();
?>

<?php
    $servicoGpe->deletarGpe($_GET["id"]);
    header("location:index_gpe.php");
?>

<?php
} else {
    header("location:../inicio/login.php");
}
?>