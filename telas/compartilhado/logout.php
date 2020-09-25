<!-- Página de logout -->

<?php session_start(); ?>
<?php require_once("../../servicos/ServicosUsuario.php"); ?>

<?php
$servicosUsuario = new ServicosUsuario();
?> 

<?php
$servicosUsuario->deslogar();
?>