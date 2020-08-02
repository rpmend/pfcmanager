<!-- Funções exucutadas pelo sistema relacionadas ao Cliente -->

<?php

interface iServicosCliente
{
    public function listarClientes();
    public function listarClientePorId($cliente_id);

    public function pesquisarCliente($filtro);

    public function cadastrarCliente($cliente_razaosocial, $cliente_nomefantasia, $cliente_endereco, $cliente_nomerepresentante, $cliente_telrepresentante, $cliente_emailrepresentante, $cliente_problema, $cliente_solucao, $cliente_resultado);
    
    public function alterarCliente($cliente_razaosocial, $cliente_nomefantasia, $cliente_endereco, $cliente_nomerepresentante, $cliente_telrepresentante, $cliente_emailrepresentante, $cliente_problema, $cliente_solucao, $cliente_resultado, $cliente_id);
    
    public function deletarCliente($cliente_id);
}

class ServicosCliente implements iServicosCliente
{
    
    function listarClientes()
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM clientes;";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return $resultado;
    }   
    
    function listarClientePorId($cliente_id)
    {
        require_once("../../banco/conexao.php");
        intval($cliente_id);

        $conexao = conectar();
        $consulta = "SELECT * FROM clientes WHERE cliente_id = {$cliente_id}";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return $resultado;
    }

    function pesquisarCliente($filtro)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT * FROM clientes WHERE clientes.cliente_nomerepresentante LIKE '%{$filtro}%' OR clientes.cliente_nomefantasia LIKE '%{$filtro}%' OR clientes.cliente_emailrepresentante LIKE '%{$filtro}%' ";
        $resultado = mysqli_query($conexao, $consulta);

        if (!$resultado) {
            die("Falha na consulta do banco");
        }
        return $resultado;
    }

    function cadastrarCliente($cliente_razaosocial, $cliente_nomefantasia, $cliente_endereco, $cliente_nomerepresentante, $cliente_telrepresentante, $cliente_emailrepresentante, $cliente_problema, $cliente_solucao, $cliente_resultado)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $query = "INSERT INTO clientes (cliente_razaosocial, cliente_nomefantasia, cliente_endereco, cliente_nomerepresentante, cliente_telrepresentante, cliente_emailrepresentante, cliente_problema, cliente_solucao, cliente_resultado) 
        VALUES ('$cliente_razaosocial','$cliente_nomefantasia','$cliente_endereco','$cliente_nomerepresentante','$cliente_telrepresentante','$cliente_emailrepresentante','$cliente_problema','$cliente_solucao','$cliente_resultado')";

        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            die("Erro no banco " . mysqli_errno($conexao));
        } else {
            return true;            
        }
    }

    function alterarCliente($cliente_razaosocial, $cliente_nomefantasia, $cliente_endereco, $cliente_nomerepresentante, $cliente_telrepresentante, $cliente_emailrepresentante, $cliente_problema, $cliente_solucao, $cliente_resultado, $cliente_id)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $query = "UPDATE clientes SET cliente_razaosocial = '$cliente_razaosocial', cliente_nomefantasia = '$cliente_nomefantasia', cliente_endereco = '$cliente_endereco', cliente_nomerepresentante = '$cliente_nomerepresentante', cliente_telrepresentante = '$cliente_telrepresentante', cliente_emailrepresentante = '$cliente_emailrepresentante', cliente_problema = '$cliente_problema', cliente_solucao = '$cliente_solucao', cliente_resultado = '$cliente_resultado' WHERE cliente_id = {$cliente_id};";

        $resultado = mysqli_query($conexao, $query);
        if (!$resultado) {
            echo $query;
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
            
        }
        return true;
    }

    function deletarCliente($cliente_id)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "DELETE FROM clientes WHERE cliente_id = {$cliente_id}";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return $resultado;
    }  
}
