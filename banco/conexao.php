<?php
function conectar()
{
    $servidor = "sql206.epizy.com";
    $usuario = "epiz_26295775";
    $senha = "xSFcSEOy5Aik7J";
    $banco = "epiz_26295775_pfcmanager";

    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

    if (mysqli_errno($conexao)) {
        die("Erro ao conectar ao banco de dados" . mysqli_errno($conexao));
    }
    return $conexao;
}