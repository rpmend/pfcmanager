<!-- Funções exucutadas pelo sistema relacionadas ao Projeto -->

<?php

interface iServicosProjeto
{
  public function totalDeProjetos();
  public function totalDeProjetosPorSemestre($semestre_inicial, $semestre_final);
  public function totalDeProjetosCancelados();
  public function totalDeProjetosEmAndamento();
  public function totalDeProjetosConcluidos();
  public function totalDeProjetosReserva();
  public function totalDeProjetosNaoIniciados();

  public function somarRetornoTotal();
  public function somarRetornoPorSemestre($semestre_inicial, $semestre_final);

  public function listarProjetos();
  public function listarProjetosSemBanca();
  public function buscarProjetoPorId($projeto_id);
  public function buscarProjetoComClientePorId($projeto_id);
  public function listarProjetosRiscoAlto();
  public function listarProjetosRiscoMedio();
  public function listarProjetosRiscoBaixo();
  public function listarProjetosNaoIniciados();
  public function listarProjetosCancelados();
  public function listarProjetosEmAndamento();
  public function listarProjetosConcluidos();
  public function listarProjetosPorTabelaColunaValorSemestre($categoria, $subcategoria, $valor, $semestre_inicial, $semestre_final);

  public function cadastrarProjeto($projeto_nome, $projeto_tipo, $projeto_empresa, $projeto_negocio, $projeto_macrotema, $projeto_risco, $projeto_retorno, $projeto_observacao, $projeto_cliente_id);
  public function cadastrarProjetoCompleto($projeto_nome, $projeto_tipo, $projeto_empresa, $projeto_negocio, $projeto_macrotema, $projeto_risco, $projeto_retorno, $projeto_status, $projeto_semestre, $projeto_entregavel1, $projeto_status1, $projeto_entregavel2, $projeto_status2, $projeto_entregavel3, $projeto_status3, $projeto_observacao, $projeto_motivocancelamento, $projeto_equipe_id, $projeto_cliente_id);

  public function atribuirEquipe($projeto_equipe_id, $semestre_atual, $projeto_id);

  public function alterarProjeto($projeto_nome, $projeto_tipo, $projeto_empresa, $projeto_negocio, $projeto_macrotema, $projeto_risco, $projeto_retorno, $projeto_status, $projeto_semestre, $projeto_entregavel1, $projeto_status1, $projeto_entregavel2, $projeto_status2, $projeto_entregavel3, $projeto_status3, $projeto_observacao, $projeto_motivocancelamento, $projeto_equipe_id, $projeto_cliente_id, $projeto_id);
  public function alterarObservacao($projeto_observacao, $projeto_id);
  public function alterarStatus($projeto_status, $projeto_id);

  public function cancelarProjeto($projeto_motivocancelamento, $projeto_id);

  public function dataDeHoje();

  public function deletarProjeto($projeto_id);
}

class ServicosProjeto implements iServicosProjeto
{
  function totalDeProjetos()
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT COUNT(*) AS total_projetos FROM projetos;";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($resultado);
    $total_projetos = $linha['total_projetos'];
    //echo $total_projetos;
    return $total_projetos;
  }

  function totalDeProjetosPorSemestre($semestre_inicial, $semestre_final)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT COUNT(*) AS total_projetos FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final;";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($resultado);
    $total_projetos = $linha['total_projetos'];
    //echo $total_projetos;
    return $total_projetos;
  }

  function totalDeProjetosReserva()
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT COUNT(*) AS total_projetos_reserva FROM projetos WHERE projeto_status = 0;";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($resultado);
    $total_projetos_reserva = $linha['total_projetos_reserva'];
    //echo $total_projetos_reserva;
    return $total_projetos_reserva;
  }

  function totalDeProjetosReservaPorSemestre($semestre_inicial, $semestre_final)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT COUNT(*) AS total_projetos_reserva FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND projeto_status = 0;";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($resultado);
    $total_projetos_reserva = $linha['total_projetos_reserva'];
    //echo $total_projetos_reserva;
    return $total_projetos_reserva;
  }

  function totalDeProjetosNaoIniciados()
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT COUNT(*) AS total_projetos_nao_iniciados FROM projetos WHERE projeto_status = 1;";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($resultado);
    $total_projetos_nao_iniciados = $linha['total_projetos_nao_iniciados'];
    //echo $total_projetos_nao_iniciados;
    return $total_projetos_nao_iniciados;
  }

  function totalDeProjetosNaoIniciadosPorSemestre($semestre_inicial, $semestre_final)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT COUNT(*) AS total_projetos_nao_iniciados FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND projeto_status = 1;";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($resultado);
    $total_projetos_nao_iniciados = $linha['total_projetos_nao_iniciados'];
    //echo $total_projetos_nao_iniciados;
    return $total_projetos_nao_iniciados;
  }

  function totalDeProjetosEmAndamento()
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT COUNT(*) AS total_projetos_andamento FROM projetos WHERE projeto_status = 2;";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($resultado);
    $total_projetos_andamento = $linha['total_projetos_andamento'];
    //echo $total_projetos_andamento;
    return $total_projetos_andamento;
  }

  function totalDeProjetosEmAndamentoPorSemeste($semestre_inicial, $semestre_final)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT COUNT(*) AS total_projetos_andamento FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND projeto_status = 2;";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($resultado);
    $total_projetos_andamento = $linha['total_projetos_andamento'];
    //echo $total_projetos_andamento;
    return $total_projetos_andamento;
  }

  function totalDeProjetosConcluidos()
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT COUNT(*) AS total_projetos_concluidos FROM projetos WHERE projeto_status = 3;";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($resultado);
    $total_projetos_andamento = $linha['total_projetos_concluidos'];
    //echo $total_projetos_andamento;
    return $total_projetos_andamento;
  }

  function totalDeProjetosConcluidosPorSemestre($semestre_inicial, $semestre_final)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT COUNT(*) AS total_projetos_concluidos FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND projeto_status = 3;";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($resultado);
    $total_projetos_andamento = $linha['total_projetos_concluidos'];
    //echo $total_projetos_andamento;
    return $total_projetos_andamento;
  }

  function totalDeProjetosCancelados()
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT COUNT(*) AS total_projetos_cancelados FROM projetos WHERE projeto_status = 4;";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($resultado);
    $total_projetos_cancelados = $linha['total_projetos_cancelados'];
    //echo $total_projetos_cancelados;
    return $total_projetos_cancelados;
  }

  function totalDeProjetosCanceladosPorSemestre($semestre_inicial, $semestre_final)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT COUNT(*) AS total_projetos_cancelados FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND projeto_status = 4;";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($resultado);
    $total_projetos_cancelados = $linha['total_projetos_cancelados'];
    //echo $total_projetos_cancelados;
    return $total_projetos_cancelados;
  }

  function totalDeProjetosPorTipoPorSemestre($tipo_projeto, $semestre_inicial, $semestre_final)
  {
    require_once("../../banco/conexao.php");

    switch ($tipo_projeto) {
      case 'value':
        # code...
        break;
      case 'value':
        # code...
        break;
      case 'value':
        # code...
        break;

      default:
        # code...
        break;
    }

    $conexao = conectar();
    $consulta = "SELECT COUNT(*) AS total_projetos_cancelados FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND projeto_status = 4;";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($resultado);
    $total_projetos_cancelados = $linha['total_projetos_cancelados'];
    //echo $total_projetos_cancelados;
    return $total_projetos_cancelados;
  }

  function totalDeProjetosPorCursoPorSemestre($curso, $semestre_inicial, $semestre_final)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT COUNT(*) AS total FROM projetos INNER JOIN equipes ON projetos.projeto_equipe_id = equipes.equipe_id INNER JOIN turmas ON equipes.equipe_turma_id = turmas.turma_id INNER JOIN cursos ON turmas.turma_curso_id = cursos.curso_id WHERE projetos.projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND cursos.curso_nome = '$curso';";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($resultado);
    $total = $linha['total'];
    //echo $total;
    return $total;
  }

  function totalDeProjetosPorCategoriaPorSemestre($categoria, $subcategoria, $semestre_inicial, $semestre_final)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();

    switch ($categoria) {
      case 'projeto_tipo':
        switch ($subcategoria) {
          case 'Interno':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Externo':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Ecossistema':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          default:
            # code...
            break;
        }
        break;
      case 'projeto_empresa':
        switch ($subcategoria) {
          case 'Pesquisa':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Projeto':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Desenvolvimento de Produto':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Processo':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          default:
            # code...
            break;
        }
        break;
      case 'projeto_negocio':
        switch ($subcategoria) {
          case 'Escola Técnica':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Serviços Técnicos':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Centro Universitário':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'P&D&I':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Comércio':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Indústria':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Social':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Cimatec':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Cimatec Park':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          default:
            # code...
            break;
        }
        break;
      case 'projeto_macrotema':
        switch ($subcategoria) {
          case 'Sustentabilidade':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Inovação de Produto':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Inovação de Processo':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Otimização de Processo':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Automatização Tecnologica':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Responsabilidade Social':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Construção de Protótipos':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Desenvolvimento de Ferramentas':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Plantas e Modelagens':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          case 'Manutenção':
            $consulta = "SELECT COUNT(*) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final AND $categoria = '$subcategoria';";
            break;
          default:
            # code...
            break;
        }
        break;
      default:
        # code...
        break;
    }

    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($resultado);
    $total = $linha['total'];
    //echo $total;
    return $total;
  }

  function somarRetornoTotal()
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT sum(projeto_retorno) AS total FROM projetos;";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($resultado);
    $soma_retorno_financeiro = $linha['total'];
    //echo $soma_retorno_financeiro;
    return $soma_retorno_financeiro;
  }

  function somarRetornoPorSemestre($semestre_inicial, $semestre_final)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT sum(projeto_retorno) AS total FROM projetos WHERE projeto_semestre BETWEEN $semestre_inicial AND $semestre_final;";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($resultado);
    $soma_retorno_financeiro = $linha['total'];
    //echo $soma_retorno_financeiro;
    return $soma_retorno_financeiro;
  }

  function listarProjetos()
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
        CROSS JOIN projetos
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

  function listarProjetosSemBanca()
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT * FROM projetos
      WHERE projeto_tem_banca = 0";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }

  function buscarProjetoPorId($projeto_id)
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
        CROSS JOIN projetos
        INNER JOIN clientes
          ON projetos.projeto_cliente_id = clientes.cliente_id
        INNER JOIN equipes
          ON projetos.projeto_equipe_id = equipes.equipe_id
          AND equipes.equipe_turma_id = turmas.turma_id
        INNER JOIN gpes
          ON turmas.turma_gpe_id = gpes.gpe_id
        INNER JOIN orientadores
          ON turmas.turma_orientador_id = orientadores.orientador_id
        WHERE projeto_id = $projeto_id;";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }

  function buscarProjetoComClientePorId($projeto_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT * FROM projetos
    INNER JOIN clientes
      ON projetos.projeto_cliente_id = clientes.cliente_id
        WHERE projeto_id = $projeto_id;";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }

  function listarProjetosRiscoAlto()
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT * FROM projetos
    INNER JOIN clientes
      ON projetos.projeto_cliente_id = clientes.cliente_id 
        WHERE projeto_status = '0' AND projeto_risco = 'alto';";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }

  function listarProjetosRiscoMedio()
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT * FROM projetos
    INNER JOIN clientes
      ON projetos.projeto_cliente_id = clientes.cliente_id  
        WHERE projeto_status = '0' AND projeto_risco = 'medio';";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }

  function listarProjetosRiscoBaixo()
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT * FROM projetos
        INNER JOIN clientes
          ON projetos.projeto_cliente_id = clientes.cliente_id 
        WHERE projeto_status = '0' AND projeto_risco = 'baixo';";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }

  function listarProjetosNaoIniciados()
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
        CROSS JOIN projetos
        INNER JOIN clientes
          ON projetos.projeto_cliente_id = clientes.cliente_id
        INNER JOIN equipes
          ON projetos.projeto_equipe_id = equipes.equipe_id
          AND equipes.equipe_turma_id = turmas.turma_id
        INNER JOIN gpes
          ON turmas.turma_gpe_id = gpes.gpe_id
        INNER JOIN orientadores
          ON turmas.turma_orientador_id = orientadores.orientador_id 
        WHERE projeto_status = '1';";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }

  function listarProjetosNaoIniciadosPorNome($filtro)
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
        CROSS JOIN projetos
        INNER JOIN clientes
          ON projetos.projeto_cliente_id = clientes.cliente_id
        INNER JOIN equipes
          ON projetos.projeto_equipe_id = equipes.equipe_id
          AND equipes.equipe_turma_id = turmas.turma_id
        INNER JOIN gpes
          ON turmas.turma_gpe_id = gpes.gpe_id
        INNER JOIN orientadores
          ON turmas.turma_orientador_id = orientadores.orientador_id 
        WHERE projeto_status = '1'
        AND projeto_nome LIKE '%{$filtro}%'";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }

  function listarProjetosEmAndamento()
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
        CROSS JOIN projetos
        INNER JOIN clientes
          ON projetos.projeto_cliente_id = clientes.cliente_id
        INNER JOIN equipes
          ON projetos.projeto_equipe_id = equipes.equipe_id
          AND equipes.equipe_turma_id = turmas.turma_id
        INNER JOIN gpes
          ON turmas.turma_gpe_id = gpes.gpe_id
        INNER JOIN orientadores
          ON turmas.turma_orientador_id = orientadores.orientador_id
        WHERE projeto_status = '2';";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }

  function listarProjetosEmAndamentoPorNome($filtro)
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
        CROSS JOIN projetos
        INNER JOIN clientes
          ON projetos.projeto_cliente_id = clientes.cliente_id
        INNER JOIN equipes
          ON projetos.projeto_equipe_id = equipes.equipe_id
          AND equipes.equipe_turma_id = turmas.turma_id
        INNER JOIN gpes
          ON turmas.turma_gpe_id = gpes.gpe_id
        INNER JOIN orientadores
          ON turmas.turma_orientador_id = orientadores.orientador_id
        WHERE projeto_status = '2'
        AND projeto_nome LIKE '%{$filtro}%'";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }

  function listarProjetosConcluidos()
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
        CROSS JOIN projetos
        INNER JOIN clientes
          ON projetos.projeto_cliente_id = clientes.cliente_id
        INNER JOIN equipes
          ON projetos.projeto_equipe_id = equipes.equipe_id
          AND equipes.equipe_turma_id = turmas.turma_id
        INNER JOIN gpes
          ON turmas.turma_gpe_id = gpes.gpe_id
        INNER JOIN orientadores
          ON turmas.turma_orientador_id = orientadores.orientador_id
        WHERE projeto_status = '3';";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }

  function listarProjetosConcluidosPorNome($filtro)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar($filtro);
    $consulta = "SELECT * FROM cursos
        INNER JOIN areas
          ON cursos.curso_area_id = areas.area_id
        INNER JOIN coordenadores
          ON cursos.curso_coordenador_id = coordenadores.coordenador_id
        INNER JOIN turmas
          ON turmas.turma_curso_id = cursos.curso_id
        CROSS JOIN projetos
        INNER JOIN clientes
          ON projetos.projeto_cliente_id = clientes.cliente_id
        INNER JOIN equipes
          ON projetos.projeto_equipe_id = equipes.equipe_id
          AND equipes.equipe_turma_id = turmas.turma_id
        INNER JOIN gpes
          ON turmas.turma_gpe_id = gpes.gpe_id
        INNER JOIN orientadores
          ON turmas.turma_orientador_id = orientadores.orientador_id
        WHERE projeto_status = '3'
        AND projeto_nome LIKE '%{$filtro}%'";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }

  function listarProjetosCancelados()
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
        CROSS JOIN projetos
        INNER JOIN clientes
          ON projetos.projeto_cliente_id = clientes.cliente_id
        INNER JOIN equipes
          ON projetos.projeto_equipe_id = equipes.equipe_id
          AND equipes.equipe_turma_id = turmas.turma_id
        INNER JOIN gpes
          ON turmas.turma_gpe_id = gpes.gpe_id
        INNER JOIN orientadores
          ON turmas.turma_orientador_id = orientadores.orientador_id
        WHERE projeto_status = '4';";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }

  function listarProjetosCanceladosPorNome($filtro)
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
        CROSS JOIN projetos
        INNER JOIN clientes
          ON projetos.projeto_cliente_id = clientes.cliente_id
        INNER JOIN equipes
          ON projetos.projeto_equipe_id = equipes.equipe_id
          AND equipes.equipe_turma_id = turmas.turma_id
        INNER JOIN gpes
          ON turmas.turma_gpe_id = gpes.gpe_id
        INNER JOIN orientadores
          ON turmas.turma_orientador_id = orientadores.orientador_id
        WHERE projeto_status = '4'
        AND projeto_nome LIKE '%{$filtro}%'";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }

  function listarProjetosPorTabelaColunaValorSemestre($tabela, $coluna, $valor, $semestre_inicial, $semestre_final)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();

    if ($valor == "todos") {
      $string_base = "SELECT * FROM cursos
    INNER JOIN areas
      ON cursos.curso_area_id = areas.area_id
    INNER JOIN coordenadores
      ON cursos.curso_coordenador_id = coordenadores.coordenador_id
    INNER JOIN turmas
      ON turmas.turma_curso_id = cursos.curso_id
    CROSS JOIN projetos
    INNER JOIN clientes
      ON projetos.projeto_cliente_id = clientes.cliente_id
    INNER JOIN equipes
      ON projetos.projeto_equipe_id = equipes.equipe_id
      AND equipes.equipe_turma_id = turmas.turma_id
    INNER JOIN gpes
      ON turmas.turma_gpe_id = gpes.gpe_id
    INNER JOIN orientadores
      ON turmas.turma_orientador_id = orientadores.orientador_id
    WHERE projetos.projeto_semestre BETWEEN $semestre_inicial AND $semestre_final";
      $consulta = $string_base;
    } else {
      $string_base = "SELECT * FROM cursos
      INNER JOIN areas
        ON cursos.curso_area_id = areas.area_id
      INNER JOIN coordenadores
        ON cursos.curso_coordenador_id = coordenadores.coordenador_id
      INNER JOIN turmas
        ON turmas.turma_curso_id = cursos.curso_id
      CROSS JOIN projetos
      INNER JOIN clientes
        ON projetos.projeto_cliente_id = clientes.cliente_id
      INNER JOIN equipes
        ON projetos.projeto_equipe_id = equipes.equipe_id
        AND equipes.equipe_turma_id = turmas.turma_id
      INNER JOIN gpes
        ON turmas.turma_gpe_id = gpes.gpe_id
      INNER JOIN orientadores
        ON turmas.turma_orientador_id = orientadores.orientador_id";
      $filter_string = " WHERE " . $tabela . "." . $coluna . "=" . "'" . $valor . "'" . "AND projetos.projeto_semestre BETWEEN $semestre_inicial AND $semestre_final";
      $consulta = $string_base . $filter_string;
    }

    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      echo $consulta;
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }

  function listarProjetosPorGeral($cliente, $turma, $curso, $area, $coordenador, $orientador, $gpe, $semestre_inicial, $semestre_final)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();

    $string_base = "SELECT * FROM cursos
    INNER JOIN areas
      ON cursos.curso_area_id = areas.area_id
    INNER JOIN coordenadores
      ON cursos.curso_coordenador_id = coordenadores.coordenador_id
    INNER JOIN turmas
      ON turmas.turma_curso_id = cursos.curso_id
    CROSS JOIN projetos
    INNER JOIN clientes
      ON projetos.projeto_cliente_id = clientes.cliente_id
    INNER JOIN equipes
      ON projetos.projeto_equipe_id = equipes.equipe_id
      AND equipes.equipe_turma_id = turmas.turma_id
    INNER JOIN gpes
      ON turmas.turma_gpe_id = gpes.gpe_id
    INNER JOIN orientadores
      ON turmas.turma_orientador_id = orientadores.orientador_id
    WHERE projetos.projeto_semestre BETWEEN $semestre_inicial AND $semestre_final";

    $consulta = $string_base;

    if ($cliente != "todos") {
      $filtro_cliente = " AND clientes.cliente_nomefantasia = '$turma'";
      $consulta = $consulta . $filtro_cliente;
    }

    if ($turma != "todos") {
      $filtro_turma = " AND turmas.turma_codigo = '$cliente'";
      $consulta = $consulta . $filtro_turma;
    }

    if ($curso != "todos") {
      $filtro_curso = " AND cursos.curso_nome = '$curso'";
      $consulta = $consulta . $filtro_curso;
    }

    if ($area != "todos") {
      $filtro_area = " AND areas.area_nome = '$area'";
      $consulta = $consulta . $filtro_area;
    }

    if ($coordenador != "todos") {
      $filtro_coordenador = " AND coordenadores.coordenador_nome = '$coordenador'";
      $consulta = $consulta . $filtro_coordenador;
    }

    if ($orientador != "todos") {
      $filtro_orientador = " AND orientadores.orientador_nome = '$orientador'";
      $consulta = $consulta . $filtro_orientador;
    }

    if ($gpe != "todos") {
      $filtro_gpe = " AND gpes.gpe_nome = '$gpe'";
      $consulta = $consulta . $filtro_gpe;
    }

    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      echo $consulta;
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }

  function cadastrarProjeto($projeto_nome, $projeto_tipo, $projeto_empresa, $projeto_negocio, $projeto_macrotema, $projeto_risco, $projeto_retorno, $projeto_observacao, $projeto_cliente_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $projeto_status = 0;
    $query = "INSERT INTO projetos (projeto_nome, projeto_tipo, projeto_empresa, projeto_negocio, projeto_macrotema, projeto_risco, projeto_retorno, projeto_status, projeto_observacao, projeto_cliente_id) 
        VALUES ('$projeto_nome','$projeto_tipo','$projeto_empresa','$projeto_negocio','$projeto_macrotema','$projeto_risco',$projeto_retorno,$projeto_status,'$projeto_observacao',$projeto_cliente_id)";

    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
      echo $query;
      die("Erro no banco " . mysqli_errno($conexao));
    } else {
      return true;
    }
  }

  function cadastrarProjetoCompleto($projeto_nome, $projeto_tipo, $projeto_empresa, $projeto_negocio, $projeto_macrotema, $projeto_risco, $projeto_retorno, $projeto_status, $projeto_semestre, $projeto_entregavel1, $projeto_status1, $projeto_entregavel2, $projeto_status2, $projeto_entregavel3, $projeto_status3, $projeto_observacao, $projeto_motivocancelamento, $projeto_equipe_id, $projeto_cliente_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $query = "INSERT INTO projetos 
        (projeto_nome, projeto_tipo, projeto_empresa, projeto_negocio, projeto_macrotema, projeto_risco, projeto_retorno, projeto_status, projeto_semestre, projeto_entregavel1, projeto_status1, projeto_entregavel2, projeto_status2, projeto_entregavel3, projeto_status3, projeto_observacao, projeto_motivocancelamento, projeto_equipe_id, projeto_cliente_id) 
        VALUES ('$projeto_nome','$projeto_tipo','$projeto_empresa','$projeto_negocio','$projeto_macrotema','$projeto_risco',$projeto_retorno,$projeto_status,$projeto_semestre,'$projeto_entregavel1',$projeto_status1,'$projeto_entregavel2',$projeto_status2,'$projeto_entregavel3',$projeto_status3,'$projeto_observacao','$projeto_motivocancelamento',$projeto_equipe_id, $projeto_cliente_id)";

    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
      echo $query;
      die("Erro no banco " . mysqli_errno($conexao));
    } else {
      return true;
    }
  }

  function atribuirEquipe($projeto_equipe_id, $semestre_atual, $projeto_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $projeto_status = 1;
    $query = "UPDATE projetos SET projeto_equipe_id = {$projeto_equipe_id}, projeto_semestre = {$semestre_atual}, projeto_status = {$projeto_status} WHERE projeto_id = {$projeto_id}";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return true;
  }

  function atribuirBanca($projeto_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $projeto_status = 3;
    $query = "UPDATE projetos SET projeto_status = {$projeto_status} WHERE projeto_id = {$projeto_id}";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return true;
  }

  function alterarProjeto($projeto_nome, $projeto_tipo, $projeto_empresa, $projeto_negocio, $projeto_macrotema, $projeto_risco, $projeto_retorno, $projeto_status, $projeto_semestre, $projeto_entregavel1, $projeto_status1, $projeto_entregavel2, $projeto_status2, $projeto_entregavel3, $projeto_status3, $projeto_observacao, $projeto_motivocancelamento, $projeto_equipe_id, $projeto_cliente_id, $projeto_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $query = "UPDATE projetos SET projeto_nome = '$projeto_nome', projeto_tipo = '$projeto_tipo', projeto_empresa = '$projeto_empresa', projeto_negocio = '$projeto_negocio', projeto_macrotema = '$projeto_macrotema', projeto_risco =  '$projeto_risco', projeto_retorno = $projeto_retorno, projeto_status = $projeto_status, projeto_semestre = $projeto_semestre, projeto_entregavel1 = '$projeto_entregavel1', projeto_status1 = $projeto_status1, projeto_entregavel2 = '$projeto_entregavel2', projeto_status2 = $projeto_status2, projeto_entregavel3 = '$projeto_entregavel3', projeto_status3 = $projeto_status3, projeto_observacao = '$projeto_observacao', projeto_motivocancelamento = '$projeto_motivocancelamento', projeto_equipe_id = $projeto_equipe_id, projeto_cliente_id = $projeto_cliente_id WHERE projeto_id = {$projeto_id};";

    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
      echo $query;
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return true;
  }

  function atribuirEntregaveis($projeto_entregavel1, $projeto_entregavel2, $projeto_entregavel3, $projeto_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $projeto_status = 2;
    $projeto_status1 = 0;
    $projeto_status2 = 0;
    $projeto_status3 = 0;
    $query = "UPDATE projetos SET projeto_entregavel1 = '{$projeto_entregavel1}', projeto_entregavel2 = '{$projeto_entregavel2}' , projeto_entregavel3 = '{$projeto_entregavel3}', projeto_status1 = $projeto_status1, projeto_status2 = $projeto_status2, projeto_status3 = $projeto_status3, projeto_status = $projeto_status WHERE projeto_id = {$projeto_id}; ";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return true;
  }

  function alterarEntregavel1($projeto_entregavel1, $projeto_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $query = "UPDATE projetos SET projeto_entregavel1 = '{$projeto_entregavel1}' WHERE projeto_id = {$projeto_id}; ";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return true;
  }

  function alterarEntregavel2($projeto_entregavel2, $projeto_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $query = "UPDATE projetos SET projeto_entregavel2 = '{$projeto_entregavel2}' WHERE projeto_id = {$projeto_id}; ";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return true;
  }

  function alterarEntregavel3($projeto_entregavel3, $projeto_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $query = "UPDATE projetos SET projeto_entregavel3 = '{$projeto_entregavel3}' WHERE projeto_id = {$projeto_id}; ";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return true;
  }

  function alterarObservacao($projeto_observacao, $projeto_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $query = "UPDATE projetos SET projeto_observacao = '{$projeto_observacao}' WHERE projeto_id = {$projeto_id}; ";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return true;
  }

  function alterarStatus($projeto_status, $projeto_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $query = "UPDATE projetos SET projeto_status = {$projeto_status} WHERE projeto_id = {$projeto_id}; ";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return true;
  }

  function cancelarProjeto($projeto_motivocancelamento, $projeto_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $projeto_status = 4;
    $query = "UPDATE projetos SET projeto_status = $projeto_status, projeto_motivocancelamento = '{$projeto_motivocancelamento}' WHERE projeto_id = {$projeto_id}; ";
    $resultado = mysqli_query($conexao, $query);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return true;
  }

  function dataDeHoje()
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "SELECT CURDATE() as hoje;";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($resultado);
    $hoje = $linha['hoje'];
    //echo $soma_retorno_financeiro;
    return $hoje;
  }

  function deletarProjeto($projeto_id)
  {
    require_once("../../banco/conexao.php");

    $conexao = conectar();
    $consulta = "DELETE FROM projetos WHERE projeto_id = {$projeto_id}";
    $resultado = mysqli_query($conexao, $consulta);
    if (!$resultado) {
      die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    return $resultado;
  }
}
