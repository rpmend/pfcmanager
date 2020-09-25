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
    if (isset($_POST["motivo_cancelamento"])) {
        if ($servicosProjeto->cancelarProjeto($_POST["motivo_cancelamento"], $_GET["id"])) {
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
    <html lang="en">

    <?php include_once("../compartilhado/head.php"); ?>

    <body>
        <?php include_once("../compartilhado/header.php"); ?>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col s12 m6">
                        <div style="min-height: 780px">
                            <form action="cancelar_projeto.php?id=<?php echo $_GET["id"] ?>" method="POST">
                                <div class="modal-content">
                                    <h4>Cancelar Projeto</h4>
                                    <div class="input-field">
                                        <textarea name="motivo_cancelamento" class="materialize-textarea" data-length="200" required></textarea>
                                        <label for="motivo_cancelamento">Insira o motivo do cancelamento</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field left">
                                        <a href="gestao.php" class="btn waves-effect waves-light blue">Voltar<i class="material-icons left">keyboard_backspace</i></a>
                                    </div>
                                    <div class="input-field right">
                                        <button class="btn waves-effect waves-light blue" type="submit" name="action">Cancelar Projeto</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include_once("../compartilhado/footer.php"); ?>
        <script src="../script.js"></script>
    </body>

    </html>

<?php
} else {
    header("location:../inicio/login.php");
}
?>