<?php require_once("../../banco/conexao.php"); ?>
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

    if (isset($_POST["observacao"])) {

        if ($servicosProjeto->alterarObservacao($_POST["observacao"], $_GET["id"])) {
            header("location:gestao.php");
            $mensagem = "Registro cadastrado com sucesso!";
            echo $mensagem;
        } else {
            $mensagem = "Erro ao cadastrar o registro no banco!";
            echo $mensagem;
        }
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
                <div class="row">
                    <div class="col s12 m6">
                        <form method="POST" action="alterar_observacao.php?id=<?php echo $_GET["id"] ?>">
                            <div class="modal-content">
                                <h4>Alterar Observação</h4>
                                <div class="input-field">
                                    <textarea name="observacao" maxlength="1000" class="materialize-textarea" data-length="200"><?php echo $linha["projeto_observacao"] ?></textarea>
                                    <label for="observacao">Insira a nova observação</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field left">
                                    <a href="reserva.php" class="btn waves-effect waves-light blue">Voltar<i class="material-icons left">keyboard_backspace</i></a>
                                </div>
                                <div class="input-field right">
                                    <button class="btn waves-effect waves-light blue" type="submit" name="action">Salvar Observação</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <?php include_once("../compartilhado/footer.php"); ?>
        <script src="../compartilhado/script.js"></script>
        <script>
            $(document).ready(function() {
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    autoClose: true
                });
            });
        </script>
    </body>

    </html>

<?php
} else {
    header("location:../inicio/login.php");
}
?>