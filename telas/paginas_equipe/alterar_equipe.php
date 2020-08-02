<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosEquipe.php"); ?>
<?php require_once("../../servicos/ServicosTurma.php"); ?>
<?php require_once("../../servicos/ServicosCurso.php"); ?>
<?php require_once("../../servicos/ServicosOrientador.php"); ?>
<?php require_once("../../servicos/ServicosGpe.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosEquipe = new ServicosEquipe();
    $servicosTurma = new ServicosTurma();
    $servicosCurso = new ServicosCurso();
    $servicosOrientador = new ServicosOrientador();
    $servicosGpe = new ServicosGpe();
    ?>

    <?php
    $linha = mysqli_fetch_assoc($servicosEquipe->listarEquipePorId($_GET["id"]));

    if (isset($_POST["equipe_gestor"])) {
        if ($servicosEquipe->alterarEquipe($_POST["equipe_turma_id"], $_POST["equipe_gestor"], $_POST["equipe_membro1"], $_POST["equipe_membro2"], $_POST["equipe_membro3"], $_POST["equipe_membro4"], $_POST["equipe_membro5"], $_GET["id"])) {
            header("location:index_equipe.php");
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
                        <form action="alterar_equipe.php?id=<?php echo $linha["equipe_id"] ?>" method="post">
                            <div class="form-elements">
                                <h4 class="grey-text text-darken-3" style="margin: 50px 0px 50px 0px">Alterar Equipe</h4>
                                <div class="row">

                                    <!-- Turma -->
                                    <div class="input-field col s12">
                                        <select name="equipe_turma_id" required="required">
                                            <option value="<?php echo $linha["equipe_turma_id"] ?>" ><?php echo $linha["equipe_turma_id"] ?> - <?php echo $linha["turma_codigo"] ?></option>
                                            <?php
                                            $resultado = $servicosTurma->listarTurmas();
                                            while ($linha_turma = mysqli_fetch_assoc($resultado)) {
                                            ?>
                                                <option value="<?php echo $linha_turma["turma_id"] ?>"><?php echo $linha_turma["turma_id"] ?> - <?php echo $linha_turma["turma_codigo"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label>Turma</label>
                                    </div>

                                    <!-- Gestor -->
                                    <div class="input-field col s12">
                                        <input name="equipe_gestor" maxlength="45" type="text" value="<?php echo $linha["equipe_gestor"] ?>" class="validate" required>
                                        <label for="equipe_gestor">Gestor</label>
                                    </div>

                                    <!-- Membro 1 -->
                                    <div class="input-field col s12">
                                        <input name="equipe_membro1" maxlength="45" type="text" value="<?php echo $linha["equipe_membro1"] ?>" class="validate">
                                        <label for="equipe_membro1">Membro 1</label>
                                    </div>

                                    <!-- Membro 2 -->
                                    <div class="input-field col s12">
                                        <input name="equipe_membro2" maxlength="45" type="text" value="<?php echo $linha["equipe_membro2"] ?>" class="validate">
                                        <label for="equipe_membro2">Membro 2</label>
                                    </div>

                                    <!-- Membro 3 -->
                                    <div class="input-field col s12">
                                        <input name="equipe_membro3" maxlength="45" type="text" value="<?php echo $linha["equipe_membro3"] ?>" class="validate">
                                        <label for="equipe_membro3">Membro 3</label>
                                    </div>

                                    <!-- Membro 4 -->
                                    <div class="input-field col s12">
                                        <input name="equipe_membro4" maxlength="45" type="text" value="<?php echo $linha["equipe_membro4"] ?>" class="validate">
                                        <label for="equipe_membro4">Membro 4</label>
                                    </div>

                                    <!-- Membro 5 -->
                                    <div class="input-field col s12">
                                        <input name="equipe_membro5" maxlength="45" type="text" value="<?php echo $linha["equipe_membro5"] ?>" class="validate">
                                        <label for="equipe_membro5">Membro 5</label>
                                    </div>
                                </div>

                                <!-- Botões -->
                                <div class="row">

                                    <!-- Botão Voltar -->
                                    <div class="input-field left">
                                        <a href="index_equipe.php" class="btn waves-effect waves-light blue">Voltar
                                            <i class="material-icons right">keyboard_backspace</i>
                                        </a>
                                    </div>

                                    <!-- Botão Alterar -->
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