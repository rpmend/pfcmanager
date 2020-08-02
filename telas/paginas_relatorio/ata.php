<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosBanca.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosBanca = new ServicosBanca();
    ?>

    <?php
    if (isset($_POST["banca"])) {
        $resultado = $servicosBanca->listarBancasPorId($_POST["banca"]);
        $linha = mysqli_fetch_assoc($resultado);

        $data = $linha["banca_data"];
        $local = $linha["banca_local"];
        $coordenador = $linha["coordenador_nome"];
        $curso = $linha["curso_nome"];
        $turma = $linha["turma_codigo"];
        $orientador = $linha["orientador_nome"];
        $gpe = $linha["gpe_nome"];
        $convidado1 = $linha["banca_convidado1"];
        $convidado2 = $linha["banca_convidado2"];
        $projeto = $linha["projeto_nome"];
        $nota = $linha["equipe_nota"];
        $gestor = $linha["equipe_gestor"];
        $membro1 = $linha["equipe_membro1"];
        $membro2 = $linha["equipe_membro2"];
        $membro3 = $linha["equipe_membro3"];
        $membro4 = $linha["equipe_membro4"];
        $membro5 = $linha["equipe_membro5"];
    }
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
                <h3 class="center"><img class="left" src="../../img/logo-senai.png" height="80px" alt="Logo Senai - CIMATEC">ATA DA BANCA AVALIADORA</h3>
                <br><br>
                <p>
                    Aos <?php echo date("d/m/Y", strtotime($data)) ?>, no <?php echo $local ?>
                    reuniu-se a comissão formada por <?php echo $coordenador ?> – Coordenador(a) do Curso <?php echo $curso ?>, <?php echo $gpe ?> – Gestor(a) de Projetos Educacionais,
                    <?php echo $orientador ?> – Orientador(a) Técnico e <?php echo $convidado1 ?> –
                    convidado(a) para examinar os projetos elaborados pelos discentes da turma <?php echo $turma ?> do
                    curso <?php echo $curso ?>, conforme descrito na tabela abaixo:
                </p>

                <table>
                    <thead>
                        <tr>
                            <th>Projeto</th>
                            <th>Discentes</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><?php echo $projeto ?></td>
                            <td>
                                <?php echo $gestor ?>
                                <br>
                                <?php echo $membro1 ?>
                                <br>
                                <?php echo $membro2 ?>
                                <br>
                                <?php echo $membro3 ?>
                                <br>
                                <?php if ($membro4 != "") { ?>
                                    <?php echo $membro4 ?>
                                    <br>
                                <?php }
                                if ($membro5 != "") { ?>
                                    <?php echo $membro5 ?>
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p>
                    Dando início à solenidade, o(a) Gestor(a) de Projetos Educacionais <?php echo $gpe ?> apresentou a
                    banca examinadora e em seguida passou a palavra para os discentes apresentarem os
                    respectivos projetos. Em seguida, passou então a comissão a proceder à avaliação e
                    julgamento dos referidos projetos, concluindo por atribuir-lhes os resultados conforme
                    descrito abaixo:
                </p>

                <table>
                    <thead>
                        <tr>
                            <th>Projeto</th>
                            <th>Resultado</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><?php echo $projeto ?></td>
                            <td>
                                Média final, com restrição*:
                                <br>
                                <?php echo $gestor ?> - <?php echo $nota ?>
                                <br>
                                <?php echo $membro1 ?> - <?php echo $nota ?>
                                <br>
                                <?php echo $membro2 ?> - <?php echo $nota ?>
                                <br>
                                <?php echo $membro3 ?> - <?php echo $nota ?>
                                <br>
                                <?php if ($membro4 != "") { ?>
                                    <?php echo $membro4 ?> - <?php echo $nota ?>
                                    <br>
                                <?php }
                                if ($membro5 != "") { ?>
                                    <?php echo $membro5 ?> - <?php echo $nota ?>
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p><sub>
                        *A restrição da nota consiste na entrega da documentação e correções no material (quando solicitadas
                        pela
                        banca). Pendências informadas na tabela em anexo.
                    </sub></p>
                <br>
                <p>
                    Nada mais havendo a declarar, a Gestora de Projetos Educacionais deu por encerrada a sessão.
                </p>
                <br><br>

                <div class="row">
                    <div class="col s12 m6">
                        <p>
                            _____________________________________________________ <br>
                            Coordenador(a)
                        </p>
                    </div>
                    <div class="col s12 m6">
                        <p>
                            _____________________________________________________ <br>
                            Gestora Projetos Educacionais(a)
                        </p>
                    </div>
                    <div class="col s12 m6">
                        <p>
                            _____________________________________________________ <br>
                            Orientador(a) Técnico
                        </p>
                    </div>
                    <div class="col s12 m6">
                        <p>
                            _____________________________________________________ <br>
                            Convidado(a)
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        <!-- Botões -->
                        <div class="row">

                            <!-- Voltar -->
                            <div class="input-field left">
                                <a href="relatorios.php" class="btn waves-effect waves-light blue">Voltar<i class="material-icons right">keyboard_backspace</i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
        <?php include_once("../compartilhado/footer.php"); ?>
        <script src="../script.js"></script>
    </body>

    </html>

<?php
} else {
    header("location:login.php");
}
?>