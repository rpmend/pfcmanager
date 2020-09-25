<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosSemestre.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosSemestre = new ServicosSemestre();
    ?>

<?php
    if (isset($_POST["semestre_atual"])) {
        if ($servicosSemestre->alterarSemestre($_POST["semestre_atual"])) {
            header("location:semestre.php");
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
                    <div class="col s12 m6 offset-m3">
                        <form method="POST">
                            <h3 class="light-blue-text text-darken-3">O semestre atual é <?php echo $semestre_atual = $servicosSemestre->pegarSemestreAtual(); ?> </h3>
                            <div class="input-field col s12">
                                <input name="semestre_atual" type="number" class="validate" min="2015" max="2030" step=".1" required>
                                <label for="semestre_atual">Insira o novo semestre</label>
                                <span class="helper-text" data-error="wrong" data-success="right">(ex: 2018.1)</span>
                            </div>
                            <div class="input-field col s12 center">
                                <button class="btn waves-effect waves-light blue" type="submit">Alterar</button>
                            </div>
                            <div class="input-field col s12 center">
                                <a href="../paginas_projeto/dashboard.php" class="btn waves-effect waves-light blue">Ir para o Dashboard</a>
                            </div>
                        </form>
                    </div>

                </div>
                </form>
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