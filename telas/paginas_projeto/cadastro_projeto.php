<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosProjeto.php"); ?>
<?php require_once("../../servicos/ServicosCliente.php"); ?>
<?php require_once("../../servicos/ServicosEquipe.php"); ?>
<?php require_once("../../servicos/ServicosBanca.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosProjeto = new ServicosProjeto();
    $servicosEquipe = new ServicosEquipe();
    $servicosCliente = new ServicosCliente();
    $servicosBanca = new ServicosBanca();
    ?>

    <?php
    if (isset($_POST["projeto_nome"])) {
        if ($servicosProjeto->cadastrarProjetoCompleto($_POST["projeto_nome"], $_POST["projeto_tipo"], $_POST["projeto_empresa"], $_POST["projeto_negocio"], $_POST["projeto_macrotema"], $_POST["projeto_risco"], $_POST["projeto_retorno"], $_POST["projeto_status"], $_POST["projeto_semestre"], $_POST["projeto_entregavel1"], $_POST["projeto_status1"], $_POST["projeto_entregavel2"], $_POST["projeto_status2"], $_POST["projeto_entregavel3"], $_POST["projeto_status3"], $_POST["projeto_observacao"], $_POST["projeto_motivocancelamento"], $_POST["projeto_equipe_id"], $_POST["projeto_cliente_id"])) {
            header("location:index_projeto.php");
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
                        <form action="cadastro_projeto.php" method="post">
                            <div class="form-elements">
                                <h3 class="light-blue-text text-darken-3">Cadastrar Projeto</h3>
                                <p class="red-text">Atenção! Apenas utilize esta página caso esteja cadastrando um projeto que já foi concluído no passado)!</p>

                                <!-- Projeto Nome -->
                                <div class="input-field">
                                    <input name="projeto_nome" type="text" maxlength="45" class="validate" required>
                                    <label for="projeto_nome">Título do Projeto</label>
                                </div>

                                <!-- Projeto Equipe -->
                                <div class="input-field">
                                    <select name="projeto_equipe_id" required="required">
                                        <option value="" disabled selected>Escolha uma opção</option>
                                        <?php
                                        $resultado = $servicosEquipe->listarEquipesSemProjeto();
                                        while ($linha_equipe = mysqli_fetch_assoc($resultado)) {
                                        ?>
                                            <option value="<?php echo $linha_equipe["equipe_id"] ?>"><?php echo "Equipe de " . $linha_equipe["equipe_gestor"] . " (GP)" ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label>Equipe</label>
                                </div>

                                <!-- Projeto Cliente  -->
                                <div class="input-field">
                                    <select name="projeto_cliente_id" required="required">
                                        <option value="" disabled selected>Escolha uma opção</option>
                                        <?php
                                        $resultado = $servicosCliente->listarClientes();
                                        while ($linha_cliente = mysqli_fetch_assoc($resultado)) {
                                        ?>
                                            <option value="<?php echo $linha_cliente["cliente_id"] ?>"><?php echo $linha_cliente["cliente_nomefantasia"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label>Cliente</label>
                                </div>

                                <!-- Tipo de Projeto -->
                                <div class="input-field">
                                    <select name="projeto_tipo" required="required">
                                        <option value="">Escolha uma opção</option>
                                        <option value="Interno">Interno</option>
                                        <option value="Externo">Externo</option>
                                        <option value="Ecossistema">Ecossistema</option>
                                    </select>
                                    <label for="projeto_tipo">Tipo de Projeto</label>
                                </div>

                                <!-- Tipo de Projeto Empresa -->
                                <div class="input-field">
                                    <select name="projeto_empresa" required="required">
                                        <option value=" " disabled selected>Escolha uma opção</option>
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
                                        <option value=" " disabled selected>Escolha uma opção</option>
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
                                        <option value=" " disabled selected>Escolha uma opção</option>
                                        <option value="Sustentabilidade">Sustentabilidade</option>
                                        <option value="Inovação de Produto">Inovação de Produto</option>
                                        <option value="Serviços Técnicos">Inovação de Processo</option>
                                        <option value="Inovação de Processo">Otimização de Processo</option>
                                        <option value="Otimização de Processo">Automatização Tecnologica</option>
                                        <option value="Responsabilidade Social">Responsabilidade Social</option>
                                        <option value="Construção de Protótipos">Construção de Protótipos</option>
                                        <option value="Desenvolvimento de Ferramentas">Desenvolvimento de Ferramentas</option>
                                        <option value="Plantas e Modelagens">Plantas e Modelagens</option>
                                        <option value="Manutenção">Manutenção</option>
                                    </select>
                                    <label for="projeto_macrotema">Macrotema</label>
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

                                <!-- Projeto Retorno Financeiro -->
                                <div class="input-field" required>
                                    <input name="projeto_retorno" type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==8) return false;" step=".01" class="validate" required="required"></input>
                                    <label for="projeto_retorno">Retorno Financeiro (ex.: 2500.00)</label>
                                </div>

                                <!-- Projeto Status -->
                                <div class="input-field">
                                    <select name="projeto_status" required="required">
                                        <!-- <option value="" disabled selected>Escolha uma opção</option> -->
                                        <!-- <option value="0">RESERVA</option> -->
                                        <!-- <option value="1">NAO INICIADO</option> -->
                                        <option value="2">EM ANDAMENTO</option>
                                        <!-- <option value="3">CONCLUÍDO</option> -->
                                        <!-- <option value="4">CANCELADO</option> -->
                                    </select>
                                    <label for="projeto_status">Status</label>
                                </div>

                                <!-- Projeto Semestre -->
                                <div class="input-field">
                                    <input name="projeto_semestre" type="number" class="validate" min="2015" max="2030" step=".1" required></input>
                                    <label for="projeto_semestre">Semestre (Ex.: 2020.1)</label>
                                </div>

                                <!-- Entregável 1 -->
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input name="projeto_entregavel1" type="date" class="datepicker" required>
                                        <label for="projeto_entregavel1">Data do entregável 1</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <select name="projeto_status1" required="required">
                                            <option value="" disabled selected>Escolha uma opção</option>
                                            <option value="0">PENDENTE</option>
                                            <option value="1">ENTREGUE</option>
                                        </select>
                                        <label for="projeto_status1">Situação do entregável 1</label>
                                    </div>
                                </div>

                                <!-- Entregável 2 -->
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input name="projeto_entregavel2" type="date" class="datepicker" required>
                                        <label for="projeto_entregavel2">Data do entregável 2</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <select name="projeto_status2" required="required">
                                            <option value="" disabled selected>Escolha uma opção</option>
                                            <option value="0">PENDENTE</option>
                                            <option value="1">ENTREGUE</option>
                                        </select>
                                        <label for="projeto_status2">Situação do entregável 2</label>
                                    </div>
                                </div>

                                <!-- Entregável 3 -->
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input name="projeto_entregavel3" type="date" class="datepicker" required>
                                        <label for="projeto_entregavel3">Data do entregável 3</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <select name="projeto_status3" required="required">
                                            <option value="" disabled selected>Escolha uma opção</option>
                                            <option value="0">PENDENTE</option>
                                            <option value="1">ENTREGUE</option>
                                        </select>
                                        <label for="projeto_status3">Situação do entregável 3</label>
                                    </div>
                                </div>

                                <!-- Observação -->
                                <div class="input-field">
                                    <input name="projeto_observacao" type="text" maxlength="1000" class="validate" required></input>
                                    <label for="projeto_observacao">Observação</label>
                                </div>

                                <!-- Motivo do Cancelamento -->
                                <div class="input-field">
                                    <input name="projeto_motivocancelamento" maxlength="1000" type="text" class="validate"></input>
                                    <label for="projeto_motivocancelamento">Motivo de cancelamento</label>
                                </div>

                                <!-- Botões -->
                                <div class="row">

                                    <!-- Botão Voltar -->
                                    <div class="input-field left">
                                        <a href="reserva.php" class="btn waves-effect waves-light blue">Voltar<i class="material-icons left">keyboard_backspace</i></a>
                                    </div>

                                    <!-- Botão Cadastrar -->
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
                $("select[required]").css({
                    display: "block",
                    height: 0,
                    padding: 0,
                    width: 0,
                    position: 'absolute'
                });
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