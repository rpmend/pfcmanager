<?php require_once "../../banco/conexao.php"; ?>
<?php require_once("../../servicos/ServicosCliente.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosCliente = new ServicosCliente();
    ?>

    <?php
    $resultado = $servicosCliente->listarClientePorId($_GET["id"]);
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
                <h4>Dados do Cliente</h4>
                <div class="row">
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content">

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Razão Social</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["cliente_razaosocial"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Nome Fantasia</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["cliente_nomefantasia"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Endereço</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["cliente_endereco"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Nome do Representante</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["cliente_nomerepresentante"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Telefone</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["cliente_telrepresentante"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Email do Representante</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["cliente_emailrepresentante"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Descreva o problema</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["cliente_problema"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Descreva a solução</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["cliente_solucao"] ?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s3" style="text-align:right">
                                        <p><strong>Resultados esperados</strong></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $linha["cliente_resultado"] ?></p>
                                    </div>
                                </div>
                                
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