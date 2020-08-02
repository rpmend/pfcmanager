<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosCliente.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosClientes = new ServicosCliente();
    ?>

    <?php
    $linha = mysqli_fetch_assoc($servicosClientes->listarClientePorId($_GET["id"]));

    if (isset($_POST["cliente_razaosocial"])) {
        if ($servicosClientes->alterarCliente($_POST["cliente_razaosocial"], $_POST["cliente_nomefantasia"], $_POST["cliente_endereco"], $_POST["cliente_nomerepresentante"], $_POST["cliente_telrepresentante"], $_POST["cliente_emailrepresentante"], $_POST["cliente_problema"], $_POST["cliente_solucao"], $_POST["cliente_resultado"], $_GET["id"])) {
            header("location:index_cliente.php");
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
                        <form action="alterar_cliente.php?id=<?php echo $linha["cliente_id"] ?>" method="post">
                            <div class="form-elements">
                                <h4 class="grey-text text-darken-3" style="margin: 50px 0px 50px 0px">Alterar Cliente</h4>

                                <!-- Razão Social -->
                                <div class="input-field">
                                    <input value="<?php echo $linha["cliente_razaosocial"] ?>" name="cliente_razaosocial" maxlength="45" type="text" class="validate" required>
                                    <label for="cliente_razaosocial">Razão Social</label>
                                </div>

                                <!-- Nome Fantasia -->
                                <div class="input-field">
                                    <input value="<?php echo $linha["cliente_nomefantasia"] ?>" name="cliente_nomefantasia" maxlength="45" type="text" class="validate" required>
                                    <label for="cliente_nomefantasia">Nome Fantasia</label>
                                </div>

                                <!-- Endereço -->
                                <div class="input-field">
                                    <input value="<?php echo $linha["cliente_endereco"] ?>" name="cliente_endereco" type="text" maxlength="45" class="validate" required>
                                    <label for="cliente_endereco">Endereço</label>
                                </div>

                                <!-- Nome do Representante -->
                                <div class="input-field">
                                    <input value="<?php echo $linha["cliente_nomerepresentante"] ?>" name="cliente_nomerepresentante" maxlength="45" type="text" class="validate" required>
                                    <label for="cliente_nomerepresentante">Nome do Representante</label>
                                </div>

                                <!-- Telefone -->
                                <div class="input-field">
                                    <input value="<?php echo $linha["cliente_telrepresentante"] ?>" name="cliente_telrepresentante" maxlength="45" type="text" class="validate" required>
                                    <label for="cliente_telrepresentante">Telefone</label>
                                </div>

                                <!-- Email do Representante -->
                                <div class="input-field">
                                    <input value="<?php echo $linha["cliente_emailrepresentante"] ?>" name="cliente_emailrepresentante" maxlength="45" type="email" class="validate" required>
                                    <label for="cliente_emailrepresentante">Email do Representante</label>
                                </div>

                                <!-- Problema -->
                                <div class="input-field">
                                    <textarea value="<?php echo $linha["cliente_problema"] ?>" maxlength="1000" name="cliente_problema" class="materialize-textarea" data-length="1000" required><?php echo $linha["cliente_problema"] ?></textarea>
                                    <label for="cliente_problema">Descreva o problema</label>
                                </div>

                                <!-- Solução -->
                                <div class="input-field">
                                    <textarea value="<?php echo $linha["cliente_solucao"] ?>" maxlength="1000" name="cliente_solucao" class="materialize-textarea" data-length="1000" required><?php echo $linha["cliente_solucao"] ?></textarea>
                                    <label for="cliente_solucao">Descreva a solução</label>
                                </div>

                                <!-- Resultado Esperado -->
                                <div class="input-field">
                                    <textarea value="<?php echo $linha["cliente_resultado"] ?>" maxlength="1000" name="cliente_resultado" class="materialize-textarea" data-length="1000" required><?php echo $linha["cliente_resultado"] ?></textarea>
                                    <label for="cliente_resultado">Resultados esperados</label>
                                </div>

                                <!-- Botões -->
                                <div class="row">

                                    <!-- Botão Voltar -->
                                    <div class="input-field left">
                                        <a href="../paginas_cliente/index_cliente.php?id=<?php echo $linha["cliente_id"] ?>" class="btn waves-effect waves-light blue">Voltar
                                            <i class="material-icons left">keyboard_backspace</i>
                                        </a>
                                    </div>

                                    <!-- Botão Alterar -->
                                    <div class="input-field right">
                                        <button class="btn waves-effect waves-light blue" type="submit">Alterar<i class="material-icons right">done</i></button>
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
                $('textarea#problema_cliente, textarea#solucao_cliente,textarea#resultado_cliente').characterCounter();
            });
        </script>
    </body>

    </html>

<?php
} else {
    header("location:../inicio/login.php");
}
?>