<?php require_once "../../banco/conexao.php"; ?>
<?php require_once("../../servicos/ServicosEquipe.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosEquipe = new ServicosEquipe();
    ?>

    <?php
    $resultado = $servicosEquipe->listarEquipePorId($_GET["id"]);
    $linha = mysqli_fetch_assoc($resultado);
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
                <h4>Dados da Equipe</h4>
                <div class="row">
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content">

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Gestor</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["equipe_gestor"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Membro 1</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["equipe_membro1"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Membro 2</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["equipe_membro2"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Membro 3</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["equipe_membro3"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Membro 4</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["equipe_membro4"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Membro 5</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["equipe_membro5"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Turma</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["turma_codigo"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Curso</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["curso_nome"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Orientador</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["orientador_nome"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>GPE</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["gpe_nome"] ?></p>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="card-action">
                                <a href="../paginas_projeto/gestao.php">voltar</a>
                                <!-- <a href="alterar_equipe.php?id=<?php echo $linha["equipe_id"] ?>">alterar</a> -->
                                <!-- <a href="deletar_equipe.php?id=<?php echo $linha["equipe_id"] ?>">excluir</a> -->
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