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
    $resultado = $servicosProjeto->buscarProjetoPorId($_GET["id"]);
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
                <h4>Dados do Projeto</h4>
                <div class="row">
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content">
                                <p>Nome do Projeto: <?php echo $linha["projeto_nome"] ?></p>
                                <p>Tipo do Projeto: <?php echo $linha["projeto_tipo"] ?></p>
                                <p>Tipo Projeto Empresa: <?php echo $linha["projeto_empresa"] ?></p>
                                <p>Tipo de Negócio: <?php echo $linha["projeto_negocio"] ?></p>
                                <p>Macrotema: <?php echo $linha["projeto_macrotema"] ?></p>
                                <p>Risco: <?php echo $linha["projeto_risco"] ?></p>
                                <p>Descreva o problema: <?php echo $linha["projeto_retorno"] ?></p>
                                <p>Descreva a solução: <?php echo $linha["projeto_status"] ?></p>
                                <p>Resultados esperados: <?php echo $linha["projeto_semestre"] ?></p>
                                <p>Resultados esperados: <?php echo $linha["projeto_entregavel1"] ?></p>
                                <p>Resultados esperados: <?php echo $linha["projeto_entregavel2"] ?></p>
                                <p>Resultados esperados: <?php echo $linha["projeto_entregavel3"] ?></p>
                                <p>Resultados esperados: <?php echo $linha["projeto_observacao"] ?></p>
                                <p>Resultados esperados: <?php echo $linha["projeto_motivocancelamento"] ?></p>                                
                            </div>
                            <div class="card-action">
                                <a href="../paginas_projeto/gestao.php">voltar</a>
                                <!-- <a href="alterar_cliente.php?id=<?php echo $linha["cliente_id"] ?>">alterar</a> -->
                                <!-- <a href="deletar_cliente.php?id=<?php echo $linha["cliente_id"] ?>">excluir</a> -->
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