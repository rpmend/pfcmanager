<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosOrientador.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosOrientador = new ServicosOrientador();
    ?>

    <?php
    $linha = mysqli_fetch_assoc($servicosOrientador->listarOrientadorPorId($_GET["id"]));
    
    // Executa a alteração
    if (isset($_POST["orientador_nome"])) {
        if ($servicosOrientador->alterarOrientador($_POST["orientador_nome"], $_GET["id"])) {
            header("location:index_orientador.php");
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
                        <form action="alterar_orientador.php?id=<?php echo $linha["orientador_id"] ?>" method="post">
                            <div class="form-elements">
                                <h4 class="grey-text text-darken-3" style="margin: 50px 0px 50px 0px">Alterar Orientador</h4>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input value="<?php echo $linha["orientador_nome"] ?>" maxlength="45" name="orientador_nome" type="text" class="validate" required>
                                        <label for="orientador_nome">Orientador</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field left">
                                        <a href="index_orientador.php" class="btn waves-effect waves-light blue">Voltar
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
                $('textorientador#problema_cliente, textorientador#solucao_cliente,textorientador#resultado_cliente').characterCounter();
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