<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosCurso.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

<?php
    $servicoCurso = new ServicosCurso();
?>

<?php
    $curso_id = $_GET["id"];
    $servicoCurso->deletarCurso($curso_id);
    header("location:index_curso.php");
?>

<?php
} else {
    header("location:../inicio/login.php");
}
?>