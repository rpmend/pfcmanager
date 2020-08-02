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
      td,
      th {
        padding: 15px 25px;
      }
    </style>
  </head>

  <body>
    <?php include_once("../compartilhado/header.php"); ?>
    <main>
      <div class="container">
        <div class="row">
          <form action="#">
            <h3 class="light-blue-text text-darken-3 page-title">Projetos

              <?php
              // Botão adicionar Área (Apenas Administrador e GPE)
              if (($_SESSION["usuario_perfil"]) == "Administrador" || ($_SESSION["usuario_perfil"]) == "GPE") {
              ?>
                <a title="Adicionar Projeto" href="cadastro_projeto.php" class="btn-floating btn-large waves-effect waves-light blue right" style="margin-right: 5%;">
                  <i class="material-icons">add</i>
                </a>
              <?php
              }
              ?>

            </h3>
            <div class="input-field col s4 offset-s3">
              <input name="nomeFantasia" maxlength="45" type="text">
              <label for="nomeFantasia"></label>
            </div>
            <div class="input-field col s4">
              <button class="btn waves-effect waves-light blue" type="submit" name="action">Pesquisar
                <i class="material-icons right ">search</i>
              </button>
            </div>
          </form>
        </div>
        <div class="divider"></div>
        </form>
        <!-- tabela projetos -->
        <div class="table">
          <table class="striped">
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
              $resultado = $servicosProjeto->listarProjetos();
              while ($linha = mysqli_fetch_assoc($resultado)) {
              ?>
                <tr>
                  <?php
                  switch ($linha["projeto_status"]) {
                    case '0':
                      $projeto_status = "RESERVA";
                      break;
                    case '1':
                      $projeto_status = "NÃO INICIADO";
                      break;
                    case '2':
                      $projeto_status = "EM ANDAMENTO";
                      break;
                    case '3':
                      $projeto_status = "CONCLUÍDO";
                      break;
                    case '4':
                      $projeto_status = "CANCELADO";
                      break;
                    default:
                      echo "ALGO DE ERRADO NAO ESTÁ CERTO :)";
                      break;
                  }
                  ?>
                  <td><?php echo $projeto_status ?></td>
                  <td><?php echo $linha["projeto_semestre"] ?></td>
                  <td><?php echo $linha["projeto_nome"] ?></td>
                  <td><?php echo $linha["cliente_razaosocial"] ?></td>
                  <td><?php echo $linha["equipe_gestor"] ?></td>
                  <td><?php echo $linha["projeto_tipo"] ?></td>
                  <td><?php echo $linha["projeto_empresa"] ?></td>
                  <td><?php echo $linha["projeto_negocio"] ?></td>
                  <td><?php echo $linha["projeto_macrotema"] ?></td>
                  <td><?php echo $linha["projeto_risco"] ?></td>
                  <td><?php echo $linha["projeto_retorno"] ?></td>
                  <td><?php echo $linha["projeto_entregavel1"] ?></td>
                  <td><?php echo $linha["projeto_entregavel2"] ?></td>
                  <td><?php echo $linha["projeto_entregavel3"] ?></td>
                  <td><?php echo $linha["projeto_observacao"] ?></td>
                  <td><?php echo $linha["projeto_motivocancelamento"] ?></td>
                  <?php
                  if (($_SESSION["usuario_perfil"]) == "Administrador") {
                  ?>
                    <td>
                      <a href="alterar_projeto.php?id=<?php echo $linha["projeto_id"] ?>"><i class="material-icons">edit</i></a>
                      <!-- <a href="deletar_projeto.php?id=<?php echo $linha["projeto_id"] ?>"><i class="material-icons">delete</i></a> -->
                    </td>
                  <?php
                  }
                  ?>

                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <br>
    </main>
    <?php include_once("../compartilhado/footer.php"); ?>
    <script src="../compartilhado/script.js"></script>
  </body>

  </html>

<?php
} else {
  header("location:../inicio/login.php");
}
?>