<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosProjeto.php"); ?>
<?php require_once("../../servicos/ServicosSemestre.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

  <?php
  $servicosProjeto = new ServicosProjeto();
  $servicosSemestre = new ServicosSemestre();
  $servicosSemestre = new ServicosSemestre();
  ?>

  <?php $semestre_atual = $servicosSemestre->pegarSemestreAtual(); ?>

  <!DOCTYPE html>
  <html lang="pt-BR">

  <head>
    <?php include_once("../compartilhado/head.php"); ?>
  </head>

  <body>

    <?php include_once("../compartilhado/header.php"); ?>

    <!-- conteúdo -->
    <main>
      <!-- dashboard -->
      <section class="section" id="dashboard">
        <div class="container">

          <!-- (tela pequena) -->
          <div class="row valign-wrapper hide-on-med-and-up">

            <!-- Título -->
            <div class="col s12 m9">
              <h3 class="light-blue-text text-darken-3">Dashboard</h3>
            </div>

            <!-- Semestre -->
            <div class="col s12 m3">
              <a class="btn waves-effect waves-light blue right" href="../paginas_semestre/semestre.php"><?php echo $semestre_atual = $servicosSemestre->pegarSemestreAtual(); ?><i class="material-icons right">edit</i></a>
            </div>

          </div>

          <!-- (tela grande) -->
          <div class="row valign-wrapper hide-on-small-and-down">

            <!-- Título -->
            <div class="col s12 m9">
              <h3 class="light-blue-text text-darken-3"><i class="material-icons left" style="font-size: 3rem;">dashboard</i> Dashboard</h3>
            </div>

            <!-- Semestre-->
            <div class="col s12 m3">
              <a class="btn waves-effect waves-light blue right" href="../paginas_semestre/semestre.php"><?php echo $semestre_atual = $servicosSemestre->pegarSemestreAtual(); ?><i class="material-icons right">edit</i></a>
            </div>

          </div>

          <!-- Gráficos -->
          <div class="row">

            <!-- Retorno Financeiro -->
            <div class="col s12">
              <ul class="collapsible">
                <li>
                  <div class="collapsible-header blue white-text">
                    <i class="material-icons">monetization_on</i>
                    Retorno Financeiro
                  </div>
                  <div class="collapsible-body light-blue-text text-darken-3 light-blue lighten-4">
                    <h4> <sub><i class="material-icons small left">monetization_on</i></sub><strong>R$ <?php echo $servicosProjeto->somarRetornoPorSemestre($semestre_atual, $semestre_atual) ?></strong></h4>
                  </div>
                </li>
              </ul>
            </div>

            <!-- Gráfico Totoal Projetos -->
            <div class="col s12 center">
              <div class="card card-bg light-blue lighten-4">
                <div class="card-content">
                  <div class="row">
                    <div class="col s12 m6">
                      <h5>Total de Projetos: <?php echo $servicosProjeto->totalDeProjetosPorSemestre($semestre_atual, $semestre_atual) ?></h5>
                      <p><i class="tiny material-icons grey-text">fiber_manual_record</i> Em reserva: <?php echo $servicosProjeto->totalDeProjetosReservaPorSemestre($semestre_atual, $semestre_atual) ?></p>
                      <p><i class="tiny material-icons blue-text text-lighten-3">fiber_manual_record</i> Não iniciados: <?php echo $servicosProjeto->totalDeProjetosNaoIniciadosPorSemestre($semestre_atual, $semestre_atual) ?><p>
                          <p><i class="tiny material-icons blue-text">fiber_manual_record</i> Em andamento: <?php echo $servicosProjeto->totalDeProjetosEmAndamentoPorSemeste($semestre_atual, $semestre_atual) ?></p>
                          <p><i class="tiny material-icons green-text">fiber_manual_record</i> Concluídos: <?php echo $servicosProjeto->totalDeProjetosConcluidosPorSemestre($semestre_atual, $semestre_atual) ?></p>
                          <p><i class="tiny material-icons red-text">fiber_manual_record</i> Cancelados: <?php echo $servicosProjeto->totalDeProjetosCanceladosPorSemestre($semestre_atual, $semestre_atual) ?></p>
                    </div>
                    <div class="col s12 m6" style="margin-top: 1rem;">
                      <canvas id="chartAndamentoCancelado" style="max-height: 200px; max-width: 200px;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col s12">
              <div class="row">

                <!-- Gráfico Tipos de Projeto -->
                <div class="col s12 m6">
                  <div class="card card-bg light-blue lighten-4">
                    <div class="chart-content">
                      <h5 class="center">Tipos de Projetos</h5>
                      <canvas id="chartTipoProjeto"></canvas>
                    </div>
                  </div>
                </div>

                <!-- Gráfico Tipos de Projeto Empresa -->
                <div class="col s12 m6">
                  <div class="card card-bg light-blue lighten-4">
                    <div class="chart-content">
                      <h5 class="center">Tipos de Projeto Empresa</h5>
                      <canvas id="chartTipoProjetoEmpresa"></canvas>
                    </div>
                  </div>
                </div>

                <!-- Gráfico Tipos de Negócio -->
                <div class="col s12 m6">
                  <div class="card card-bg light-blue lighten-4">
                    <div class="chart-content">
                      <h5 class="center">Tipos de Negócio</h5>
                      <canvas id="chartTipoNegocio"></canvas>
                    </div>
                  </div>
                </div>

                <!-- Gráfico Cursos -->
                <div class="col s12 m6">
                  <div class="card card-bg light-blue lighten-4">
                    <div class="chart-content">
                      <h5 class="center">Cursos</h5>
                      <canvas id="chartCurso"></canvas>
                    </div>
                  </div>
                </div>

                <!-- Gráfico Macrotema -->
                <div class="col s12 m12">
                  <div class="card card-bg light-blue lighten-4">
                    <div class="card-content">
                      <div class="row">
                        <div id="t5" class="col s12">
                          <h5 class="center">Macrotema</h5>
                          <canvas id="chartMacrotema"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div>

        </div>
      </section>

    </main>

    <?php include_once("../compartilhado/footer.php"); ?>

    <!-- <script src="script_graficos_dashboard.js"></script> -->
    <script src="../compartilhado/script.js"></script>
    <script>
      //Declaração Gráficos Dashboard
      var chrAndamentoCancelado = document.getElementById("chartAndamentoCancelado")
      var chrTipoProjeto = document.getElementById("chartTipoProjeto")
      var chrTipoProjetoEmpresa = document.getElementById("chartTipoProjetoEmpresa")
      var chrTipoNegocio = document.getElementById("chartTipoNegocio")
      var chrMacrotema = document.getElementById("chartMacrotema")
      var chrCurso = document.getElementById("chartCurso")
      var chrRetorno = document.getElementById("chartRetorno")

      //Gráfioco Status
      var chartAndamentoCancelado = new Chart(chrAndamentoCancelado, {
        type: 'doughnut',
        data: {
          labels: ['Reserva', 'Nao Iniciado', 'Cancelado', 'Andamento', 'Concluido'],
          datasets: [{
            label: 'Projetos',
            data: [<?php echo $servicosProjeto->totalDeProjetosReservaPorSemestre($semestre_atual, $semestre_atual) ?>, <?php echo $servicosProjeto->totalDeProjetosNaoIniciadosPorSemestre($semestre_atual, $semestre_atual) ?>, <?php echo $servicosProjeto->totalDeProjetosCanceladosPorSemestre($semestre_atual, $semestre_atual) ?>, <?php echo $servicosProjeto->totalDeProjetosEmAndamentoPorSemeste($semestre_atual, $semestre_atual) ?>, <?php echo $servicosProjeto->totalDeProjetosConcluidosPorSemestre($semestre_atual, $semestre_atual) ?>],
            backgroundColor: [
              '#9e9e9e',
              '#90caf9',
              '#f44336',
              '#2196f3',
              '#4caf50'
            ],
            borderColor: [
              'rgba(0, 0, 0, 3)',
              'rgba(0, 0, 0, 3)',
              'rgba(0, 0, 0, 3)',
              'rgba(0, 0, 0, 3)',
              'rgba(0, 0, 0, 3)'
            ],
            borderWidth: 0,
          }]
        },
        options: {
          legend: {
            display: false,
            labels: {
              fontColor: '#000',
            }
          }
        }
      });

      // Grafico Tipo de Projeto
      var chartTipoProjeto = new Chart(chrTipoProjeto, {
        type: 'horizontalBar',
        data: {
          labels: ['Interno', 'Externo', 'Ecossistema'],
          datasets: [{
            label: 'Projetos',
            data: [
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_tipo', 'Interno', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_tipo', 'Externo', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_tipo', 'Ecossistema', $semestre_atual, $semestre_atual) ?>
            ],
            backgroundColor: '#2396f3',
            borderColor: '#000',
            borderWidth: 0,
          }]
        },

      });

      // Grafico Tipo de Projeto Empresa
      var chartTipoProjetoEmpresa = new Chart(chrTipoProjetoEmpresa, {
        type: 'horizontalBar',
        data: {
          labels: ['Pesquisa', 'Projeto', 'Des. de Produto', 'Processo'],
          datasets: [{
            label: 'Projetos',
            data: [
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_empresa', 'Pesquisa', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_empresa', 'Projeto', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_empresa', 'Desenvolvimento de Produto', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_empresa', 'Processo', $semestre_atual, $semestre_atual) ?>
            ],
            backgroundColor: '#2396f3',
            borderColor: '#000',
            borderWidth: 0,
          }]
        },

      });

      // Grafico Tipo de Negócio
      var chartTipoNegocio = new Chart(chrTipoNegocio, {
        type: 'horizontalBar',
        data: {
          labels: ['Escola Técnica', 'Serviços Técnicos', 'Centro Universitário', 'P&D&I', 'Comércio', 'Indústria',
            'Social', 'Cimatec', 'Cimatec Park'
          ],
          datasets: [{
            label: 'Projetos',
            data: [
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_negocio', 'Escola Técnica', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_negocio', 'Serviços Técnicos', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_negocio', 'Centro Universitário', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_negocio', 'P&D&I', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_negocio', 'Comércio', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_negocio', 'Indústria', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_negocio', 'Social', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_negocio', 'Cimatec', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_negocio', 'Cimatec Park', $semestre_atual, $semestre_atual) ?>
            ],
            backgroundColor: '#2396f3',
            borderColor: '#000',
            borderWidth: 0,
          }]
        },

      });

      // Grafico Macrotema
      var chartMacrotema = new Chart(chrMacrotema, {
        type: 'horizontalBar',
        data: {
          labels: ['Sustentabilidade', 'Inovação de Produto', 'Inovação de Processo', 'Otimização de Processo',
            'Atualização Tecnologica', 'Resp. Social', 'Const. de Protótipos',
            'Des. de Ferramentas', 'Plantas e Modelagens', 'Manutenção'
          ],
          datasets: [{
            label: 'Projetos',
            data: [
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Sustentabilidade', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Inovação de Produto', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Inovação de Processo', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Otimização de Processo', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Automatização Tecnologica', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Responsabilidade Social', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Construção de Protótipos', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Desenvolvimento de Ferramentas', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Plantas e Modelagens', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Manutenção', $semestre_atual, $semestre_atual) ?>
            ],
            backgroundColor: '#2396f3',
            borderColor: '#000',
            borderWidth: 0,
          }]
        },
        options: {
          legend: {
            labels: {
              fontColor: '#000',
            }

          }
        }
      });

      // Grafico Curso
      var chartCurso = new Chart(chrCurso, {
        type: 'horizontalBar',
        data: {
          labels: ['Desenvolvimento de Sistemas', 'Edificações', 'Eletrotécnica', 'Logística', 'Manutenção Automotiva', 'Mecânica', 'Mecatrônica', 'Redes de Computadores'],
          datasets: [{
            label: 'Projetos',
            data: [
              <?php echo $servicosProjeto->totalDeProjetosPorCursoPorSemestre('Técnico em Desenvolvimento de Sistemas', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCursoPorSemestre('Técnico em Edificações', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCursoPorSemestre('Técnico em Eletrotécnica', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCursoPorSemestre('Técnico em Automatização Tecnologica', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCursoPorSemestre('Técnico em Logística', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCursoPorSemestre('Técnico em Manutenção Automotiva', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCursoPorSemestre('Técnico em Mecânica', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCursoPorSemestre('Técnico em Mecatrônica', $semestre_atual, $semestre_atual) ?>,
              <?php echo $servicosProjeto->totalDeProjetosPorCursoPorSemestre('Técnico em Redes de Computadores', $semestre_atual, $semestre_atual) ?>
            ],
            backgroundColor: '#2396f3',
            borderColor: '#000',
            borderWidth: 0,
          }],
        },
      });

      var chartRetorno = new Chart(chrRetorno, {
        type: 'line',
        data: {
          labels: ['2038.3', '2038.2', '2039.3', '2039.2', '2020.3', '2020.2?'],
          datasets: [{
            label: 'Mostrar/Ocultar',
            data: [3300, 3250, 3090, 3400, 3350, 3450],
            backgroundColor: '#00695c',
            borderColor: '#000',
            borderWidth: 0,
          }]
        },

      });
    </script>
  </body>

  </html>

<?php
} else {
  header("location:../inicio/login.php");
}
?>