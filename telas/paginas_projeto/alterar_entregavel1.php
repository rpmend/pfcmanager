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

    if (isset($_POST["projeto_entregavel1"])) {

        if ($servicosProjeto->alterarEntregavel1($_POST["projeto_entregavel1"], $_GET["id"])) {
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
                        <form action="alterar_entregavel1.php?id=<?php echo $_GET["id"] ?>" method="post">
                            <div class="form-elements">
                                <h3 class="light-blue-text text-darken-3">Alterar Entregável 1</h3>
                                
                                <div class="input-field">
                                    <i class="material-icons prefix black-text">date_range</i>
                                    <input value="<?php echo $linha["projeto_entregavel1"]?>" name="projeto_entregavel1" type="text" class="datepicker">
                                    <label for="projeto_entregavel1">Entregável 1</label>
                                </div>

                                <div class="row">
                                    <div class="input-field left">
                                        <a href="gestao.php" class="btn waves-effect waves-light blue">Voltar<i class="material-icons right">keyboard_backspace</i></a>
                                    </div>
                                    <div class="input-field right">
                                        <button class="btn waves-effect waves-light blue" type="submit">Atribuir<i class="material-icons right">done</i></button>
                                    </div>
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