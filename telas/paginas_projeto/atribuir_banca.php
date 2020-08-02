<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosBanca.php"); ?>
<?php require_once("../../servicos/ServicosProjeto.php"); ?>
<?php require_once("../../servicos/ServicosCliente.php"); ?>
<?php require_once("../../servicos/ServicosEquipe.php"); ?>
<?php require_once("../../servicos/ServicosSemestre.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosBanca = new ServicosBanca();
    $servicosProjeto = new ServicosProjeto();
    $servicosEquipe = new ServicosEquipe();
    $servicosCliente = new ServicosCliente();
    ?>

    <?php
    if (isset($_POST["projeto_equipe_id"])) {
        if ($servicosProjeto->atribuirEquipe($_POST["projeto_equipe_id"], $semestre_atual, $_GET["id"])) {
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
                        <form method="post">
                            <div class="form-elements">
                                <h3 class="light-blue-text text-darken-3">Atribuir Banca</h3>
                                <br>
                                <div class="row">
                                    <div class="input-field col s10">
                                        <select name="projeto_equipe_id">
                                            <option value="" disabled selected>Escolha uma opção</option>
                                            <?php
                                            $resultado = $servicosBanca->listarBancas();
                                            while ($linha = mysqli_fetch_assoc($resultado)) {
                                            ?>
                                                <option value="<?php echo $linha["banca_id"] ?>"><?php echo $linha["banca_id"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label>Banca</label>
                                    </div>
                                    <div class="col s2">
                                        <a class="btn-floating btn-large waves-effect waves-light blue right" href="../paginas_banca/cadastro_banca.php" target="_blank" title="Cadastrar Banca"><i class="material-icons">add</i></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field left">
                                        <a href="gestao.php" class="btn waves-effect waves-light blue">Voltar<i class="material-icons left">keyboard_backspace</i></a>
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