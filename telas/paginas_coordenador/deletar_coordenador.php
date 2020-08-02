<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosCoordenador.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

<?php
    $servicoCoordenador = new ServicosCoordenador();
?>

<?php
    $servicoCoordenador->deletarCoordenador($_GET["id"]);
    header("location:index_coordenador.php");
?>

<?php
} else {
    header("location:../inicio/login.php");
}
?>