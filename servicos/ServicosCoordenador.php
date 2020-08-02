<!-- Funções exucutadas pelo sistema relacionadas ao Orientador -->

<?php

interface iServicosCoordenador
{
    public function listarCoordenadores();
    public function listarCoordenadorPorId($coordenador_id);
    public function listarCoordenadoresPorNome($coordenador_nome);

    public function pesquisarCoordenadores($filtro);

    public function cadastrarCoordenador($coordenador_nome);

    public function alterarCoordenador($coordenador_nome, $coordenador_id);
    
    public function deletarCoordenador($coordenador_id);
}

class ServicosCoordenador implements iServicosCoordenador
{
    function listarCoordenadores()
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM coordenadores;";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return $resultado;
    }

    function listarCoordenadorPorId($coordenador_id)
    {
        require_once("../../banco/conexao.php");
        intval($coordenador_id);

        $conexao = conectar();
        $consulta = "SELECT * FROM coordenadores WHERE coordenador_id = {$coordenador_id}";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return $resultado;
    }

    function listarCoordenadoresPorNome($coordenador_nome)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM coordenadores  WHERE coordenador_nome LIKE '%{$coordenador_nome}%'";
        $resultado = mysqli_query($conexao, $consulta);

        if(!$resultado) {
            die("Falha na consulta do banco");
        }
        return $resultado;
    }

    function pesquisarCoordenadores($filtro)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM coordenadores  WHERE coordenador_nome LIKE '%{$filtro}%'";
        $resultado = mysqli_query($conexao, $consulta);

        if (!$resultado) {
            die("Falha na consulta do banco");
        }
        return $resultado;
    }

    function cadastrarCoordenador($coordenador_nome)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $query = "INSERT INTO coordenadores (coordenador_nome) VALUES ('$coordenador_nome')";

        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            die("Erro no banco " . mysqli_errno($conexao));
        } else {
            return true;            
        }
    }

    function alterarCoordenador($coordenador_nome, $coordenador_id)
    {
        require_once("../../banco/conexao.php"); 
        intval($coordenador_id);
        $conexao = conectar();
        
         $query = "UPDATE coordenadores SET coordenador_nome = '{$coordenador_nome}' WHERE coordenador_id = {$coordenador_id}";
        
        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return true; 
    }

    function deletarCoordenador($coordenador_id)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "DELETE FROM coordenadores WHERE coordenador_id = {$coordenador_id}";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        } 
        return true;
    }

    
}