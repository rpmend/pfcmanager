<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosBanca.php"); ?>
<?php require_once("../../servicos/ServicosProjeto.php"); ?>
<?php require_once("../../servicos/ServicosEquipe.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosBanca = new ServicosBanca();
    $servicosProjeto = new ServicosProjeto();
    $servicosEquipe = new ServicosEquipe();
    ?>

    <?php
    if (isset($_POST["banca_local"])) {
        if ($servicosBanca->cadastrarBanca(
            $_POST["banca_local"],
            $_POST["banca_data"],
            $_POST["banca_convidado1"],
            $_POST["banca_convidado2"],
            $_POST["banca_observacao"],
            $_POST["banca_projeto_id"]
        )) {
            $resultado = $servicosProjeto->buscarProjetoPorId($_POST["banca_projeto_id"]);
            $linha = mysqli_fetch_assoc($resultado);
            if ($servicosEquipe->atribuirNota($_POST["equipe_nota"], $linha["projeto_equipe_id"])) {
                if ($servicosProjeto->alterarStatus(3, $_POST["banca_projeto_id"])) {
                    header("location:../paginas_projeto/gestao.php");
                    $mensagem = " cadastrado com sucesso!";
                    echo $mensagem;
                } else {
                    $mensagem = "Erro ao alterar o status do projeto!";
                    echo $mensagem;
                }
            } else {
                $mensagem = "Erro ao atribuir nota à equipe!";
                echo $mensagem;
            }
        } else {
            $mensagem = "Erro ao cadastrar a banca no banco!";
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

        <?php include_once("../compartilhado/header.php"); ?> <main>
            <div class="container">
                <div class="row">
                    <div class="col s12 m6">
                        <form action="cadastro_banca.php" method="post">
                            <div class="form-elements">

                                <?php
                                //Caso possua um id de projeto (veio de gestao.php), 
                                if (isset($_GET["id"])) {
                                ?>
                                    <h4 class="grey-text text-darken-3" style="margin: 50px 0px 50px 0px">Informações da banca</h4>
                                <?php
                                }
                                ?>

                                <?php
                                //Caso possua um id de projeto (veio de gestao.php), 
                                if (!isset($_GET["id"])) {
                                ?>
                                    <h4 class="grey-text text-darken-3" style="margin: 50px 0px 50px 0px">Cadastrar banca</h4>
                                <?php
                                }
                                ?>

                                <?php
                                //Caso possua um id de projeto (veio de gestao.php), 
                                if (isset($_GET["id"])) {
                                ?>
                                    <!-- Projeto -->
                                    <div class="input-field">
                                        <select name="banca_projeto_id" required="required">
                                            <?php
                                            $resultado = $servicosProjeto->buscarProjetoPorId($_GET["id"]);
                                            while ($linha = mysqli_fetch_assoc($resultado)) {
                                            ?>
                                                <option value="<?php echo $linha["projeto_id"] ?>"><?php echo $linha["projeto_nome"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label>Projeto</label>
                                    </div>
                                <?php
                                }
                                ?>

                                <?php
                                //Caso NÃO possua um id de projeto (veio de index_banca.php), 
                                if (!isset($_GET["id"])) {
                                    # code...
                                ?>
                                    <!-- Projeto -->
                                    <div class="input-field">
                                        <select name="banca_projeto_id" required="required">
                                            <option value="" disabled selected>Escolha uma opção</option>
                                            <?php
                                            $resultado = $servicosProjeto->listarProjetosSemBanca();
                                            while ($linha = mysqli_fetch_assoc($resultado)) {
                                            ?>
                                                <option value="<?php echo $linha["projeto_id"] ?>"><?php echo $linha["projeto_nome"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label>Projeto</label>
                                    </div>
                                <?php
                                }
                                ?>

                                <!-- Local e Data -->
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input name="banca_local" type="text" class="validate" required>
                                        <label for="banca_local">Local</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input name="banca_data" type="date" class="datepicker" required>
                                        <label for="banca_data">Data</label>
                                    </div>
                                </div>

                                <!-- Convidados -->
                                <div class="input-field">
                                    <input name="banca_convidado1" type="text" class="validate">
                                    <label for="banca_convidado1">Convidado 1</label>
                                </div>
                                <div class="input-field">
                                    <input name="banca_convidado2" type="text" class="validate">
                                    <label for="banca_convidado2">Convidado 2</label>
                                </div>

                                <br />

                                <!-- Nota  -->
                                <div class="input-field">
                                    <input name="equipe_nota" type="number" step=".01" class="validate" required>
                                    <label for="equipe_nota">Nota</label>
                                </div>

                                <!-- Observações -->
                                <div class="input-field">
                                    <input name="banca_observacao" type="text" class="validate">
                                    <label for="banca_observacao">Observações</label>
                                </div>

                                <div class="row">
                                    <div class="input-field left">
                                        <a href="../paginas_projeto/gestao.php" class="btn waves-effect waves-light blue">Voltar
                                            <i class="material-icons left">keyboard_backspace</i>
                                        </a>
                                    </div>
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
                $("select[required]").css({
                    display: "block",
                    height: 0,
                    padding: 0,
                    width: 0,
                    position: 'absolute'
                });
                $('textarea#problema_cliente, textarea#solucao_cliente,textarea#resultado_cliente')
                    .characterCounter();
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