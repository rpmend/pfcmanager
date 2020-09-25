<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosProjeto.php"); ?>
<?php require_once("../../servicos/ServicosCliente.php"); ?>
<?php require_once("../../servicos/ServicosTurma.php"); ?>
<?php require_once("../../servicos/ServicosCurso.php"); ?>
<?php require_once("../../servicos/ServicosArea.php"); ?>
<?php require_once("../../servicos/ServicosCoordenador.php"); ?>
<?php require_once("../../servicos/ServicosOrientador.php"); ?>
<?php require_once("../../servicos/ServicosGpe.php"); ?>

<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosProjeto = new ServicosProjeto();
    $servicosCliente = new ServicosCliente();
    $servicosTurma = new ServicosTurma();
    $servicosCurso = new ServicosCurso();
    $servicosArea = new ServicosArea();
    $servicosCoordenador = new ServicosCoordenador();
    $servicosOrientador = new ServicosOrientador();
    $servicosGpe = new ServicosGpe();
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
                    <div class="col s12">
                        <form method="post">
                            <div class="form-elements">
                                <h3 class="light-blue-text text-darken-3">Geral</h3>

                                <!-- Semestre -->
                                <div class="col s12">
                                    <div class="row">
                                        <div class="input-field col s12 m6">
                                            <i class="material-icons prefix">date_range</i>
                                            <input name="semestre_inicial" type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==5) return false;" step=".1" min="2015" max="2030" class="validate" required>
                                            <label for="semestre_inicial">Semestre inicial</label>
                                            <span class="helper-text" data-error="wrong" data-success="right">Insira o semestre inicial (ex: 2018.1)</span>
                                        </div>
                                        <div class="input-field col s12 m6">
                                            <i class="material-icons prefix">date_range</i>
                                            <input name="semestre_final" type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==5) return false;" step=".1" min="2015" max="2030" class="validate" required>
                                            <label for="semestre_final">Semestre final</label>
                                            <span class="helper-text" data-error="wrong" data-success="right">Insira o semestre final (ex: 2020.2)</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Clientes Combo Box -->
                                <div class="input-field col s12 m6">
                                    <select name="cliente" required="required">
                                        <option value="todos" selected>Todos</option>
                                        <?php
                                        $resultado_clientes = $servicosCliente->listarClientes();
                                        while ($linha_clientes = mysqli_fetch_assoc($resultado_clientes)) {
                                        ?>
                                            <option value="<?php echo $linha_clientes["cliente_nomefantasia"] ?>"><?php echo $linha_clientes["cliente_nomefantasia"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label>Selecione o Cliente</label>
                                </div>

                                <!-- Turmas Combo Box -->
                                <div class="input-field col s12 m6">
                                    <select name="turma" required="required">
                                        <option value="todos" selected>Todos</option>
                                        <?php
                                        $resultado_turmas = $servicosTurma->listarTurmas();
                                        while ($linha_turmas = mysqli_fetch_assoc($resultado_turmas)) {
                                        ?>
                                            <option value="<?php echo $linha_turmas["turma_codigo"] ?>"><?php echo $linha_turmas["turma_codigo"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label>Selecione a Turma</label>
                                </div>

                                <!-- Cursos Combo Box -->
                                <div class="input-field col s12 m6">
                                    <select name="curso" required="required">
                                        <option value="todos" selected>Todos</option>
                                        <?php
                                        $resultado_cursos = $servicosCurso->listarCursos();
                                        while ($linha_cursos = mysqli_fetch_assoc($resultado_cursos)) {
                                        ?>
                                            <option value="<?php echo $linha_cursos["curso_nome"] ?>"><?php echo $linha_cursos["curso_nome"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label>Selecione o Curso</label>
                                </div>

                                <!-- Areas Combo Box -->
                                <div class="input-field col s12 m6">
                                    <select name="area" required="required">
                                        <option value="todos" selected>Todos</option>
                                        <?php
                                        $resultado_areas = $servicosArea->listarAreas();
                                        while ($linha_areas = mysqli_fetch_assoc($resultado_areas)) {
                                        ?>
                                            <option value="<?php echo $linha_areas["area_nome"] ?>"><?php echo $linha_areas["area_nome"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label>Selecione a Área</label>
                                </div>

                                <!-- Coordenadores Combo Box -->
                                <div class="input-field col s12 m6">
                                    <select name="coordenador" required="required">
                                        <option value="todos" selected>Todos</option>
                                        <?php
                                        $resultado_coordenadores = $servicosCoordenador->listarCoordenadores();
                                        while ($linha_coordenadores = mysqli_fetch_assoc($resultado_coordenadores)) {
                                        ?>
                                            <option value="<?php echo $linha_coordenadores["coordenador_nome"] ?>"><?php echo $linha_coordenadores["coordenador_nome"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label>Selecione o Coordenador</label>
                                </div>

                                <!-- Orientadores Combo Box -->
                                <div class="input-field col s12 m6">
                                    <select name="orientador" required="required">
                                        <option value="todos" selected>Todos</option>
                                        <?php
                                        $resultado_orientadores = $servicosOrientador->listarOrientadores();
                                        while ($linha_orientadores = mysqli_fetch_assoc($resultado_orientadores)) {
                                        ?>
                                            <option value="<?php echo $linha_orientadores["orientador_nome"] ?>"><?php echo $linha_orientadores["orientador_nome"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label>Selecione o Orientador</label>
                                </div>

                                <!-- Gpes Combo Box -->
                                <div class="input-field col s12 m6">
                                    <select name="gpe" required="required">
                                        <option value="todos" selected>Todos</option>
                                        <?php
                                        $resultado_gpes = $servicosGpe->listarGpes();
                                        while ($linha_gpes = mysqli_fetch_assoc($resultado_gpes)) {
                                        ?>
                                            <option value="<?php echo $linha_gpes["gpe_nome"] ?>"><?php echo $linha_gpes["gpe_nome"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label>Selecione o Gpe</label>
                                </div>

                                <div class="col s12">
                                    <!-- Botões -->
                                    <div class="row">

                                        <!-- Voltar -->
                                        <div class="input-field left">
                                            <a href="relatorios.php" class="btn waves-effect waves-light blue">Voltar<i class="material-icons right">keyboard_backspace</i></a>
                                        </div>

                                        <div class="input-field right">
                                            <button class="btn waves-effect waves-light blue" type="submit">Gerar<i class="material-icons right">done</i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php
                if (isset($_POST["curso"])) {
                    $resultado_projetos = $servicosProjeto->listarProjetosPorGeral($_POST["cliente"], $_POST["turma"], $_POST["curso"], $_POST["area"], $_POST["coordenador"], $_POST["orientador"], $_POST["gpe"], $_POST["semestre_inicial"], $_POST["semestre_final"]);

                ?>
                    <!-- tabela projetos -->
                    <div class="table">
                        <table id="headerTable" class="striped">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Semestre</th>
                                    <th>Nome</th>
                                    <th>Cliente</th>
                                    <th>Equipe (GP)</th>
                                    <th>Tipo</th>
                                    <th>Tipo Empresa</th>
                                    <th>Tipo de Negócio</th>
                                    <th>Macrotema</th>
                                    <th>Risco</th>
                                    <th>Retorno Financeiro</th>
                                    <th>Entregável 1</th>
                                    <th>Entregável 2</th>
                                    <th>Entregável 3</th>
                                    <th>Observações</th>
                                    <th>Motivo de Cancelamento</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($linha_projetos = mysqli_fetch_assoc($resultado_projetos)) {
                                ?>
                                    <tr>

                                        <?php
                                        if ($linha_projetos["projeto_semestre"] = 0) {
                                        ?>
                                            <td>RESERVA</td>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($linha_projetos["projeto_semestre"] = 1) {
                                        ?>
                                            <td>NÃO INICIADO</td>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($linha_projetos["projeto_semestre"] = 2) {
                                        ?>
                                            <td>EM ANDAMENTO</td>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($linha_projetos["projeto_semestre"] = 3) {
                                        ?>
                                            <td>CONCLUÍDO</td>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($linha_projetos["projeto_semestre"] = 4) {
                                        ?>
                                            <td>CANCELADO</td>
                                        <?php
                                        }
                                        ?>

                                        <td><?php echo $linha_projetos["projeto_semestre"] ?></td>
                                        <td><?php echo $linha_projetos["projeto_nome"] ?></td>
                                        <td><?php echo $linha_projetos["cliente_razaosocial"] ?></td>
                                        <td><?php echo $linha_projetos["equipe_gestor"] ?></td>
                                        <td><?php echo $linha_projetos["projeto_tipo"] ?></td>
                                        <td><?php echo $linha_projetos["projeto_empresa"] ?></td>
                                        <td><?php echo $linha_projetos["projeto_negocio"] ?></td>
                                        <td><?php echo $linha_projetos["projeto_macrotema"] ?></td>
                                        <td><?php echo $linha_projetos["projeto_risco"] ?></td>
                                        <td><?php echo $linha_projetos["projeto_retorno"] ?></td>
                                        <td><?php echo $linha_projetos["projeto_entregavel1"] ?></td>
                                        <td><?php echo $linha_projetos["projeto_entregavel2"] ?></td>
                                        <td><?php echo $linha_projetos["projeto_entregavel3"] ?></td>
                                        <td><?php echo $linha_projetos["projeto_observacao"] ?></td>
                                        <td><?php echo $linha_projetos["projeto_motivocancelamento"] ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                }
                ?>
                <?php
                if (isset($_POST["curso"])) {
                ?>
                    <!-- Botão Exportar -->
                    <button id="btnExport" class="btn blue right" onclick="fnExcelReport();">Exportar para Excel</button>
                    <iframe id="txtArea1" style="display:none"></iframe>
                <?php
                }
                ?>
            </div>
        </main>
        <?php include_once("../compartilhado/footer.php"); ?>
        <script src="../compartilhado/script.js"></script>

        <!-- Exportar para XLS -->
        <script>
            function fnExcelReport() {
                var tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
                var textRange;
                var j = 0;
                tab = document.getElementById('headerTable'); // id of table

                for (j = 0; j < tab.rows.length; j++) {
                    tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
                    //tab_text=tab_text+"</tr>";
                }

                tab_text = tab_text + "</table>";
                tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
                tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
                tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

                var ua = window.navigator.userAgent;
                var msie = ua.indexOf("MSIE ");

                if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) // If Internet Explorer
                {
                    txtArea1.document.open("txt/html", "replace");
                    txtArea1.document.write(tab_text);
                    txtArea1.document.close();
                    txtArea1.focus();
                    sa = txtArea1.document.execCommand("SaveAs", true, "Say Thanks to Sumit.xls");
                } else //other browser not tested on IE 11
                    sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

                return (sa);
            }
        </script>
    </body>

    </html>

<?php
} else {
    header("location:../inicio/login.php");
}
?>