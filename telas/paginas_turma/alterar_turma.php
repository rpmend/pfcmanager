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
    $linha = mysqli_fetch_assoc($servicosTurma->listarTurmaPorId($_GET["id"]));

    if (isset($_POST["turma_codigo"])) {
        if ($servicosTurma->alterarTurma($_POST["turma_codigo"], $_POST["turma_turno"], $_POST["turma_curso_id"], $_POST["turma_orientador_id"], $_POST["turma_gpe_id"], $_GET["id"])) {
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
                        <form action="alterar_turma.php?id=<?php echo $linha["turma_id"] ?>" method="post">
                            <div class="form-elements">
                                <h4 class="grey-text text-darken-3" style="margin: 50px 0px 50px 0px">Alterar Turma</h4>
                                <div class="row">

                                    <!-- Turma Código -->
                                    <div class="input-field col s12">
                                        <input value="<?php echo $linha["turma_codigo"] ?>" maxlength="45" name="turma_codigo" type="text" class="validate" required>
                                        <label for="turma_codigo">Código</label>
                                    </div>

                                    <!-- Turma Turno -->
                                    <div class="input-field col s12">
                                        <select name="turma_turno" required="required">
                                            <option value="<?php echo $linha["turma_turno"] ?>"><?php echo $linha["turma_turno"] ?></option>
                                            <option value="Matutino">Matutino</option>
                                            <option value="Vespertino">Vespertino</option>
                                            <option value="Noturno">Noturno</option>
                                        </select>
                                        <label for="turma_turno">Turno</label>
                                    </div>

                                    <!-- Turma Curso -->
                                    <div class="input-field col s12">
                                        <select name="turma_curso_id" required="required">
                                            <option value="<?php echo $linha["turma_curso_id"] ?>"><?php echo $linha["curso_nome"] ?></option>
                                            <?php
                                            $resultado = $servicosCurso->listarCursos();
                                            while ($linha_curso = mysqli_fetch_assoc($resultado)) {
                                            ?>
                                                <option value="<?php echo $linha_curso["curso_id"] ?>"><?php echo $linha_curso["curso_id"] ?> - <?php echo $linha_curso["curso_nome"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label>Curso</label>
                                    </div>

                                    <!-- Turma Orientador -->
                                    <div class="input-field col s12">
                                        <select name="turma_orientador_id" required="required">
                                            <option value="<?php echo $linha["turma_orientador_id"] ?>"><?php echo $linha["orientador_nome"] ?></option>
                                            <?php
                                            $resultado = $servicosOrientador->listarOrientadores();
                                            while ($linha_orientador = mysqli_fetch_assoc($resultado)) {
                                            ?>
                                                <option value="<?php echo $linha_orientador["orientador_id"] ?>"><?php echo $linha_orientador["orientador_id"] ?> - <?php echo $linha_orientador["orientador_nome"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label>Orientador</label>
                                    </div>

                                    <!-- Turma GPE -->
                                    <div class="input-field col s12">
                                        <select name="turma_gpe_id" required="required">
                                            <option value="<?php echo $linha["turma_gpe_id"] ?>"><?php echo $linha["gpe_nome"] ?></option>
                                            <?php
                                            $resultado = $servicosGpe->listarGpes();
                                            while ($linha_gpe = mysqli_fetch_assoc($resultado)) {
                                            ?>
                                                <option value="<?php echo $linha_gpe["gpe_id"] ?>"><?php echo $linha_gpe["gpe_id"] ?> - <?php echo $linha_gpe["gpe_nome"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label>GPE</label>
                                    </div>


                                </div>

                                <!-- Botões -->
                                <div class="row">

                                    <!-- Botão Voltar -->
                                    <div class="input-field left">
                                        <a href="index_turma.php" class="btn waves-effect waves-light blue">Voltar
                                            <i class="material-icons left">keyboard_backspace</i>
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