<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosCliente.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

<?php
    $servicoCliente = new ServicosCliente();
?>

<?php
    $cliente_id = $_GET["id"];
    $servicoCliente->deletarCliente($cliente_id);
    header("location:index_cliente.php");
?>

<?php
} else {
    header("location:../inicio/login.php");
}
?>