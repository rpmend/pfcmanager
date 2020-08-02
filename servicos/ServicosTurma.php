<!-- Funções exucutadas pelo sistema relacionadas à Turma -->

<?php

interface iServicosTurma
{
  public function listarTurmas();
  public function listarTurmaPorId($turma_id);
  public function pesquisarTurma($filtro);
  public function cadastrarTurma($turma_codigo, $turma_turno, $turma_curso_id, $turma_orientador_id, $turma_gpe_id);
  public function alterarTurma($turma_codigo, $turma_turno, $turma_curso_id, $turma_orientador_id, $turma_gpe_id, $turma_id);
  public function deletarTurma($turma_id);
}

class ServicosTurma implements iServicosTurma
{
  function listarTurmas()
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT * FROM cursos
        INNER JOIN areas
          ON cursos.curso_area_id = areas.area_id
        INNER JOIN coordenadores
          ON cursos.curso_coordenador_id = coordenadores.coordenador_id
        INNER JOIN turmas
          ON turmas.turma_curso_id = cursos.curso_id
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

  function listarTurmaPorId($turma_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT * FROM cursos
        INNER JOIN areas
          ON cursos.curso_area_id = areas.area_id
        INNER JOIN coordenadores
          ON cursos.curso_coordenador_id = coordenadores.coordenador_id
        INNER JOIN turmas
          ON turmas.turma_curso_id = cursos.curso_id
        INNER JOIN gpes
          ON turmas.turma_gpe_id = gpes.gpe_id
        INNER JOIN orientadores
          ON turmas.turma_orientador_id = orientadores.orientador_id
        WHERE turma_id = {$turma_id}";
    $resultado = mysqli_query($conexao, $consulta);

    if (!$resultado) {
      die("Falha na consulta do banco");
    }
    return $resultado;
  }
  function pesquisarTurma($filtro)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT * FROM cursos
        INNER JOIN areas
          ON cursos.curso_area_id = areas.area_id
        INNER JOIN coordenadores
          ON cursos.curso_coordenador_id = coordenadores.coordenador_id
        INNER JOIN turmas
          ON turmas.turma_curso_id = cursos.curso_id
        INNER JOIN gpes
          ON turmas.turma_gpe_id = gpes.gpe_id
        INNER JOIN orientadores
          ON turmas.turma_orientador_id = orientadores.orientador_id
        WHERE turma_codigo LIKE '%{$filtro}%' OR cursos.curso_nome LIKE '%{$filtro}%'";
    $resultado = mysqli_query($conexao, $consulta);

    if (!$resultado) {
      die("Falha na consulta do banco");
    }
    return $resultado;
  }

  function cadastrarTurma($turma_codigo, $turma_turno, $turma_curso_id, $turma_orientador_id, $turma_gpe_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $query = "INSERT INTO turmas (turma_codigo, turma_turno, turma_curso_id, turma_orientador_id, turma_gpe_id) VALUES ('$turma_codigo', '$turma_turno', '$turma_curso_id', '$turma_orientador_id', '$turma_gpe_id')";

    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
      die("Erro no banco " . mysqli_errno($conexao));
    } else {
      return true;
    }
  }

  function alterarTurma($turma_codigo, $turma_turno, $turma_curso_id, $turma_orientador_id, $turma_gpe_id, $turma_id)
  {
    require_once("../../banco/conexao.php");
    intval($turma_id);
    $conexao = conectar();

    $query = "UPDATE turmas SET turma_codigo = '{$turma_codigo}', turma_turno = '{$turma_turno}', turma_curso_id = {$turma_curso_id}, turma_orientador_id = {$turma_orientador_id}, turma_gpe_id = {$turma_gpe_id} WHERE turma_id = {$turma_id}";

    $resultado = mysqli_query($conexao, $query);

    if (!$resultado) {
      echo $query;
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return true;
  }

  function deletarTurma($turma_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "DELETE FROM turmas WHERE turma_id = {$turma_id}";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }
}
