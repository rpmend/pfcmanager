<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosBanca.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosBanca = new ServicosBanca();
    ?>

    <!-- início do HTML -->

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
                        <form method="POST" action="ata.php">
                            <div class="form-elements">

                                <!-- Título -->
                                <h3 class="light-blue-text text-darken-3">Ata</h3>

                                <!-- Banca -->
                                <div class="input-field col s12">
                                    <select name="banca">
                                        <option value="">Escolha uma opção</option>
                                        <?php
                                        $resultado = $servicosBanca->listarBancas();
                                        while ($linha = mysqli_fetch_assoc($resultado)) {
                                        ?>
                                            <option value="<?php echo $linha["banca_id"] ?>"><?php echo $linha["projeto_nome"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label>Banca</label>
                                </div>

                                <!-- Botões -->
                                <div class="row">
                                    <div class="input-field left">
                                        <a href="relatorios.php" class="btn waves-effect waves-light blue">Voltar<i class="material-icons right">keyboard_backspace</i></a>
                                    </div>
                                    <div class="input-field right">
                                        <button class="btn waves-effect waves-light blue" type="submit">Gerar<i class="material-icons right">done</i></button>
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
                $('.timepicker').timepicker();
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
    header("location:login.php");
}
?>