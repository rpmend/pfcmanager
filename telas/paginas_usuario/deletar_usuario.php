<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosUsuario.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

<?php
    $servicoUsuario = new ServicosUsuario();
?>

<?php
    $usuario_id = $_GET["id"];
    $servicoUsuario->deletarUsuario($usuario_id);
    header("location:index_usuario.php");
?>

<?php
} else {
    header("location:../inicio/login.php");
}
?>