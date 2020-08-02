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
        <main style="padding-top: 20px;">
            <div style="max-width: 100%; overflow-x: scroll;">
                <div id="quadro" class="row">

                    <!-- Não Iniciados -->
                    <div class="col s12 m6 l3">
                        <div class="card" style="max-height: 481px; min-height: 481px; overflow-y: scroll;">
                            <div class="card-content">

                                <!-- Filtro -->
                                <div>
                                    <form action="gestao.php" method="post">
                                        <span class="card-title">Não Iniciados</span>
                                        <div class="row">
                                            <div class="col s9">
                                                <input type="text" name="filtro_nao_iniciados">
                                            </div>
                                            <div class="col s2">
                                                <button class="btn-floating waves-effect waves-light blue" type="submit"><i class="material-icons right">search</i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Projetos -->
                                <div>
                                    <?php
                                    // Exibição Com Filtro
                                    if (isset($_POST["filtro_nao_iniciados"])) {
                                    ?>
                                        <?php
                                        $result_projetos_nao_iniciado = $servicosProjeto->listarProjetosNaoIniciadosPorNome($_POST["filtro_nao_iniciados"]);
                                        while ($linha_nao_iniciados = mysqli_fetch_assoc($result_projetos_nao_iniciado)) {
                                        ?>
                                            <form action="gestao.php" method="post"></form>
                                            <ul class="collapsible popout">
                                                <li>
                                                    <div class="collapsible-header">
                                                        <i class="material-icons">menu</i>
                                                        <a href="detalhes_projeto.php?id=<?php echo $linha_nao_iniciados["projeto_id"] ?>" title="Detalhes do Projeto"><?php echo $linha_nao_iniciados["projeto_nome"] ?></a>
                                                    </div>
                                                    <div class="collapsible-body">
                                                        <p>Cliente: <a href="../paginas_cliente/detalhes_cliente.php?id=<?php echo $linha_nao_iniciados["cliente_id"] ?>" title="Detalhes do Cliente"><?php echo $linha_nao_iniciados["cliente_nomefantasia"] ?></a></p>
                                                        <p>Equipe de (GP): <a href="../paginas_equipe/detalhes_equipe.php?id=<?php echo $linha_nao_iniciados["equipe_id"] ?>" title="Detalhes da Equipe"><?php echo ($linha_nao_iniciados["equipe_gestor"]) ?></a></p>
                                                        <p><span class="truncate">Obs.: <?php echo $linha_nao_iniciados["projeto_observacao"] ?></span></a></p>
                                                        <br>
                                                        <a style="margin-right: 7%; margin-left: 7%;" href="update_status/update_status_reserva.php?id=<?php echo $linha_nao_iniciados["projeto_id"] ?>"><i class="fas fa-box-open fa-2x" title="Retornar para o banco de reserva"></i></a>
                                                        <a style="margin-right: 7%; margin-left: 7%;" href="atribuir_entregavel.php?id=<?php echo $linha_nao_iniciados["projeto_id"] ?>"><i class="far fa-calendar-alt fa-2x" title="Atribuir Entregáveis"></i></a>
                                                    </div>
                                                </li>
                                            </ul>
                                            </form>
                                        <?php
                                        }
                                        ?>

                                        <!-- Atualizar Página -->
                                        <div class="center">
                                            <a href="gestao.php"><i class="material-icons blue-text">refresh</i></a>
                                        </div>

                                    <?php
                                        // Exibição Sem Filtro
                                    } else {
                                    ?>
                                        <?php
                                        $result_projetos_nao_iniciado = $servicosProjeto->listarProjetosNaoIniciados();
                                        while ($linha_nao_iniciados = mysqli_fetch_assoc($result_projetos_nao_iniciado)) {
                                        ?>
                                            <form action="gestao.php" method="post"></form>
                                            <ul class="collapsible popout">
                                                <li>
                                                    <div class="collapsible-header">
                                                        <i class="material-icons">menu</i>
                                                        <a href="detalhes_projeto.php?id=<?php echo $linha_nao_iniciados["projeto_id"] ?>" title="Detalhes do Projeto"><?php echo $linha_nao_iniciados["projeto_nome"] ?></a>
                                                    </div>
                                                    <div class="collapsible-body">
                                                        <p>Cliente: <a href="../paginas_cliente/detalhes_cliente.php?id=<?php echo $linha_nao_iniciados["cliente_id"] ?>" title="Detalhes do Cliente"><?php echo $linha_nao_iniciados["cliente_nomefantasia"] ?></a></p>
                                                        <p>Equipe de (GP): <a href="../paginas_equipe/detalhes_equipe.php?id=<?php echo $linha_nao_iniciados["equipe_id"] ?>" title="Detalhes da Equipe"><?php echo ($linha_nao_iniciados["equipe_gestor"]) ?></a></p>
                                                        <p><span class="truncate">Obs.: <?php echo $linha_nao_iniciados["projeto_observacao"] ?></span></a></p>
                                                        <br>
                                                        <a style="margin-right: 7%; margin-left: 7%;" href="update_status/update_status_reserva.php?id=<?php echo $linha_nao_iniciados["projeto_id"] ?>"><i class="fas fa-box-open fa-2x" title="Retornar para o banco de reserva"></i></a>
                                                        <a style="margin-right: 7%; margin-left: 7%;" href="atribuir_entregavel.php?id=<?php echo $linha_nao_iniciados["projeto_id"] ?>"><i class="far fa-calendar-alt fa-2x" title="Atribuir Entregáveis"></i></a>
                                                    </div>
                                                </li>
                                            </ul>
                                            </form>
                                        <?php
                                        }
                                        ?>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Em andamento -->
                    <div class="col s12 m6 l3">
                        <div class="card" style="max-height: 481px; min-height: 481px; overflow-y: scroll;">
                            <div class="card-content">

                                <!-- Filtro -->
                                <div>
                                    <form action="gestao.php" method="post">
                                        <span class="card-title">Em andamento</span>
                                        <div class="row">
                                            <div class="col s9">
                                                <input type="text" name="filtro_em_andamento">
                                            </div>
                                            <div class="col s2">
                                                <button class="btn-floating waves-effect waves-light blue" type="submit"><i class="material-icons right">search</i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Projetos -->
                                <div>
                                    <?php
                                    // Exibição Com Filtro
                                    if (isset($_POST["filtro_em_andamento"])) {
                                    ?>
                                        <?php
                                        $result_projetos_andamento = $servicosProjeto->listarProjetosEmAndamentoPorNome($_POST["filtro_em_andamento"]);
                                        while ($linha_andamento = mysqli_fetch_assoc($result_projetos_andamento)) {
                                        ?>
                                            <form action="gestao.php" method="post"></form>
                                            <ul class="collapsible popout">
                                                <li>
                                                    <div class="collapsible-header">
                                                        <i class="material-icons">menu</i>
                                                        <a href="detalhes_projeto.php?id=<?php echo $linha_andamento["projeto_id"] ?>"><?php echo $linha_andamento["projeto_nome"] ?></a>
                                                        <?php
                                                        if ($linha_andamento["projeto_status1"] == 1) {          //se entregavel1 ja foi entregue...
                                                            if ($linha_andamento["projeto_status2"] == 1) {      //se entregavel2 ja foi entregue...
                                                                if ($linha_andamento["projeto_status3"] == 1) {  //se entregavel3 ja foi entregue...
                                                        ?><span class="badge green"></span>
                                                                    <?php
                                                                } else { //senao, compare a data da entregavel3
                                                                    if ($linha_andamento["projeto_entregavel3"] < $servicosProjeto->dataDeHoje()) {
                                                                    ?><span class="badge red"></span>
                                                                    <?php
                                                                    } else if ($linha_andamento["projeto_entregavel3"] == $servicosProjeto->dataDeHoje()) {
                                                                    ?><span class="badge yellow"></span>
                                                                    <?php
                                                                    } else {
                                                                    ?><span class="badge green"></span>
                                                                    <?php
                                                                    }
                                                                }
                                                            } else { //senao, compare a data da entregavel2
                                                                if ($linha_andamento["projeto_entregavel2"] < $servicosProjeto->dataDeHoje()) {
                                                                    ?><span class="badge red"></span>
                                                                <?php
                                                                } else if ($linha_andamento["projeto_entregavel2"] == $servicosProjeto->dataDeHoje()) {
                                                                ?><span class="badge yellow"></span>
                                                                <?php
                                                                } else {
                                                                ?><span class="badge green"></span>
                                                                <?php
                                                                }
                                                            }
                                                        } else { //senao, compare a data da entregavel1
                                                            if ($linha_andamento["projeto_entregavel1"] < $servicosProjeto->dataDeHoje()) {
                                                                ?><span class="badge red"></span>
                                                            <?php
                                                            } else if ($linha_andamento["projeto_entregavel1"] == $servicosProjeto->dataDeHoje()) {
                                                            ?><span class="badge yellow"></span>
                                                            <?php
                                                            } else {
                                                            ?><span class="badge green"></span>
                                                        <?php
                                                            }
                                                        }
                                                        ?>

                                                    </div>
                                                    <div class="collapsible-body">
                                                        <p>Cliente: <a href="../paginas_cliente/detalhes_cliente.php?id=<?php echo $linha_andamento["cliente_id"] ?>" title="Detalhes do Cliente"><?php echo $linha_andamento["cliente_nomefantasia"] ?></a></p>
                                                        <p>Equipe de (GP): <a href="../paginas_equipe/detalhes_equipe.php?id=<?php echo $linha_andamento["equipe_id"] ?>" title="Detalhes da Equipe"><?php echo $linha_andamento["equipe_gestor"] ?></a></p>
                                                        <p>Entregável 1: <?php echo $linha_andamento["projeto_entregavel1"] ?><a href="update_status/update_status_entr1_entregue.php?id=<?php echo $linha_andamento["projeto_id"] ?>"><?php if ($linha_andamento["projeto_status1"] == 1) { ?> <i class="material-icons">check_box</i> <?php } else { ?> <i class="material-icons">check_box_outline_blank</i> <?php } ?></a> <a href="alterar_entregavel1.php?id=<?php echo $linha_andamento["projeto_id"] ?>"><i class="material-icons">edit</i></a> </p>
                                                        <p>Entregável 2: <?php echo $linha_andamento["projeto_entregavel2"] ?><a href="update_status/update_status_entr2_entregue.php?id=<?php echo $linha_andamento["projeto_id"] ?>"><?php if ($linha_andamento["projeto_status2"] == 1) { ?> <i class="material-icons">check_box</i> <?php } else { ?> <i class="material-icons">check_box_outline_blank</i> <?php } ?></a> <a href="alterar_entregavel2.php?id=<?php echo $linha_andamento["projeto_id"] ?>"><i class="material-icons">edit</i></a> </p>
                                                        <p>Entregável 3: <?php echo $linha_andamento["projeto_entregavel3"] ?><a href="update_status/update_status_entr3_entregue.php?id=<?php echo $linha_andamento["projeto_id"] ?>"><?php if ($linha_andamento["projeto_status3"] == 1) { ?> <i class="material-icons">check_box</i> <?php } else { ?> <i class="material-icons">check_box_outline_blank</i> <?php } ?></a> <a href="alterar_entregavel3.php?id=<?php echo $linha_andamento["projeto_id"] ?>"><i class="material-icons">edit</i></a> </p>
                                                        <p><span class="truncate">Obs.: <?php echo $linha_andamento["projeto_observacao"] ?></span></a></p>
                                                        <br>
                                                        <a style="margin-right: 7%; margin-left: 7%;" href="../paginas_banca/cadastro_banca.php?id=<?php echo $linha_andamento["projeto_id"] ?>" id="<?php $linha_andamento["projeto_id"] ?>"><i class="fas fa-flag-checkered fa-2x" title="Concluir"></i></a>
                                                        <!-- <a style="margin-right: 7%; margin-left: 7%;" href="update_status/update_status_reserva.php?id=<?php echo $linha_andamento["projeto_id"] ?>"><i class="fas fa-box-open fa-2x" title="Retornar para o banco de reserva"></i></a> -->
                                                        <a class="activator" style="margin-right: 7%; margin-left: 7%;" href="cancelar_projeto.php?id=<?php echo $linha_andamento["projeto_id"] ?>" id="<?php $linha_andamento["projeto_id"] ?>"><i class="fas fa-window-close fa-2x" title="Cancelar"></i></a>
                                                    </div>
                                                </li>
                                            </ul>
                                            </form>
                                        <?php
                                        }
                                        ?>
                                        <!-- Atualizar Página -->
                                        <div class="center">
                                            <a href="gestao.php"><i class="material-icons blue-text">refresh</i></a>
                                        </div>
                                    <?php
                                        // Exibição Sem Filtro
                                    } else {
                                    ?>
                                        <?php
                                        $result_projetos_andamento = $servicosProjeto->listarProjetosEmAndamento();
                                        while ($linha_andamento = mysqli_fetch_assoc($result_projetos_andamento)) {
                                        ?>
                                            <form action="gestao.php" method="post"></form>
                                            <ul class="collapsible popout">
                                                <li>
                                                    <div class="collapsible-header">
                                                        <i class="material-icons">menu</i>
                                                        <a href="detalhes_projeto.php?id=<?php echo $linha_andamento["projeto_id"] ?>"><?php echo $linha_andamento["projeto_nome"] ?></a>
                                                        <?php
                                                        if ($linha_andamento["projeto_status1"] == 1) {          //se entregavel1 ja foi entregue...
                                                            if ($linha_andamento["projeto_status2"] == 1) {      //se entregavel2 ja foi entregue...
                                                                if ($linha_andamento["projeto_status3"] == 1) {  //se entregavel3 ja foi entregue...
                                                        ?><span class="badge green"></span>
                                                                    <?php
                                                                } else { //senao, compare a data da entregavel3
                                                                    if ($linha_andamento["projeto_entregavel3"] < $servicosProjeto->dataDeHoje()) {
                                                                    ?><span class="badge red"></span>
                                                                    <?php
                                                                    } else if ($linha_andamento["projeto_entregavel3"] == $servicosProjeto->dataDeHoje()) {
                                                                    ?><span class="badge yellow"></span>
                                                                    <?php
                                                                    } else {
                                                                    ?><span class="badge green"></span>
                                                                    <?php
                                                                    }
                                                                }
                                                            } else { //senao, compare a data da entregavel2
                                                                if ($linha_andamento["projeto_entregavel2"] < $servicosProjeto->dataDeHoje()) {
                                                                    ?><span class="badge red"></span>
                                                                <?php
                                                                } else if ($linha_andamento["projeto_entregavel2"] == $servicosProjeto->dataDeHoje()) {
                                                                ?><span class="badge yellow"></span>
                                                                <?php
                                                                } else {
                                                                ?><span class="badge green"></span>
                                                                <?php
                                                                }
                                                            }
                                                        } else { //senao, compare a data da entregavel1
                                                            if ($linha_andamento["projeto_entregavel1"] < $servicosProjeto->dataDeHoje()) {
                                                                ?><span class="badge red"></span>
                                                            <?php
                                                            } else if ($linha_andamento["projeto_entregavel1"] == $servicosProjeto->dataDeHoje()) {
                                                            ?><span class="badge yellow"></span>
                                                            <?php
                                                            } else {
                                                            ?><span class="badge green"></span>
                                                        <?php
                                                            }
                                                        }
                                                        ?>

                                                    </div>
                                                    <div class="collapsible-body">
                                                        <p>Cliente: <a href="../paginas_cliente/detalhes_cliente.php?id=<?php echo $linha_andamento["cliente_id"] ?>" title="Detalhes do Cliente"><?php echo $linha_andamento["cliente_nomefantasia"] ?></a></p>
                                                        <p>Equipe de (GP): <a href="../paginas_equipe/detalhes_equipe.php?id=<?php echo $linha_andamento["equipe_id"] ?>" title="Detalhes da Equipe"><?php echo $linha_andamento["equipe_gestor"] ?></a></p>
                                                        <p>Entregável 1: <?php echo $linha_andamento["projeto_entregavel1"] ?><a href="update_status/update_status_entr1_entregue.php?id=<?php echo $linha_andamento["projeto_id"] ?>"><?php if ($linha_andamento["projeto_status1"] == 1) { ?> <i class="material-icons">check_box</i> <?php } else { ?> <i class="material-icons">check_box_outline_blank</i> <?php } ?></a> <a href="alterar_entregavel1.php?id=<?php echo $linha_andamento["projeto_id"] ?>"><i class="material-icons">edit</i></a> </p>
                                                        <p>Entregável 2: <?php echo $linha_andamento["projeto_entregavel2"] ?><a href="update_status/update_status_entr2_entregue.php?id=<?php echo $linha_andamento["projeto_id"] ?>"><?php if ($linha_andamento["projeto_status2"] == 1) { ?> <i class="material-icons">check_box</i> <?php } else { ?> <i class="material-icons">check_box_outline_blank</i> <?php } ?></a> <a href="alterar_entregavel2.php?id=<?php echo $linha_andamento["projeto_id"] ?>"><i class="material-icons">edit</i></a> </p>
                                                        <p>Entregável 3: <?php echo $linha_andamento["projeto_entregavel3"] ?><a href="update_status/update_status_entr3_entregue.php?id=<?php echo $linha_andamento["projeto_id"] ?>"><?php if ($linha_andamento["projeto_status3"] == 1) { ?> <i class="material-icons">check_box</i> <?php } else { ?> <i class="material-icons">check_box_outline_blank</i> <?php } ?></a> <a href="alterar_entregavel3.php?id=<?php echo $linha_andamento["projeto_id"] ?>"><i class="material-icons">edit</i></a> </p>
                                                        <p><span class="truncate">Obs.: <?php echo $linha_andamento["projeto_observacao"] ?></span></a></p>
                                                        <br>
                                                        <a style="margin-right: 7%; margin-left: 7%;" href="../paginas_banca/cadastro_banca.php?id=<?php echo $linha_andamento["projeto_id"] ?>" id="<?php $linha_andamento["projeto_id"] ?>"><i class="fas fa-flag-checkered fa-2x" title="Concluir"></i></a>
                                                        <!-- <a style="margin-right: 7%; margin-left: 7%;" href="update_status/update_status_reserva.php?id=<?php echo $linha_andamento["projeto_id"] ?>"><i class="fas fa-box-open fa-2x" title="Retornar para o banco de reserva"></i></a> -->
                                                        <a class="activator" style="margin-right: 7%; margin-left: 7%;" href="cancelar_projeto.php?id=<?php echo $linha_andamento["projeto_id"] ?>" id="<?php $linha_andamento["projeto_id"] ?>"><i class="fas fa-window-close fa-2x" title="Cancelar"></i></a>
                                                    </div>
                                                </li>
                                            </ul>
                                            </form>
                                        <?php
                                        }
                                        ?>
                                    <?php
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Concluídos -->
                    <div class="col s12 m6 l3">
                        <div class="card" style="max-height: 481px; min-height: 481px; overflow-y: scroll;">
                            <div class="card-content">

                                <!-- Filtro -->
                                <div>
                                    <form action="gestao.php" method="post">
                                        <span class="card-title">Concluídos</span>
                                        <div class="row">
                                            <div class="col s9">
                                                <input type="text" name="filtro_concluidos">
                                            </div>
                                            <div class="col s2">
                                                <button class="btn-floating waves-effect waves-light blue" type="submit"><i class="material-icons right">search</i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Projetos -->
                                <div>
                                    <?php
                                    // Exibição Com Filtro
                                    if (isset($_POST["filtro_concluidos"])) {
                                    ?>
                                        <?php
                                        $result_projetos_concluidos = $servicosProjeto->listarProjetosConcluidosPorNome($_POST["filtro_concluidos"]);
                                        while ($linha_concluidos = mysqli_fetch_assoc($result_projetos_concluidos)) {
                                        ?>
                                            <ul class="collapsible popout">
                                                <li>
                                                    <div class="collapsible-header">
                                                        <i class="material-icons">menu</i>
                                                        <a href="detalhes_projeto.php?id=<?php echo $linha_concluidos["projeto_id"] ?>"><?php echo $linha_concluidos["projeto_nome"] ?></a>
                                                    </div>
                                                    <div class="collapsible-body">
                                                        <p>Cliente: <a href="../paginas_cliente/detalhes_cliente.php?id=<?php echo $linha_concluidos["cliente_id"] ?>" title="Detalhes do Cliente"><?php echo $linha_concluidos["cliente_nomefantasia"] ?></a></p>
                                                        <p>Equipe de (GP): <a href="../paginas_equipe/detalhes_equipe.php?id=<?php echo $linha_concluidos["equipe_id"] ?>" title="Detalhes da Equipe"><?php echo $linha_concluidos["equipe_gestor"] ?></a></p>
                                                        <!-- <p>Entregável 1: <?php echo $linha_concluidos["projeto_entregavel1"] ?><a href="update_status/update_status_entr1_entregue.php?id=<?php echo $linha_concluidos["projeto_id"] ?>"><?php if ($linha_concluidos["projeto_status1"] == 1) { ?> <i class="material-icons">check_box</i> <?php } else { ?> <i class="material-icons">check_box_outline_blank</i> <?php } ?></a> </p>
                                                <p>Entregável 2: <?php echo $linha_concluidos["projeto_entregavel2"] ?><a href="update_status/update_status_entr2_entregue.php?id=<?php echo $linha_concluidos["projeto_id"] ?>"><?php if ($linha_concluidos["projeto_status2"] == 1) { ?> <i class="material-icons">check_box</i> <?php } else { ?> <i class="material-icons">check_box_outline_blank</i> <?php } ?></a> </p>
                                                <p>Entregável 3: <?php echo $linha_concluidos["projeto_entregavel3"] ?><a href="update_status/update_status_entr3_entregue.php?id=<?php echo $linha_concluidos["projeto_id"] ?>"><?php if ($linha_concluidos["projeto_status3"] == 1) { ?> <i class="material-icons">check_box</i> <?php } else { ?> <i class="material-icons">check_box_outline_blank</i> <?php } ?></a> </p> -->
                                                        <p><span class="truncate">Obs.: <?php echo $linha_concluidos["projeto_observacao"] ?></span></a></p>
                                                    </div>
                                                </li>
                                            </ul>
                                        <?php
                                        }
                                        ?>

                                        <!-- Atualizar Página -->
                                        <div class="center">
                                            <a href="gestao.php"><i class="material-icons blue-text">refresh</i></a>
                                        </div>
                                    <?php
                                        // Exibição Sem Filtro
                                    } else {
                                    ?>
                                        <?php
                                        $result_projetos_concluidos = $servicosProjeto->listarProjetosConcluidos();
                                        while ($linha_concluidos = mysqli_fetch_assoc($result_projetos_concluidos)) {
                                        ?>

                                            <ul class="collapsible popout">
                                                <li>
                                                    <div class="collapsible-header">
                                                        <i class="material-icons">menu</i>
                                                        <a href="detalhes_projeto.php?id=<?php echo $linha_concluidos["projeto_id"] ?>"><?php echo $linha_concluidos["projeto_nome"] ?></a>
                                                    </div>
                                                    <div class="collapsible-body">
                                                        <p>Cliente: <a href="../paginas_cliente/detalhes_cliente.php?id=<?php echo $linha_concluidos["cliente_id"] ?>" title="Detalhes do Cliente"><?php echo $linha_concluidos["cliente_nomefantasia"] ?></a></p>
                                                        <p>Equipe de (GP): <a href="../paginas_equipe/detalhes_equipe.php?id=<?php echo $linha_concluidos["equipe_id"] ?>" title="Detalhes da Equipe"><?php echo $linha_concluidos["equipe_gestor"] ?></a></p>
                                                        <!-- <p>Entregável 1: <?php echo $linha_concluidos["projeto_entregavel1"] ?><a href="update_status/update_status_entr1_entregue.php?id=<?php echo $linha_concluidos["projeto_id"] ?>"><?php if ($linha_concluidos["projeto_status1"] == 1) { ?> <i class="material-icons">check_box</i> <?php } else { ?> <i class="material-icons">check_box_outline_blank</i> <?php } ?></a> </p>
                                                <p>Entregável 2: <?php echo $linha_concluidos["projeto_entregavel2"] ?><a href="update_status/update_status_entr2_entregue.php?id=<?php echo $linha_concluidos["projeto_id"] ?>"><?php if ($linha_concluidos["projeto_status2"] == 1) { ?> <i class="material-icons">check_box</i> <?php } else { ?> <i class="material-icons">check_box_outline_blank</i> <?php } ?></a> </p>
                                                <p>Entregável 3: <?php echo $linha_concluidos["projeto_entregavel3"] ?><a href="update_status/update_status_entr3_entregue.php?id=<?php echo $linha_concluidos["projeto_id"] ?>"><?php if ($linha_concluidos["projeto_status3"] == 1) { ?> <i class="material-icons">check_box</i> <?php } else { ?> <i class="material-icons">check_box_outline_blank</i> <?php } ?></a> </p> -->
                                                        <p><span class="truncate">Obs.: <?php echo $linha_concluidos["projeto_observacao"] ?></span></a></p>
                                                    </div>
                                                </li>
                                            </ul>
                                        <?php
                                        }
                                        ?>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cancelados -->
                    <div class="col s12 m6 l3">
                        <div class="card" style="max-height: 481px; min-height: 481px; overflow-y: scroll;">
                            <div class="card-content">

                                <!-- Filtro -->
                                <div>
                                    <form action="gestao.php" method="post">
                                        <span class="card-title">Cancelados</span>
                                        <div class="row">
                                            <div class="col s9">
                                                <input type="text" name="filtro_cancelados">
                                            </div>
                                            <div class="col s2">
                                                <button class="btn-floating waves-effect waves-light blue" type="submit"><i class="material-icons right">search</i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Projetos -->
                                <div>
                                    <?php
                                    // Exibição Com Filtro
                                    if (isset($_POST["filtro_cancelados"])) {
                                    ?>
                                        <?php
                                        $result_projetos_cancelados = $servicosProjeto->listarProjetosCanceladosPorNome($_POST["filtro_cancelados"]);
                                        while ($linha_cancelados = mysqli_fetch_assoc($result_projetos_cancelados)) {
                                        ?>
                                            <form action="gestao.php" method="post"></form>
                                            <ul class="collapsible popout">
                                                <li>
                                                    <div class="collapsible-header">
                                                        <i class="material-icons">menu</i>
                                                        <a href="detalhes_projeto.php?id=<?php echo $linha_cancelados["projeto_id"] ?>"><?php echo $linha_cancelados["projeto_nome"] ?></a>
                                                        <?php
                                                        if ($linha_cancelados["projeto_status1"] == 1) {          //se entregavel1 ja foi entregue...
                                                            if ($linha_cancelados["projeto_status2"] == 1) {      //se entregavel2 ja foi entregue...
                                                                if ($linha_cancelados["projeto_status3"] == 1) {  //se entregavel3 ja foi entregue...
                                                        ?><span class="badge green"></span>
                                                                    <?php
                                                                } else { //senao, compare a data da entregavel3
                                                                    if ($linha_cancelados["projeto_entregavel3"] < $servicosProjeto->dataDeHoje()) {
                                                                    ?><span class="badge red"></span>
                                                                    <?php
                                                                    } else if ($linha_cancelados["projeto_entregavel3"] == $servicosProjeto->dataDeHoje()) {
                                                                    ?><span class="badge yellow"></span>
                                                                    <?php
                                                                    } else {
                                                                    ?><span class="badge green"></span>
                                                                    <?php
                                                                    }
                                                                }
                                                            } else { //senao, compare a data da entregavel2
                                                                if ($linha_cancelados["projeto_entregavel2"] < $servicosProjeto->dataDeHoje()) {
                                                                    ?><span class="badge red"></span>
                                                                <?php
                                                                } else if ($linha_cancelados["projeto_entregavel2"] == $servicosProjeto->dataDeHoje()) {
                                                                ?><span class="badge yellow"></span>
                                                                <?php
                                                                } else {
                                                                ?><span class="badge green"></span>
                                                                <?php
                                                                }
                                                            }
                                                        } else { //senao, compare a data da entregavel1
                                                            if ($linha_cancelados["projeto_entregavel1"] < $servicosProjeto->dataDeHoje()) {
                                                                ?><span class="badge red"></span>
                                                            <?php
                                                            } else if ($linha_cancelados["projeto_entregavel1"] == $servicosProjeto->dataDeHoje()) {
                                                            ?><span class="badge yellow"></span>
                                                            <?php
                                                            } else {
                                                            ?><span class="badge green"></span>
                                                        <?php
                                                            }
                                                        }
                                                        ?>

                                                    </div>
                                                    <div class="collapsible-body">
                                                        <p>Cliente: <a href="../paginas_cliente/detalhes_cliente.php?id=<?php echo $linha_cancelados["cliente_id"] ?>" title="Detalhes do Cliente"><?php echo $linha_cancelados["cliente_nomefantasia"] ?></a></p>
                                                        <p>Equipe de (GP): <a href="../paginas_equipe/detalhes_equipe.php?id=<?php echo $linha_cancelados["equipe_id"] ?>" title="Detalhes da Equipe"><?php echo $linha_cancelados["equipe_gestor"] ?></a></p>
                                                        <p>Entregável 1: <?php echo $linha_cancelados["projeto_entregavel1"] ?><a href="update_status/update_status_entr1_entregue.php?id=<?php echo $linha_cancelados["projeto_id"] ?>"><?php if ($linha_cancelados["projeto_status1"] == 1) { ?> <i class="material-icons">check_box</i> <?php } else { ?> <i class="material-icons">check_box_outline_blank</i> <?php } ?></a> </p>
                                                        <p>Entregável 2: <?php echo $linha_cancelados["projeto_entregavel2"] ?><a href="update_status/update_status_entr2_entregue.php?id=<?php echo $linha_cancelados["projeto_id"] ?>"><?php if ($linha_cancelados["projeto_status2"] == 1) { ?> <i class="material-icons">check_box</i> <?php } else { ?> <i class="material-icons">check_box_outline_blank</i> <?php } ?></a> </p>
                                                        <p>Entregável 3: <?php echo $linha_cancelados["projeto_entregavel3"] ?><a href="update_status/update_status_entr3_entregue.php?id=<?php echo $linha_cancelados["projeto_id"] ?>"><?php if ($linha_cancelados["projeto_status3"] == 1) { ?> <i class="material-icons">check_box</i> <?php } else { ?> <i class="material-icons">check_box_outline_blank</i> <?php } ?></a> </p>
                                                        <p><span class="truncate">Obs.: <?php echo $linha_cancelados["projeto_observacao"] ?></span></a></p>
                                                        <p><span class="truncate">Motivo Cancelamento: <?php echo $linha_cancelados["projeto_motivocancelamento"] ?></span></a></p>
                                                        <br>
                                                        <a style="margin-right: 7%; margin-left: 7%;" href="update_status/update_status_reserva.php?id=<?php echo $linha_cancelados["projeto_id"] ?>"><i class="fas fa-box-open fa-2x" title="Retornar para o banco de reserva"></i></a>
                                                        <a style="margin-right: 7%; margin-left: 7%;" href="update_status/update_status_emandamento.php?id=<?php echo $linha_cancelados["projeto_id"] ?>" id="<?php $linha_cancelados["projeto_id"] ?>"><i class="fas fa-undo-alt fa-2x" title="Reativar"></i></a>
                                                    </div>
                                                </li>
                                            </ul>
                                            </form>
                                        <?php
                                        }
                                        ?>
                                        <!-- Atualizar Página -->
                                        <div class="center">
                                            <a href="gestao.php"><i class="material-icons blue-text">refresh</i></a>
                                        </div>
                                    <?php
                                        // Exibição Sem Filtro
                                    } else {
                                    ?>
                                        <?php
                                        $result_projetos_cancelados = $servicosProjeto->listarProjetosCancelados();
                                        while ($linha_cancelados = mysqli_fetch_assoc($result_projetos_cancelados)) {
                                        ?>
                                            <form action="gestao.php" method="post"></form>
                                            <ul class="collapsible popout">
                                                <li>
                                                    <div class="collapsible-header">
                                                        <i class="material-icons">menu</i>
                                                        <a href="detalhes_projeto.php?id=<?php echo $linha_cancelados["projeto_id"] ?>"><?php echo $linha_cancelados["projeto_nome"] ?></a>
                                                        <?php
                                                        if ($linha_cancelados["projeto_status1"] == 1) {          //se entregavel1 ja foi entregue...
                                                            if ($linha_cancelados["projeto_status2"] == 1) {      //se entregavel2 ja foi entregue...
                                                                if ($linha_cancelados["projeto_status3"] == 1) {  //se entregavel3 ja foi entregue...
                                                        ?><span class="badge green"></span>
                                                                    <?php
                                                                } else { //senao, compare a data da entregavel3
                                                                    if ($linha_cancelados["projeto_entregavel3"] < $servicosProjeto->dataDeHoje()) {
                                                                    ?><span class="badge red"></span>
                                                                    <?php
                                                                    } else if ($linha_cancelados["projeto_entregavel3"] == $servicosProjeto->dataDeHoje()) {
                                                                    ?><span class="badge yellow"></span>
                                                                    <?php
                                                                    } else {
                                                                    ?><span class="badge green"></span>
                                                                    <?php
                                                                    }
                                                                }
                                                            } else { //senao, compare a data da entregavel2
                                                                if ($linha_cancelados["projeto_entregavel2"] < $servicosProjeto->dataDeHoje()) {
                                                                    ?><span class="badge red"></span>
                                                                <?php
                                                                } else if ($linha_cancelados["projeto_entregavel2"] == $servicosProjeto->dataDeHoje()) {
                                                                ?><span class="badge yellow"></span>
                                                                <?php
                                                                } else {
                                                                ?><span class="badge green"></span>
                                                                <?php
                                                                }
                                                            }
                                                        } else { //senao, compare a data da entregavel1
                                                            if ($linha_cancelados["projeto_entregavel1"] < $servicosProjeto->dataDeHoje()) {
                                                                ?><span class="badge red"></span>
                                                            <?php
                                                            } else if ($linha_cancelados["projeto_entregavel1"] == $servicosProjeto->dataDeHoje()) {
                                                            ?><span class="badge yellow"></span>
                                                            <?php
                                                            } else {
                                                            ?><span class="badge green"></span>
                                                        <?php
                                                            }
                                                        }
                                                        ?>

                                                    </div>
                                                    <div class="collapsible-body">
                                                        <p>Cliente: <a href="../paginas_cliente/detalhes_cliente.php?id=<?php echo $linha_cancelados["cliente_id"] ?>" title="Detalhes do Cliente"><?php echo $linha_cancelados["cliente_nomefantasia"] ?></a></p>
                                                        <p>Equipe de (GP): <a href="../paginas_equipe/detalhes_equipe.php?id=<?php echo $linha_cancelados["equipe_id"] ?>" title="Detalhes da Equipe"><?php echo $linha_cancelados["equipe_gestor"] ?></a></p>
                                                        <p>Entregável 1: <?php echo $linha_cancelados["projeto_entregavel1"] ?><a href="update_status/update_status_entr1_entregue.php?id=<?php echo $linha_cancelados["projeto_id"] ?>"><?php if ($linha_cancelados["projeto_status1"] == 1) { ?> <i class="material-icons">check_box</i> <?php } else { ?> <i class="material-icons">check_box_outline_blank</i> <?php } ?></a> </p>
                                                        <p>Entregável 2: <?php echo $linha_cancelados["projeto_entregavel2"] ?><a href="update_status/update_status_entr2_entregue.php?id=<?php echo $linha_cancelados["projeto_id"] ?>"><?php if ($linha_cancelados["projeto_status2"] == 1) { ?> <i class="material-icons">check_box</i> <?php } else { ?> <i class="material-icons">check_box_outline_blank</i> <?php } ?></a> </p>
                                                        <p>Entregável 3: <?php echo $linha_cancelados["projeto_entregavel3"] ?><a href="update_status/update_status_entr3_entregue.php?id=<?php echo $linha_cancelados["projeto_id"] ?>"><?php if ($linha_cancelados["projeto_status3"] == 1) { ?> <i class="material-icons">check_box</i> <?php } else { ?> <i class="material-icons">check_box_outline_blank</i> <?php } ?></a> </p>
                                                        <p><span class="truncate">Obs.: <?php echo $linha_cancelados["projeto_observacao"] ?></span></a></p>
                                                        <p><span class="truncate">Motivo Cancelamento: <?php echo $linha_cancelados["projeto_motivocancelamento"] ?></span></a></p>
                                                        <br>
                                                        <a style="margin-right: 7%; margin-left: 7%;" href="update_status/update_status_reserva.php?id=<?php echo $linha_cancelados["projeto_id"] ?>"><i class="fas fa-box-open fa-2x" title="Retornar para o banco de reserva"></i></a>
                                                        <a style="margin-right: 7%; margin-left: 7%;" href="update_status/update_status_emandamento.php?id=<?php echo $linha_cancelados["projeto_id"] ?>" id="<?php $linha_cancelados["projeto_id"] ?>"><i class="fas fa-undo-alt fa-2x" title="Reativar"></i></a>
                                                    </div>
                                                </li>
                                            </ul>
                                            </form>
                                        <?php
                                        }
                                        ?>
                                    <?php
                                    }
                                    ?>
                                </div>
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
            $(document).ready(function() {
                $('textarea#motivo_cancelamento').characterCounter();
            });
        </script>

    </body>

    </html>

<?php
} else {
    header("location:../inicio/login.php");
}
?>