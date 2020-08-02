<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosTurma.php"); ?>
<?php require_once("../../servicos/ServicosCurso.php"); ?>
<?php require_once("../../servicos/ServicosOrientador.php"); ?>
<?php require_once("../../servicos/ServicosGpe.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosTurma = new ServicosTurma();
    $servicosCurso = new ServicosCurso();
    $servicosOrientador = new ServicosOrientador();
    $servicosGpe = new ServicosGpe();
    ?>

    <?php
    if (isset($_POST["turma_codigo"])) {
        if ($servicosTurma->cadastrarTurma($_POST["turma_codigo"], $_POST["turma_turno"], $_POST["turma_curso_id"], $_POST["turma_orientador_id"], $_POST["turma_gpe_id"])) {
            header("location:index_turma.php");
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
                        <form action="cadastro_turma.php" method="post">
                            <div class="form-elements">
                                <h4 class="grey-text text-darken-3" style="margin: 50px 0px 50px 0px">Cadastrar Turma</h4>
                                <div class="row">

                                    <!-- Turma Código -->
                                    <div class="input-field col s12">
                                        <input name="turma_codigo" maxlength="45" type="text" class="validate" required>
                                        <label for="turma_codigo">Código</label>
                                    </div>

                                    <!-- Turma Turno -->
                                    <div class="input-field col s12">
                                        <select name="turma_turno" required="required">
                                            <option value="" disabled selected>Escolha uma opção</option>
                                            <option value="Matutino">Matutino</option>
                                            <option value="Vespertino">Vespertino</option>
                                            <option value="Noturno">Noturno</option>
                                        </select>
                                        <label for="turma_turno">Turno</label>
                                    </div>

                                    <!-- Turma Curso -->
                                    <div class="input-field col s12">
                                        <select name="turma_curso_id" required="required">
                                            <option value="" disabled selected>Escolha uma opção</option>
                                            <?php
                                            $resultado = $servicosCurso->listarCursos();
                                            while ($linha = mysqli_fetch_assoc($resultado)) {
                                            ?>
                                                <option value="<?php echo $linha["curso_id"] ?>"><?php echo $linha["curso_id"] ?> - <?php echo $linha["curso_nome"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label>Curso</label>
                                    </div>

                                    <!-- Turma Orientador -->
                                    <div class="input-field col s12">
                                        <select name="turma_orientador_id" required="required">
                                            <option value="" disabled selected>Escolha uma opção</option>
                                            <?php
                                            $resultado = $servicosOrientador->listarOrientadores();
                                            while ($linha = mysqli_fetch_assoc($resultado)) {
                                            ?>
                                                <option value="<?php echo $linha["orientador_id"] ?>"><?php echo $linha["orientador_id"] ?> - <?php echo $linha["orientador_nome"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label>Orientador</label>
                                    </div>

                                    <!-- Turma GPE -->
                                    <div class="input-field col s12">
                                        <select name="turma_gpe_id" required="required">
                                            <option value="" disabled selected>Escolha uma opção</option>
                                            <?php
                                            $resultado = $servicosGpe->listarGpes();
                                            while ($linha = mysqli_fetch_assoc($resultado)) {
                                            ?>
                                                <option value="<?php echo $linha["gpe_id"] ?>"><?php echo $linha["gpe_id"] ?> - <?php echo $linha["gpe_nome"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label>GPE</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field left">
                                        <a href="index_turma.php" class="btn waves-effect waves-light blue">Voltar
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