<!-- Cabeçalho das páginas -->

<?php require_once("../../servicos/ServicosUsuario.php"); ?>


<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
  <li><a href="https://1drv.ms/w/s!AnUW08D6QIPEipJ71QRKFfhYTJCWxg?e=xbGYgW" target="blank">Manual</a></li>
  <li class="divider"></li>
  <li><a href="../compartilhado/logout.php">Sair</a></li>
</ul>

<!-- cabeçalho -->
<div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper blue">
      <a href="../paginas_projeto/dashboard.php" class="brand-logo">PFC Manager</a>
      <ul class="right hide-on-med-and-down">
        <li>Bem-vindo(a), <?php echo $_SESSION["usuario_nome"] ?>!</li>
        <li><a href="../paginas_projeto/dashboard.php">Dashboard</a></li>
        <li><a href="../paginas_projeto/historico.php">Histórico</a></li>
        <li><a href="../paginas_projeto/gestao.php">Gestão de Projetos</a></li>
        <li><a href="../paginas_projeto/reserva.php">Banco de Projetos</a></li>
        <li><a href="../paginas_relatorio/relatorios.php">Relatórios</a></li>
        <!-- Dropdown Trigger -->
        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Opções<i class="material-icons right">arrow_drop_down</i></a></li>
      </ul>
    </div>
  </nav>
</div>

<!-- menu lateral -->
<ul id="slide-out" class="sidenav">
  <li>
    <div class="user-view">
      <div class="background">
        <img src="../../img/senai_cimatec_2000x1200.jpg" width="300px">
      </div>
      <a href="#user"><img class="circle" src="../../img/programmer.jpg"></a>
      <a href="#name"><span class="white-text name"><?php echo $_SESSION["usuario_nome"] ?></span></a>
      <a href="#email"><span class="white-text email"><?php echo $_SESSION["usuario_perfil"] ?></span></a>
    </div>
  </li>
  <li><a href="../paginas_projeto/dashboard.php" class="black-text"><i class="material-icons">dashboard</i>Dashboard</a></li>
  <li><a href="../paginas_projeto/historico.php" class="black-text"><i class="material-icons">history</i>Histórico</a></li>
  <li><a href="../paginas_projeto/gestao.php" class="black-text"><i class="material-icons">folder_shared</i>Gestão de Projetos</a></li>
  <li><a href="../paginas_projeto/reserva.php" class="black-text"><i class="material-icons">folder</i>Banco de Projetos</a></li>

  <?php
  if (($_SESSION["usuario_perfil"]) == "Administrador") {
  ?>
    <li><a href="../paginas_relatorio/relatorios.php" class="black-text"><i class="material-icons">equalizer</i>Relatórios</a></li>
  <?php
  }
  ?>

  <li>
    <div class="divider"></div>
  </li>

  <li class="no-padding">
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">Cadastros<i class="material-icons">arrow_drop_down</i></a>
        <div class="collapsible-body">
          <ul>            
            <li><a href="../paginas_projeto/index_projeto.php" class="black-text"> <img src="../../img/project-management-2-536854.webp" width="20" style="margin: 0 32px 0 0;" alt=""> Projetos</a></li>
            <li><a href="../paginas_banca/index_banca.php" class="black-text"><i class="material-icons">assignment</i>Bancas</a></li>
            <li><a href="../paginas_cliente/index_cliente.php" class="black-text"><i class="material-icons">work</i>Clientes</a></li>
            <li><a href="../paginas_equipe/index_equipe.php" class="black-text"><i class="material-icons">group</i>Equipes</a></li>
            <li><a href="../paginas_turma/index_turma.php" class="black-text"><i class="material-icons">account_balance</i>Turmas</a></li>
            <li><a href="../paginas_curso/index_curso.php" class="black-text"><i class="material-icons">account_balance</i>Cursos</a></li>
            <li><a href="../paginas_area/index_area.php" class="black-text"><i class="material-icons">account_balance</i>Áreas</a></li>
            <li><a href="../paginas_gpe/index_gpe.php" class="black-text"><i class="material-icons">school</i>GPEs</a></li>
            <li><a href="../paginas_orientador/index_orientador.php" class="black-text"><i class="material-icons">school</i>Orientadores</a></li>
            <li><a href="../paginas_coordenador/index_coordenador.php" class="black-text"><i class="material-icons">school</i>Coordenadores</a></li>
            <?php
            if (($_SESSION["usuario_perfil"]) == "Administrador") {
            ?>
              <li><a href="../paginas_usuario/index_usuario.php" class="black-text"><i class="material-icons">person</i>Usuários</a></li>
            <?php
            }
            ?>
          </ul>
        </div>
      </li>
    </ul>
  </li>

  <?php
  if (($_SESSION["usuario_perfil"]) == "Administrador") {
  ?>
    <li class="no-padding">
      <ul class="collapsible collapsible-accordion">
        <li>
          <a class="collapsible-header">Configurações<i class="material-icons">arrow_drop_down</i></a>
          <div class="collapsible-body">
            <ul>
              <li><a href="../paginas_semestre/semestre.php" class="black-text"><i class="material-icons">date_range</i>Semestre</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </li>
  <?php
  }
  ?>

  <li>
    <div class="divider"></div>
  </li>

  <li>
    <a href="../compartilhado/logout.php" class="black-text"><i class="material-icons">keyboard_return</i>Sair</a>
  </li>

  <li>
    <div class="background">
      <img src="../../img/logo-senai.png" width="300px">
    </div>
  </li>
</ul>
<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>