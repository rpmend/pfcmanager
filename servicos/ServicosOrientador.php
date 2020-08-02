<!-- Funções exucutadas pelo sistema relacionadas ao Orientador -->

<?php

interface iServicosOrientador
{
    public function listarOrientadores();
    public function listarOrientadorPorId($orientador_id);
    public function listarOrientadoresPorNome($orientador_nome);

    public function pesquisarOrientadores($filtro);

    public function cadastrarOrientador($orientador_nome);

    public function alterarOrientador($orientador_nome, $orientador_id);
    
    public function deletarOrientador($orientador_id);
}

class ServicosOrientador implements iServicosOrientador
{
    function listarOrientadores()
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM orientadores;";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return $resultado;
    }

    function listarOrientadorPorId($orientador_id)
    {
        require_once("../../banco/conexao.php");
        intval($orientador_id);

        $conexao = conectar();
        $consulta = "SELECT * FROM orientadores WHERE orientador_id = {$orientador_id}";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return $resultado;
    }

    function listarOrientadoresPorNome($orientador_nome)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM orientadores  WHERE orientador_nome LIKE '%{$orientador_nome}%'";
        $resultado = mysqli_query($conexao, $consulta);

        if(!$resultado) {
            die("Falha na consulta do banco");
        }
        return $resultado;
    }

    function pesquisarOrientadores($filtro)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM orientadores  WHERE orientador_nome LIKE '%{$filtro}%'";
        $resultado = mysqli_query($conexao, $consulta);

        if (!$resultado) {
            die("Falha na consulta do banco");
        }
        return $resultado;
    }

    function cadastrarOrientador($orientador_nome)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $query = "INSERT INTO orientadores (orientador_nome) VALUES ('$orientador_nome')";

        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            die("Erro no banco " . mysqli_errno($conexao));
        } else {
            return true;            
        }
    }

    function alterarOrientador($orientador_nome, $orientador_id)
    {
        require_once("../../banco/conexao.php"); 
        intval($orientador_id);
        $conexao = conectar();
        
         $query = "UPDATE orientadores SET orientador_nome = '{$orientador_nome}' WHERE orientador_id = {$orientador_id}";
        
        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return true; 
    }

    function deletarOrientador($orientador_id)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "DELETE FROM orientadores WHERE orientador_id = $orientador_id";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        } 
        return true;
    }

    
}