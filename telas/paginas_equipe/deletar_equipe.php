<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosEquipe.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

<?php
    $servicoEquipe = new ServicosEquipe();
?>

<?php
    $equipe_id = $_GET["id"];
    $servicoEquipe->deletarEquipe($equipe_id);
    header("location:index_equipe.php");
?>

<?php
} else {
    header("location:../inicio/login.php");
}
?>