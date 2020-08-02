<!-- Funções exucutadas pelo sistema relacionadas à Banca -->

<?php

interface iServicosBanca
{
  public function listarBancas();
  public function listarBancasPorId($banca_id);
  public function cadastrarBanca($banca_local, $banca_data, $banca_convidado1, $banca_convidado2, $banca_observacao, $projetos_projeto_id);
  public function alterarBanca($banca_local, $banca_data, $projetos_projeto_id, $banca_convidado1, $banca_convidado2, $banca_observacao, $banca_id);
  public function deletarBanca($banca_id);
}

class ServicosBanca implements iServicosBanca
{
  function listarBancas()
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta =
      "SELECT * FROM cursos
      INNER JOIN areas
    ON cursos.curso_area_id = areas.area_id
  INNER JOIN coordenadores
    ON cursos.curso_coordenador_id = coordenadores.coordenador_id
  INNER JOIN turmas
    ON turmas.turma_curso_id = cursos.curso_id
  CROSS JOIN bancas
  INNER JOIN projetos
    ON bancas.banca_projeto_id = projetos.projeto_id
  INNER JOIN clientes
    ON projetos.projeto_cliente_id = clientes.cliente_id
  INNER JOIN equipes
    ON projetos.projeto_equipe_id = equipes.equipe_id
    AND equipes.equipe_turma_id = turmas.turma_id
  INNER JOIN gpes
    ON turmas.turma_gpe_id = gpes.gpe_id
  INNER JOIN orientadores
    ON turmas.turma_orientador_id = orientadores.orientador_id";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }

  function listarBancasPorId($banca_id)
  {
    require_once("../../banco/conexao.php");
    intval($banca_id);

    $conexao = conectar();
    $consulta =
      "SELECT * FROM cursos
      INNER JOIN areas
    ON cursos.curso_area_id = areas.area_id
  INNER JOIN coordenadores
    ON cursos.curso_coordenador_id = coordenadores.coordenador_id
  INNER JOIN turmas
    ON turmas.turma_curso_id = cursos.curso_id
  CROSS JOIN bancas
  INNER JOIN projetos
    ON bancas.banca_projeto_id = projetos.projeto_id
  INNER JOIN clientes
    ON projetos.projeto_cliente_id = clientes.cliente_id
  INNER JOIN equipes
    ON projetos.projeto_equipe_id = equipes.equipe_id
    AND equipes.equipe_turma_id = turmas.turma_id
  INNER JOIN gpes
    ON turmas.turma_gpe_id = gpes.gpe_id
  INNER JOIN orientadores
    ON turmas.turma_orientador_id = orientadores.orientador_id
      WHERE banca_id = {$banca_id}";
    $resultado = mysqli_query($conexao, $consulta);

    if (!$resultado) {
      die("Falha na consulta do banco");
    }
    return $resultado;
  }

  function cadastrarBanca($banca_local, $banca_data, $banca_convidado1, $banca_convidado2, $banca_observacao, $banca_projeto_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $query = "INSERT INTO bancas (`banca_local`, `banca_data`, `banca_convidado1`, `banca_convidado2`, `banca_observacao`, `banca_projeto_id`) ";
    $query .= "VALUES ('$banca_local','$banca_data','$banca_convidado1','$banca_convidado2','$banca_observacao',$banca_projeto_id)";

    $resultado = mysqli_query($conexao, $query);
    var_dump($query);
    if (!$resultado) {
      die("Erro no banco " . mysqli_errno($conexao));
    } else {
      return true;
    }
  }

  function alterarBanca($banca_local, $banca_data, $projetos_projeto_id, $banca_convidado1, $banca_convidado2, $banca_observacao, $banca_id)
  {
  }



  function deletarBanca($banca_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "DELETE FROM bancas WHERE banca_id = {$banca_id}";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }
}
