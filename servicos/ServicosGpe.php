<!-- Funções exucutadas pelo sistema relacionadas ao GPE -->

<?php

interface iServicosGpe
{
    public function listarGpes();
    public function listarGpePorId($gpe_id);
    public function listarGpesPorNome($gpe_nome);

    public function pesquisarGpes($filtro);

    public function cadastrarGpe($gpe_nome);

    public function alterarGpe($gpe_nome, $gpe_id);

    public function deletarGpe($gpe_id);
}

class ServicosGpe implements iServicosGpe
{
    function listarGpes()
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM gpes;";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return $resultado;
    }

    function listarGpePorId($gpe_id)
    {
        require_once("../../banco/conexao.php");
        intval($gpe_id);

        $conexao = conectar();
        $consulta = "SELECT * FROM gpes WHERE gpe_id = {$gpe_id}";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return $resultado;
    }

    function listarGpesPorNome($gpe_nome)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM gpes  WHERE gpe_nome LIKE '%{$gpe_nome}%'";
        $resultado = mysqli_query($conexao, $consulta);

        if (!$resultado) {
            die("Falha na consulta do banco");
        }
        return $resultado;
    }

    function pesquisarGpes($filtro)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM gpes  WHERE gpe_nome LIKE '%{$filtro}%'";
        $resultado = mysqli_query($conexao, $consulta);

        if (!$resultado) {
            die("Falha na consulta do banco");
        }
        return $resultado;
    }

    function cadastrarGpe($gpe_nome)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $query = "INSERT INTO gpes (gpe_nome) VALUES ('$gpe_nome')";

        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            die("Erro no banco " . mysqli_errno($conexao));
        } else {
            return true;
        }
    }

    function alterarGpe($gpe_nome, $gpe_id)
    {
        require_once("../../banco/conexao.php");
        intval($gpe_id);
        $conexao = conectar();

        $query = "UPDATE gpes SET gpe_nome = '{$gpe_nome}' WHERE gpe_id = {$gpe_id}";

        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return true;
    }

    function deletarGpe($gpe_id)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "DELETE FROM gpes WHERE gpe_id = {$gpe_id}";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return true;
    }
}
