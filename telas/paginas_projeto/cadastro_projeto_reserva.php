<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosProjeto.php"); ?>
<?php require_once("../../servicos/ServicosCliente.php"); ?>
<?php require_once("../../servicos/ServicosEquipe.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosProjeto = new ServicosProjeto();
    $servicosEquipe = new ServicosEquipe();
    $servicosCliente = new ServicosCliente();
    ?>

    <?php
    if (isset($_POST["projeto_nome"])) {
        if ($servicosProjeto->cadastrarProjeto($_POST["projeto_nome"], $_POST["projeto_tipo"], $_POST["projeto_empresa"], $_POST["projeto_negocio"], $_POST["projeto_macrotema"], $_POST["projeto_risco"], $_POST["projeto_retorno"], $_POST["projeto_observacao"], $_POST["projeto_cliente_id"])) {
            header("location:reserva.php");
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
                                <h3 class="light-blue-text text-darken-3">Cadastrar Projeto</h3>

                                <!-- Nome do Projeto -->
                                <div class="input-field" required="required">
                                    <input name="projeto_nome" type="text" maxlength="45" class="validate" required>
                                    <label for="projeto_nome">Título do Projeto</label>
                                </div>   
                                
                                <!-- Cliente -->
                                <div class="input-field">
                                    <select name="projeto_cliente_id" required="required">
                                        <option value="" disabled selected>Escolha uma opção</option>
                                        <?php
                                        $resultado = $servicosCliente->listarClientes();
                                        while ($linha = mysqli_fetch_assoc($resultado)) {
                                        ?>
                                            <option value="<?php echo $linha["cliente_id"] ?>"><?php echo $linha["cliente_nomefantasia"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label>Cliente</label>
                                </div>

                                <!-- Tipo de Projeto -->
                                <div class="input-field">
                                    <select name="projeto_tipo" required="required">
                                        <option value="" disabled selected>Escolha uma opção</option>
                                        <option value="Interno">Interno</option>
                                        <option value="Externo">Externo</option>
                                        <option value="Ecossistema">Ecossistema</option>
                                    </select>
                                    <label for="projeto_tipo">Tipo de Projeto</label>
                                </div>

                                <!-- Tipo de Projeto Empresa -->
                                <div class="input-field">
                                    <select name="projeto_empresa" required="required">
                                        <option value="" disabled selected>Escolha uma opção</option>
                                        <option value="Pesquisa">Pesquisa</option>
                                        <option value="Projeto">Projeto</option>
                                        <option value="Desenvolvimento de Produto">Desenvolvimento de Produto</option>
                                        <option value="Processo">Processo</option>
                                    </select>
                                    <label for="projeto_empresa">Tipo de Projeto Empresa</label>
                                </div>

                                <!-- Tipo de Negócio -->
                                <div class="input-field">
                                    <select name="projeto_negocio" required="required">
                                        <option value="" disabled selected>Escolha uma opção</option>
                                        <option value="Escola Técnica">Escola Técnica</option>
                                        <option value="Serviços Técnicos">Serviços Técnicos</option>
                                        <option value="Centro Universitário">Centro Universitário</option>
                                        <option value="P&D&I">P&D&I</option>
                                        <option value="Comércio">Comércio</option>
                                        <option value="Indústria">Indústria</option>
                                        <option value="Social">Social</option>
                                        <option value="Cimatec">Cimatec</option>
                                        <option value="Cimatec Park">Cimatec Park</option>
                                    </select>
                                    <label for="projeto_negocio">Tipo de Negócio</label>
                                </div>

                                <!-- Macrotema -->
                                <div class="input-field">
                                    <select name="projeto_macrotema" required="required">
                                        <option value="" disabled selected>Escolha uma opção</option>
                                        <option value="Escola Técnica">Sustentabilidade</option>
                                        <option value="Serviços Técnicos">Inovação de Produto</option>
                                        <option value="Serviços Técnicos">Inovação de Processo</option>
                                        <option value="Centro Universitário">Otimização de Processo</option>
                                        <option value="P&D&I">Automatização Tecnologica</option>
                                        <option value="Comércio">Responsabilidade Social</option>
                                        <option value="Indústria">Construção de Protótipos</option>
                                        <option value="Social">Desenvolvimento de Ferramentas</option>
                                        <option value="Cimatec">Plantas e Modelagens</option>
                                        <option value="Cimatec Park">Manutenção</option>
                                    </select>
                                    <label for="projeto_macrotema">Macrotema</label>
                                </div>

                                <!-- Retorno Financeiro -->
                                <div class="input-field">
                                    <input name="projeto_retorno" type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==8) return false;" step=".01" class="validate" required="required"></input>
                                    <label for="projeto_retorno">Retorno Financeiro (ex.: 2500.00)</label>
                                </div>

                                <!-- Risco -->
                                <div class="input-field">
                                    <select name="projeto_risco" required="required">
                                        <option value="" disabled selected>Escolha uma opção</option>
                                        <option value="Baixo">Baixo</option>
                                        <option value="Médio">Médio</option>
                                        <option value="Alto">Alto</option>
                                    </select>
                                    <label for="projeto_risco">Risco</label>
                                </div>

                                <!-- Observação -->
                                <div class="input-field">
                                    <input name="projeto_observacao" type="text" class="validate" required="required"></input>
                                    <label for="projeto_observacao">Observação</label>
                                </div>

                                <!-- Botões -->
                                <div class="row">
                                    <div class="input-field left">
                                        <a href="reserva.php" class="btn waves-effect waves-light blue">Voltar<i class="material-icons left">keyboard_backspace</i></a>
                                    </div>
                                    <div class="input-field right">
                                        <button class="btn waves-effect waves-light blue" type="submit">Cadastrar<i class="material-icons right">done</i></button>
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