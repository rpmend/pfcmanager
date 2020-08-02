<!-- Funções exucutadas pelo sistema relacionadas ao Semestre -->

<?php

interface iServicosSemestre
{
    public function pegarSemestreAtual();
    public function alterarSemestre($configuracao_semestreatual);
}

class ServicosSemestre implements iServicosSemestre
{
    public function pegarSemestreAtual()
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "SELECT configuracao_semestreatual FROM configuracoes WHERE configuracao_id = 1";
        $resultado = mysqli_query($conexao, $consulta);
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        $linha = mysqli_fetch_assoc($resultado);
        $configuracao_semestreatual = $linha['configuracao_semestreatual'];
        return $configuracao_semestreatual;        
    }

    public function alterarSemestre($configuracao_semestreatual)
    {
        require_once("../../banco/conexao.php");

        $conexao = conectar();
        $consulta = "UPDATE configuracoes SET configuracao_semestreatual = $configuracao_semestreatual WHERE configuracao_id = 1";
        $resultado = mysqli_query($conexao, $consulta);        
        if (!$resultado) {
            die("Erro na consulta ao banco " . mysqli_errno($conexao));
        }
        return true;
    }
}
