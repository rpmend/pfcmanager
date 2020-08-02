<?php require_once "../../banco/conexao.php"; ?>
<?php require_once("../../servicos/ServicosProjeto.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosProjeto = new ServicosProjeto();
    ?>

    <?php
    // Verifica se o projeto já possui uma equipe.
    // Se o projeto já possuir uma equipe, irá buscar os dados que estão associados à equipe (turma, curso, área, orientador, etc)
    $resultado = $servicosProjeto->buscarProjetoComClientePorId($_GET["id"]);
    $linha = mysqli_fetch_assoc($resultado);
    if ($linha["projeto_equipe_id"]) {
        $resultado = $servicosProjeto->buscarProjetoPorId($_GET["id"]);
        $linha = mysqli_fetch_assoc($resultado);
    }
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
                <h4>Dados do Projeto</h4>
                <div class="row">
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content">

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Nome do Projeto</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["projeto_nome"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Cliente</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["cliente_nomefantasia"] ?></p>
                                    </div>
                                </div>

                                <?php
                                if ($linha["projeto_equipe_id"]) {
                                ?>

                                    <div class="row">
                                        <div class="col s3" style="text-align:right">
                                            <p><strong>Equipe (GP)</strong></p>
                                        </div>
                                        <div class="col s6">
                                            <p>Equipe de <?php echo  $linha["equipe_gestor"] ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col s3" style="text-align:right">
                                            <p><strong>Turma</strong></p>
                                        </div>
                                        <div class="col s6">
                                            <p><?php echo  $linha["turma_codigo"] ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col s3" style="text-align:right">
                                            <p><strong>Curso</strong></p>
                                        </div>
                                        <div class="col s6">
                                            <p><?php echo  $linha["curso_nome"] ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col s3" style="text-align:right">
                                            <p><strong>Orientador</strong></p>
                                        </div>
                                        <div class="col s6">
                                            <p><?php echo  $linha["orientador_nome"] ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col s3" style="text-align:right">
                                            <p><strong>GPE</strong></p>
                                        </div>
                                        <div class="col s6">
                                            <p><?php echo  $linha["gpe_nome"] ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col s3" style="text-align:right">
                                            <p><strong>Área</strong></p>
                                        </div>
                                        <div class="col s6">
                                            <p><?php echo  $linha["area_nome"] ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col s3" style="text-align:right">
                                            <p><strong>Coordenador</strong></p>
                                        </div>
                                        <div class="col s6">
                                            <p><?php echo  $linha["coordenador_nome"] ?></p>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Tipo de Projeto</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["projeto_tipo"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Tipo de Projeto Empresa</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["projeto_empresa"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Tipo de Negócio</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["projeto_negocio"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Macrotema</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["projeto_macrotema"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Retorno Financeiro</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p>R$ <?php echo $linha["projeto_retorno"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Risco</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["projeto_risco"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Observação</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["projeto_observacao"] ?></p>
                                    </div>
                                </div>

                            </div>
                            <div class="card-action">
                                <a href="../paginas_projeto/reserva.php">voltar para Banco de Projetos</a>
                                <a href="../paginas_projeto/gestao.php">voltar para Gestão de Projetos</a>
                                <!-- <a href="alterar_projeto.php?id=<?php echo $linha["projeto_id"] ?>">alterar</a> -->
                                <!-- <a href="deletar_projeto.php?id=<?php echo $linha["projeto_id"] ?>">excluir</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
    <?php include_once("../compartilhado/footer.php"); ?>

    </html>

<?php
} else {
    header("location:../inicio/login.php");
}
?>