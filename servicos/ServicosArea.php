<!-- Funções exucutadas pelo sistema relacionadas à Área -->

<?php

interface iServicosArea
{
    public function listarAreas();
    public function listarAreasPorId($area_id);
    public function listarAreasPorNome($area_nome);

    public function cadastrarArea($area_nome);

    public function alterarArea($area_nome, $area_id);
    
    public function deletarArea($area_id);
}

class ServicosArea implements iServicosArea
{
    function listarAreas()
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM areas;";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return $resultado;
    }

    function listarAreasPorId($area_id)
    {
        require_once("../../banco/conexao.php");
        intval($area_id);

        $conexao = conectar();
        $consulta = "SELECT * FROM areas WHERE area_id = {$area_id}";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return $resultado;
    }

    function listarAreasPorNome($area_nome)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM areas  WHERE area_nome LIKE '%{$area_nome}%'";
        $resultado = mysqli_query($conexao, $consulta);

        if(!$resultado) {
            die("Falha na consulta do banco");
        }
        return $resultado;
    }

    function cadastrarArea($area_nome)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $query = "INSERT INTO areas (area_nome) VALUES ('$area_nome')";

        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            die("Erro no banco " . mysqli_errno($conexao));
        } else {
            return true;            
        }
    }

    function alterarArea($area_nome, $area_id)
    {
        require_once("../../banco/conexao.php"); 
        intval($area_id);
        $conexao = conectar();
        
         $query = "UPDATE areas SET area_nome = '{$area_nome}' WHERE area_id = {$area_id}";
        
        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return true; 
    }

    function deletarArea($area_id)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "DELETE FROM areas WHERE area_id = {$area_id}";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        } 
        return true;
    }

    
}