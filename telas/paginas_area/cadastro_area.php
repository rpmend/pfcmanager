<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosArea.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosArea = new ServicosArea();
    ?>

    <?php
    if (isset($_POST["area_nome"])) {
        if ($servicosArea->cadastrarArea($_POST["area_nome"])) {
            header("location:index_area.php");
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

                        <!-- Formulário -->
                        <form method="post">
                            <div class="form-elements">
                                <h4 class="grey-text text-darken-3" style="margin: 50px 0px 50px 0px">Cadastrar Área</h4>

                                <!-- Área Nome -->
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input name="area_nome" maxlength="45" type="text" class="validate">
                                        <label for="area_nome">Nome da Área</label>
                                    </div>
                                </div>
                                
                                <!-- Botões -->
                                <div class="row">

                                    <!-- Botão Voltar -->
                                    <div class="input-field left">
                                        <a href="index_area.php" class="btn waves-effect waves-light blue">Voltar
                                            <i class="material-icons left">keyboard_backspace</i>
                                        </a>
                                    </div>

                                    <!-- Botão Cadastrar -->
                                    <div class="input-field right">
                                        <button class="btn waves-effect waves-light blue" type="submit" name="action">Cadastrar
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
                $('textarea#problema_cliente, textarea#solucao_cliente,textarea#resultado_cliente').characterCounter();
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