<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosProjeto.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

    <?php
    $servicosProjeto = new ServicosProjeto();
    ?>

    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <?php include_once("../compartilhado/head.php"); ?>
        <style>
            #quadro {
                min-width: 120%;
            }

            @media screen and (max-width: 670px) {
                #quadro {
                    min-width: 100%;
                }
            }
        </style>
    </head>

    <body>
        <?php include_once("../compartilhado/header.php"); ?>
        <main>
            <h3 class="light-blue-text text-darken-3" style="margin-left: 5%;">Banco de Projetos

                <?php
                // Botão adicionar Área (Apenas Administrador e GPE)
                if (($_SESSION["usuario_perfil"]) == "Administrador" || ($_SESSION["usuario_perfil"]) == "GPE") {
                ?>
                    <a title="Adicionar Projeto" href="cadastro_projeto_reserva.php" class="btn-floating btn-large waves-effect waves-light blue right" style="margin-right: 5%;">
                        <i class="material-icons">add</i>
                    </a>
                <?php
                }
                ?>

            </h3>
            <div style="max-width: 100%; overflow-x: scroll;">

                <div id="" class="row">
                    <!-- alto risco -->
                    <div class="col s12 m6 l4">
                        <div class="card" style="max-height: 407px; min-height: 407px;">
                            <div class="card-content">
                                <span class="card-title center">Alto Risco</span>
                                <input type="text" name="" id="pesquisar">
                                <?php
                                $projetos_alto = $servicosProjeto->listarProjetosRiscoAlto();
                                while ($linha = mysqli_fetch_assoc($projetos_alto)) {
                                ?>
                                    <form action="reserva.php" method="post"></form>
                                    <ul class="collapsible">
                                        <li>
                                            <div class="collapsible-header">
                                                <i class="material-icons">menu</i>
                                                <a href="detalhes_projeto.php?id=<?php echo $linha["projeto_id"] ?>" title="Detalhes do Projeto"><?php echo $linha["projeto_nome"] ?></a>
                                                <span class="badge transparent"><a href="atribuir_equipe.php?id=<?php echo $linha["projeto_id"] ?>">Atribuir Equipe</a></span>
                                            </div>
                                            <div class="collapsible-body">
                                                <p><span class="truncate">Cliente: <a href="../paginas_cliente/detalhes_cliente.php?id=<?php echo $linha["cliente_id"] ?>"><?php echo $linha["cliente_nomefantasia"] ?></a></span>
                                                </p>
                                                <p>Tipo de Projeto: <?php echo $linha["projeto_tipo"] ?></p>
                                                <p>Tipo de Projeto Empresa: <?php echo $linha["projeto_empresa"] ?></p>
                                                <p>Tipo de Negócio: <?php echo $linha["projeto_negocio"] ?></p>
                                                <p>Macrotema: <?php echo $linha["projeto_macrotema"] ?></p>
                                                <p>Risco: <?php echo $linha["projeto_risco"] ?></p>
                                                <p>Retorno Financeiro: R$<?php echo $linha["projeto_retorno"] ?></p>
                                                <p><span class="truncate">Obs.: <?php echo $linha["projeto_observacao"] ?></span></p>
                                            </div>
                                        </li>
                                    </ul>
                                    </form>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l4">
                        <div class="card" style="max-height: 407px; min-height: 407px; overflow-y: scroll;">
                            <div class="card-content">
                                <span class="card-title center">Médio Risco</span><input type="text" name="" id="pesquisar">
                                <?php
                                $projetos_medio = $servicosProjeto->listarProjetosRiscoMedio();
                                while ($linha = mysqli_fetch_assoc($projetos_medio)) {
                                ?>
                                    <form action="reserva.php" method="post"></form>
                                    <ul class="collapsible">
                                        <li>
                                            <div class="collapsible-header">
                                                <i class="material-icons">menu</i>
                                                <a href="detalhes_projeto.php?id=<?php echo $linha["projeto_id"] ?>" title="Detalhes do Projeto"><?php echo $linha["projeto_nome"] ?></a>
                                                <span class="badge transparent"><a href="atribuir_equipe.php?id=<?php echo $linha["projeto_id"] ?>">Atribuir Equipe</a></span>
                                            </div>
                                            <div class="collapsible-body">
                                                <p>Cliente: <a href="../paginas_cliente/detalhes_cliente.php?id=<?php echo $linha["cliente_id"] ?>"><?php echo $linha["cliente_nomefantasia"] ?></a></p>
                                                <p>Tipo de Projeto: <?php echo $linha["projeto_tipo"] ?></p>
                                                <p>Tipo de Projeto Empresa: <?php echo $linha["projeto_empresa"] ?></p>
                                                <p>Tipo de NegÃ³cio: <?php echo $linha["projeto_negocio"] ?></p>
                                                <p>Macrotema: <?php echo $linha["projeto_macrotema"] ?></p>
                                                <p>Risco: <?php echo $linha["projeto_risco"] ?></p>
                                                <p>Retorno Financeiro: R$<?php echo $linha["projeto_retorno"] ?></p>
                                                <p><span class="truncate">Obs.: <?php echo $linha["projeto_observacao"] ?></span></p>
                                            </div>
                                        </li>
                                    </ul>
                                    </form>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l4">
                        <div class="card" style="max-height: 407px; min-height: 407px; overflow-y: scroll;">
                            <div class="card-content">
                                <span class="card-title center">Baixo Risco</span>
                                <input type="text" name="" id="pesquisar">
                                <?php
                                $projetos_baixo = $servicosProjeto->listarProjetosRiscoBaixo();
                                while ($linha = mysqli_fetch_assoc($projetos_baixo)) {
                                ?>
                                    <form action="reserva.php" method="post"></form>
                                    <ul class="collapsible">
                                        <li>
                                            <div class="collapsible-header">
                                                <i class="material-icons">menu</i>
                                                <a href="detalhes_projeto.php?id=<?php echo $linha["projeto_id"] ?>" title="Detalhes do Projeto"><?php echo $linha["projeto_nome"] ?></a>
                                                <span class="badge transparent"><a href="atribuir_equipe.php?id=<?php echo $linha["projeto_id"] ?>">Atribuir Equipe</a></span>
                                            </div>
                                            <div class="collapsible-body">
                                                <p>Cliente: <a href="../paginas_cliente/detalhes_cliente.php?id=<?php echo $linha["cliente_id"] ?>"><?php echo  $linha["cliente_nomefantasia"] ?></a></p>
                                                <p>Tipo de Projeto: <?php echo  $linha["projeto_tipo"] ?></p>
                                                <p>Tipo de Projeto Empresa: <?php echo  $linha["projeto_empresa"] ?></p>
                                                <p>Tipo de Negócio: <?php echo  $linha["projeto_negocio"] ?></p>
                                                <p>Macrotema: <?php echo  $linha["projeto_macrotema"] ?></p>
                                                <p>Risco: <?php echo  $linha["projeto_risco"] ?></p>
                                                <p>Retorno Financeiro: R$<?php echo  $linha["projeto_retorno"] ?></p>
                                                <p><span class="truncate">Obs.: <?php echo  $linha["projeto_observacao"] ?></span></p>
                                            </div>
                                        </li>
                                    </ul>
                                    </form>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php include_once("../compartilhado/footer.php"); ?>
        <script src="../compartilhado/script.js"></script>
        <script>
            $(document).ready(function() {
                $('.modal').modal();
            });
        </script>
    </body>

    </html>

<?php
} else {
    header("location:../inicio/login.php");
}
?>