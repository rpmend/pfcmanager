<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosGpe.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosGpe = new ServicosGpe();
    ?>

    <?php
    $linha = mysqli_fetch_assoc($servicosGpe->listarGpePorId($_GET["id"]));
    
    // Executa a alteração
    if (isset($_POST["gpe_nome"])) {
        if ($servicosGpe->alterarGpe($_POST["gpe_nome"], $_GET["id"])) {
            header("location:index_gpe.php");
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
                        <form action="alterar_gpe.php?id=<?php echo $linha["gpe_id"] ?>" method="post">
                            <div class="form-elements">
                                <h4 class="grey-text text-darken-3" style="margin: 50px 0px 50px 0px">Alterar GPE</h4>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input value="<?php echo $linha["gpe_nome"] ?>" maxlength="45" name="gpe_nome" type="text" class="validate" required>
                                        <label for="gpe_nome">Gpe</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field left">
                                        <a href="index_gpe.php" class="btn waves-effect waves-light blue">Voltar
                                            <i class="material-icons left">keyboard_backspace</i>
                                        </a>
                                    </div>
                                    <div class="input-field right">
                                        <button class="btn waves-effect waves-light blue" type="submit">Alterar
                                            <i class="material-icons right">done</i>
                                        </button>
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
                $("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
                $('textgpe#problema_cliente, textgpe#solucao_cliente,textgpe#resultado_cliente').characterCounter();
                $('select').formSelect();
            });
        </script>
    </body>

    </html>

<?php
} else {
    header("location:../inicio/login.php");
}
?>