<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosProjeto.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosProjeto = new ServicosProjeto();
    ?>

    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <?php include_once("../compartilhado/head.php"); ?>
    </head>

    <body>
        <?php include_once("../compartilhado/header.php"); ?>
        <main>
            <div class="container">
                <h3 class="light-blue-text text-darken-3"><i class="material-icons medium left" style="font-size: 3rem;">history</i> Histórico</h3>

                <!-- form -->
                <div class="row">
                    <form class="col s12" method="POST">
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">date_range</i>
                                <input name="semestre_inicial" type="text" class="validate">
                                <label for="semestre_inicial">Semestre inicial</label>
                                <span class="helper-text" data-error="wrong" data-success="right">Insira o semestre inicial (ex: 2018.1)</span>
                            </div>
                            <div class="input-field col s12">
                                <i class="material-icons prefix">date_range</i>
                                <input name="semestre_final" type="text" class="validate">
                                <label for="semestre_final">Semestre final</label>
                                <span class="helper-text" data-error="wrong" data-success="right">Insira o semestre final (ex: 2020.2)</span>
                            </div>
                            <div class="input-field col s12 center">
                                <button class="btn waves-effect waves-light light-blue darken-3" type="submit" name="action">Pesquisar<i class="material-icons right">search</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <?php
                if (isset($_POST["semestre_inicial"]) && isset($_POST["semestre_final"])) {
                ?>
                    <!-- Gráficos -->
                    <div class="row">

                        <!-- Retorno Financeiro -->
                        <div class="col s12 ">
                            <ul class="collapsible">
                                <li>
                                    <div class="collapsible-header light-blue darken-3 white-text">
                                        <i class="material-icons">monetization_on</i>
                                        Retorno Financeiro
                                    </div>
                                    <div class="collapsible-body light-blue-text text-darken-3 light-blue lighten-4">
                                        <h4> <sub><i class="material-icons small left">monetization_on</i></sub><strong><?php echo $servicosProjeto->somarRetornoPorSemestre($_POST["semestre_inicial"], $_POST["semestre_final"]) ?></strong></h4>
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
                                            <h5>Total de Projetos: <?php echo $servicosProjeto->totalDeProjetosPorSemestre($_POST["semestre_inicial"], $_POST["semestre_final"]) ?></h5>
                                            <p><i class="tiny material-icons grey-text">fiber_manual_record</i> Em reserva: <?php echo $servicosProjeto->totalDeProjetosReservaPorSemestre($_POST["semestre_inicial"], $_POST["semestre_final"]) ?></p>
                                            <p><i class="tiny material-icons blue-text text-lighten-3">fiber_manual_record</i> Não iniciados: <?php echo $servicosProjeto->totalDeProjetosNaoIniciadosPorSemestre($_POST["semestre_inicial"], $_POST["semestre_final"]) ?><p>
                                            <p><i class="tiny material-icons blue-text">fiber_manual_record</i> Em andamento: <?php echo $servicosProjeto->totalDeProjetosEmAndamentoPorSemeste($_POST["semestre_inicial"], $_POST["semestre_final"]) ?></p>
                                            <p><i class="tiny material-icons green-text">fiber_manual_record</i> Concluídos: <?php echo $servicosProjeto->totalDeProjetosConcluidosPorSemestre($_POST["semestre_inicial"], $_POST["semestre_final"]) ?></p>
                                            <p><i class="tiny material-icons red-text">fiber_manual_record</i> Cancelados: <?php echo $servicosProjeto->totalDeProjetosCanceladosPorSemestre($_POST["semestre_inicial"], $_POST["semestre_final"]) ?></p>
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
                <?php
                }
                ?>

            </div>
        </main>
        <?php include_once("../compartilhado/footer.php"); ?>
        <script src="../compartilhado/script.js"></script>
        <script>
            //Gráficos Dashboard
            var chrAndamentoCancelado = document.getElementById("chartAndamentoCancelado")
            var chrTipoProjeto = document.getElementById("chartTipoProjeto")
            var chrTipoProjetoEmpresa = document.getElementById("chartTipoProjetoEmpresa")
            var chrTipoNegocio = document.getElementById("chartTipoNegocio")
            var chrMacrotema = document.getElementById("chartMacrotema")
            var chrCurso = document.getElementById("chartCurso")
            var chrRetorno = document.getElementById("chartRetorno")

            //Gráficos Dashboard
            var chartAndamentoCancelado = new Chart(chrAndamentoCancelado, {
                type: 'doughnut',
                data: {
                    labels: ['Reserva', 'Nao Iniciado', 'Cancelado', 'Andamento', 'Concluido'],
                    datasets: [{
                        label: 'Mostrar/Ocultar',
                        data: [<?php echo $servicosProjeto->totalDeProjetosReservaPorSemestre($_POST["semestre_inicial"], $_POST["semestre_final"]) ?>, <?php echo $servicosProjeto->totalDeProjetosNaoIniciadosPorSemestre($_POST["semestre_inicial"], $_POST["semestre_final"]) ?>, <?php echo $servicosProjeto->totalDeProjetosCanceladosPorSemestre($_POST["semestre_inicial"], $_POST["semestre_final"]) ?>, <?php echo $servicosProjeto->totalDeProjetosEmAndamentoPorSemeste($_POST["semestre_inicial"], $_POST["semestre_final"]) ?>, <?php echo $servicosProjeto->totalDeProjetosConcluidosPorSemestre($_POST["semestre_inicial"], $_POST["semestre_final"]) ?>],
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

            var chartTipoProjeto = new Chart(chrTipoProjeto, {
                type: 'horizontalBar',
                data: {
                    labels: ['Interno', 'Externo', 'Ecossistema'],
                    datasets: [{
                        label: 'Mostrar/Ocultar',
                        data: [
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_tipo', 'Interno', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_tipo', 'Externo', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_tipo', 'Ecossistema', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>
                        ],
                        backgroundColor: '#2396f3',
                        borderColor: '#000',
                        borderWidth: 0,
                    }]
                },

            });

            var chartTipoProjetoEmpresa = new Chart(chrTipoProjetoEmpresa, {
                type: 'horizontalBar',
                data: {
                    labels: ['Pesquisa', 'Projeto', 'Des. de Produto', 'Processo'],
                    datasets: [{
                        label: 'Mostrar/Ocultar',
                        data: [
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_empresa', 'Pesquisa', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_empresa', 'Projeto', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_empresa', 'Desenvolvimento de Produto', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_empresa', 'Processo', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>
                        ],
                        backgroundColor: '#2396f3',
                        borderColor: '#000',
                        borderWidth: 0,
                    }]
                },

            });

            var chartTipoNegocio = new Chart(chrTipoNegocio, {
                type: 'horizontalBar',
                data: {
                    labels: ['Escola Técnica', 'Serviços Técnicos', 'Centro Universitário', 'P&D&I', 'Comércio', 'Indústria',
                        'Social', 'Cimatec', 'Cimatec Park'
                    ],
                    datasets: [{
                        label: 'Mostrar/Ocultar',
                        data: [
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_negocio', 'Escola Técnica', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_negocio', 'Serviços Técnicos', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_negocio', 'Centro Universitário', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_negocio', 'P&D&I', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_negocio', 'Comércio', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_negocio', 'Indústria', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_negocio', 'Social', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_negocio', 'Cimatec', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_negocio', 'Cimatec Park', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>
                        ],
                        backgroundColor: '#2396f3',
                        borderColor: '#000',
                        borderWidth: 0,
                    }]
                },

            });

            var chartMacrotema = new Chart(chrMacrotema, {
                type: 'horizontalBar',
                data: {
                    labels: ['Sustentabilidade', 'Inovação de Produto', 'Inovação de Processo', 'Otimização de Processo',
                        'Atualização Tecnologica', 'Resp. Social', 'Const. de Protótipos',
                        'Des. de Ferramentas', 'Plantas e Modelagens', 'Manutenção'
                    ],
                    datasets: [{
                        label: 'Mostrar/Ocultar',
                        data: [
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Sustentabilidade', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Inovação de Produto', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Inovação de Processo', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Otimização de Processo', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Automatização Tecnologica', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Responsabilidade Social', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Construção de Protótipos', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Desenvolvimento de Ferramentas', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Plantas e Modelagens', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCategoriaPorSemestre('projeto_macrotema', 'Manutenção', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>
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

            var chartCurso = new Chart(chrCurso, {
                type: 'horizontalBar',
                data: {
                    labels: ['Des. de Sistemas', 'Mecânica', 'Redes', 'Mecatrônica', 'Edificações', 'Logística', 'Química'],
                    datasets: [{
                        label: 'Mostrar/Ocultar',
                        data: [
                            <?php echo $servicosProjeto->totalDeProjetosPorCursoPorSemestre('Técnico em Desenvolvimento de Sistemas', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCursoPorSemestre('Técnico em Edificações', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCursoPorSemestre('Técnico em Eletrotécnica', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCursoPorSemestre('Técnico em Automatização Tecnologica', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCursoPorSemestre('Técnico em Logística', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCursoPorSemestre('Técnico em Manutenção Automotiva', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCursoPorSemestre('Técnico em Mecânica', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCursoPorSemestre('Técnico em Mecatrônica', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>,
                            <?php echo $servicosProjeto->totalDeProjetosPorCursoPorSemestre('Técnico em Redes de Computadores', $_POST["semestre_inicial"], $_POST["semestre_final"]) ?>
                        ],
                        backgroundColor: '#2396f3',
                        borderColor: '#000',
                        borderWidth: 0,
                    }]
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