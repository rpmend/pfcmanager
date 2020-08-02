<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosCurso.php"); ?>
<?php require_once("../../servicos/ServicosArea.php"); ?>
<?php require_once("../../servicos/ServicosCoordenador.php"); ?>

<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosCurso = new ServicosCurso();
    $servicosArea = new ServicosArea();
    $servicosCoordenador = new ServicosCoordenador();
    ?>

    <?php
    $linha = mysqli_fetch_assoc($servicosCurso->listarCursosPorId($_GET["id"]));

    if (isset($_POST["curso_nome"])) {
        if ($servicosCurso->alterarCurso($_GET["id"], $_POST["curso_nome"], $_POST["curso_area_id"], $_POST["curso_coordenador_id"])) {
            header("location:index_curso.php");
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

                    <!-- Formulário -->
                    <div class="col s12 m6">
                        <form action="alterar_curso.php?id=<?php echo $linha["curso_id"] ?>" method="post">
                            <div class="form-elements">
                                <h4 class="grey-text text-darken-3" style="margin: 50px 0px 50px 0px">Alterar Curso</h4>
                                <div class="row">

                                    <!-- Curso Nome -->
                                    <div class="input-field col s12">
                                        <input name="curso_nome" maxlength="45" value="<?php echo $linha["curso_nome"] ?>" type="text" class="validate" required>
                                        <label for="curso_nome">Curso</label>
                                    </div>

                                    <!-- Curso Área -->
                                    <div class="input-field col s12">
                                        <select name="curso_area_id" required="required">
                                            <option value="<?php echo $linha["area_id"] ?>"><?php echo $linha["area_nome"] ?></option>
                                            <?php
                                            $resultado = $servicosArea->listarAreas();
                                            while ($linha_area = mysqli_fetch_assoc($resultado)) {
                                            ?>
                                                <option value="<?php echo $linha_area["area_id"] ?>"><?php echo $linha_area["area_nome"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label>Area</label>
                                    </div>

                                    <!-- Curso Coordenador -->
                                    <div class="input-field col s12">
                                        <select name="curso_coordenador_id" required="required">
                                            <option value="<?php echo $linha["coordenador_id"] ?>"><?php echo $linha["coordenador_nome"] ?></option>
                                            <?php
                                            $resultado = $servicosCoordenador->listarCoordenadores();
                                            while ($linha_coordenador = mysqli_fetch_assoc($resultado)) {
                                            ?>
                                                <option value="<?php echo $linha_coordenador["coordenador_id"] ?>"><?php echo $linha_coordenador["coordenador_nome"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label>Coordenador</label>
                                    </div>
                                </div>

                                <!-- Botões -->
                                <div class="row">

                                    <!-- Botão Voltar -->
                                    <div class="input-field left">
                                        <a href="index_curso.php" class="btn waves-effect waves-light blue" type="submit" name="action">Voltar
                                            <i class="material-icons left">keyboard_backspace</i>
                                        </a>
                                    </div>

                                    <!-- Botão Alterar -->
                                    <div class="input-field right">
                                        <button class="btn waves-effect waves-light blue" type="submit" name="action">Alterar
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
            });
        </script>
    </body>

    </html>

<?php
} else {
    header("location:../inicio/login.php");
}
?>