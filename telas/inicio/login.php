<!-- Tela de Login -->

<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosUsuario.php"); ?>
<?php session_start(); ?>

<?php
$servicosUsuario = new ServicosUsuario();
?>

<?php
// Recebe os dados do formulário de login, chama a função logar() e direcionar o usuário para a tela Dashboard ou exibir uma mensagem de erro.
// A função logar() irá verificar as credenciais do usuario. Caso os dados existam no banco, a sessão é iniciada com os dados do usuário e a função retorna true. Caso contrário, a função retorna false.
if (isset($_POST["username"], $_POST["password"])) {
    require_once("../../servicos/ServicosUsuario.php");
    if ($servicosUsuario->logar($_POST["username"], $_POST["password"])) {
        header("location:../paginas_projeto/dashboard.php");
    } else {
        $mensagem = "Usuário ou senha inválidos";
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
    <header>
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper blue">
                    <a href="#" class="brand-logo center" style="font-weight: bold;">PFC Manager</a>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col s12 m8 offset-m2 l4 offset-l4">
                    <div class="card">
                        <div class="card-image">
                            <img src="../../img/senai_cimatec_2000x1200.jpg">
                            <span class="card-title">Login</span>
                        </div>
                        <div class="card-content">
                            <form method="post">
                                <div class="row">

                                    <!-- Usuário -->
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="icon_prefix" type="text" name="username" maxlength="45" required>
                                        <label for="icon_prefix">Usuário*</label>
                                    </div>

                                    <!-- Senha -->
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">lock</i>
                                        <input id="icon_telephone" type="password" name="password" maxlength="45" required>
                                        <label for="icon_telephone">Senha*</label>
                                    </div>

                                    <!-- Botão -->
                                    <div class="input-field col s12 center">
                                        <button style="width:72%" class="btn waves-effect waves-light blue" type="submit">Entrar</button>
                                    </div>

                                    <!-- Recuperar Senha -->
                                    <div class="input-field col s12 center">
                                        <a href="#">
                                            <p>Esqueceu sua senha?</p>
                                        </a>
                                    </div>
                                </div>
                            </form>
                            
                            <div class="card-action">
                                <div class="row">

                                    <!-- Documentação -->
                                    <div class="col s12 center">
                                        <a href="https://1drv.ms/w/s!AnUW08D6QIPEipJ71QRKFfhYTJCWxg?e=xbGYgW" target="blank">Documentação</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <?php include_once("../compartilhado/footer.php"); ?>
</body>

</html>