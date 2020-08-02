<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosUsuario.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosUsuario = new ServicosUsuario();
    ?>

    <?php
    $linha = mysqli_fetch_assoc($servicosUsuario->listarUsuariosPorId($_GET["id"]));
    
    if (isset($_POST["usuario_nome"])) {
        if ($servicosUsuario->alterarUsuario($_GET["id"], $_POST["usuario_nome"], $_POST["usuario_senha"], $_POST["usuario_perfil"])) {
            header("location:index_usuario.php");
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
                        <form action="alterar_usuario.php?id=<?php echo $linha["usuario_id"] ?>" method="post">
                            <div class="form-elements">
                                <h4 class="grey-text text-darken-3" style="margin: 50px 0px 50px 0px">Alterar Usuario</h4>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input value="<?php echo $linha["usuario_nome"] ?>" name="usuario_nome" type="text" maxlength="45" class="validate" required>
                                        <label for="usuario_nome">Usuario</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input value="<?php echo $linha["usuario_senha"] ?>" name="usuario_senha" type="password" maxlength="45" class="validate" required>
                                        <label for="usuario_senha">Senha</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <select name="usuario_perfil" required="required">
                                            <option value="<?php echo $linha["usuario_perfil"] ?>" selected><?php echo $linha["usuario_perfil"] ?></option>
                                            <option value="Administrador">Administrador</option>
                                            <option value="GPE">GPE</option>
                                            <option value="Convidado">Convidado</option>
                                        </select>
                                        <label for="usuario_perfil">Perfil</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field left">
                                        <a href="index_usuario.php" class="btn waves-effect waves-light blue">Voltar
                                            <i class="material-icons left">keyboard_backspace</i>
                                        </a>
                                    </div>
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