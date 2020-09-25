<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosOrientador.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

<?php
    $servicoOrientador = new ServicosOrientador();
?>

<?php
    $servicoOrientador->deletarOrientador($_GET["id"]);
    header("location:index_orientador.php");
?>

<?php
} else {
    header("location:../inicio/login.php");
}
?>