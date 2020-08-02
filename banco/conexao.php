<!-- Conexão com o banco -->

<?php
function conectar()
{
    $servidor = "localhost";
    $usuario = "root";
    $senha = "root";
    $banco = "pfc_banco_novo";

    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

    if (mysqli_errno($conexao)) {
        die("Erro ao conectar ao banco de dados" . mysqli_errno($conexao));
    }
    return $conexao;
}