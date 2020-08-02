<?php require_once("../../banco/conexao.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $id_proj = $_GET["id"];
    //Select para Concluídos
    $select_projeto_observacao = "SELECT projeto_observacao ";
    $select_projeto_observacao .= "FROM projetos ";    
    $select_projeto_observacao .= "WHERE projeto_id = {$id_proj};";
    $result_projeto_observacao = mysqli_query($conexao, $select_projeto_observacao);
    if (!$result_projeto_observacao) {
        die("Erro na consulta ao banco " . mysqli_errno($conexao));
    }
    $linha = mysqli_fetch_assoc($result_projeto_observacao);

    if (isset($_POST["observacao"])) {

        $id_proj = $_GET["id"];
        $observacao = $_POST["observacao"];
        $update_projeto_observacao = "UPDATE projetos ";
        $update_projeto_observacao .= "SET projeto_observacao = '$observacao' ";
        $update_projeto_observacao .= "WHERE projeto_id = {$id_proj} ";
        echo $update_projeto_observacao;

        $executar_update = mysqli_query($conexao, $update_projeto_observacao);
        if (!$executar_update) {
            die("Erro no update");
        } else {
            header("location:gestao.php");
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
                <form action="alterar_observacao.php?id=<?php echo $id_proj ?>" method="POST">
                    <div class="modal-content">
                        <h4>Cancelar Projeto</h4>
                        <div class="input-field">
                            <textarea name="observacao" class="materialize-textarea" data-length="200"><?php echo $linha["projeto_observacao"] ?></textarea>
                            <label for="observacao">Insira o motivo do cancelamento</label>
                        </div>
                    </div>
                    <div class="input-field center">
                        <button class="btn waves-effect waves-light blue" type="submit" name="action">Salvar Observação</button>
                    </div>
                </form>
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