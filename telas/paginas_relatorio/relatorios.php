<?php require_once("../../banco/conexao.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
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
                <h3 class="light-blue-text text-darken-3"><i class="material-icons medium">equalizer</i> Relatórios</h3>
                <div class="row">
                    <div class="col s12">
                    </div>

                    <div class="row">
                        <!-- Ata -->
                        <div class="col s12 m6 l4">
                            <a href="ata_gerar.php">
                                <div class="card card-bg light-blue lighten-4">
                                    <div class="card-content center">
                                        <h6><b>Ata</b></h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12 divider"></div>
                    </div>

                    <div class="row">
                        <div class="col s12 m6 l4">
                            <a href="relatorio_geral.php">
                                <div class="card card-bg light-blue lighten-4">
                                    <div class="card-content center">
                                        <h6><b>Geral</b></h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12 divider"></div>
                    </div>

                    <div class="row">
                        <!-- Curso -->
                        <div class="col s12 m6 l4">
                            <a href="relatorio_curso.php">
                                <div class="card card-bg light-blue lighten-4">
                                    <div class="card-content center">
                                        <h6><b>Curso</b></h6>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Turma -->
                        <div class="col s12 m6 l4">
                            <a href="relatorio_turma.php">
                                <div class="card card-bg light-blue lighten-4">
                                    <div class="card-content center">
                                        <h6><b>Turma</b></h6>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Semestre Letivo -->
                        <!-- <div class="col s12 m6 l4">
                        <a href="">
                            <div class="card card-bg light-blue lighten-4">
                                <div class="card-content center">
                                    <h6><b>Semestre Letivo</b></h6>
                                </div>
                            </div>
                        </a>
                    </div> -->

                        <!-- Modalidade -->
                        <!-- <div class="col s12 m6 l4">
                        <a href="#">
                            <div class="card card-bg light-blue lighten-4">
                                <div class="card-content center">
                                    <h6><b>Modalidade</b></h6>
                                </div>
                            </div>
                        </a>
                    </div> -->

                        <!-- Área Técnica -->
                        <div class="col s12 m6 l4">
                            <a href="relatorio_area.php">
                                <div class="card card-bg light-blue lighten-4">
                                    <div class="card-content center">
                                        <h6><b>Área Técnica</b></h6>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- GPE -->
                        <div class="col s12 m6 l4">
                            <a href="relatorio_gpe.php">
                                <div class="card card-bg light-blue lighten-4">
                                    <div class="card-content center">
                                        <h6><b>GPE</b></h6>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Coordenador -->
                        <div class="col s12 m6 l4">
                            <a href="relatorio_coordenador.php">
                                <div class="card card-bg light-blue lighten-4">
                                    <div class="card-content center">
                                        <h6><b>Coordenador</b></h6>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Título Projeto -->
                        <!-- <div class="col s12 m6 l4">
                        <a href="#">
                            <div class="card card-bg light-blue lighten-4">
                                <div class="card-content center">
                                    <h6><b>Título Projeto</b></h6>
                                </div>
                            </div>
                        </a>
                    </div> -->

                        <!-- Gestor do Projeto -->
                        <!-- <div class="col s12 m6 l4">
                        <a href="#">
                            <div class="card card-bg light-blue lighten-4">
                                <div class="card-content center">
                                    <h6><b>Gestor do Projeto</b></h6>
                                </div>
                            </div>
                        </a>
                    </div> -->

                        <!-- Cliente -->
                        <div class="col s12 m6 l4">
                            <a href="relatorio_cliente.php">
                                <div class="card card-bg light-blue lighten-4">
                                    <div class="card-content center">
                                        <h6><b>Cliente</b></h6>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Orientador -->
                        <div class="col s12 m6 l4">
                            <a href="relatorio_orientador.php">
                                <div class="card card-bg light-blue lighten-4">
                                    <div class="card-content center">
                                        <h6><b>Orientador</b></h6>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- GTA -->
                        <!-- <div class="col s12 m6 l4">
                        <a href="#">
                            <div class="card card-bg light-blue lighten-4">
                                <div class="card-content center">
                                    <h6><b>GTA</b></h6>
                                </div>
                            </div>
                        </a>
                    </div> -->

                        <!-- Macrotema -->
                        <!-- <div class="col s12 m6 l4">
                        <a href="#">
                            <div class="card card-bg light-blue lighten-4">
                                <div class="card-content center">
                                    <h6><b>Macrotema</b></h6>
                                </div>
                            </div>
                        </a>
                    </div> -->
                    </div>

                </div>
            </div>
        </main>
        <?php include_once("../compartilhado/footer.php"); ?>
        <script src="../compartilhado/script.js"></script>
    </body>

    </html>

<?php
} else {
    header("location:../inicio/login.php");
}
?>