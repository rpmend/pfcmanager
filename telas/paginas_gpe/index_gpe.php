<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosGpe.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

  <?php
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
          <form method="POST">
            <h3 class="light-blue-text text-darken-3 page-title">GPEs

              <?php
              // Botão adicionar Área (Apenas Administrador e GPE)
              if (($_SESSION["usuario_perfil"]) == "Administrador" || ($_SESSION["usuario_perfil"]) == "GPE") {
              ?>
                <a title="Adicionar Projeto" href="cadastro_gpe.php" class="btn-floating btn-large waves-effect waves-light blue right" style="margin-right: 5%;">
                  <i class="material-icons">add</i>
                </a>
              <?php
              }
              ?>

            </h3>
            <div class="input-field col s4 offset-s3">
              <input name="filtro" maxlength="45" type="text">
              <label for="filtro"></label>
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
        <!-- tabela gpes -->
        <div class="container" style="padding-left: 5%; padding-right: 5%;">
          <div class="table">
            <table class="striped">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (isset($_POST["filtro"])) {
                ?>
                  <?php
                  $resultado = $servicosGpe->pesquisarGpes($_POST["filtro"]);
                  while ($linha = mysqli_fetch_assoc($resultado)) {
                  ?>
                    <tr>
                      <td><?php echo $linha["gpe_nome"] ?></td>

                      <?php
                      if (($_SESSION["usuario_perfil"]) == "Administrador") {
                      ?>
                        <td>
                          <a href="alterar_gpe.php?id=<?php echo $linha["gpe_id"] ?>"><i class="material-icons">edit</i></a>
                          <a href="deletar_gpe.php?id=<?php echo $linha["gpe_id"] ?>"><i class="material-icons">delete</i></a>
                        </td>
                      <?php
                      }
                      ?>

                    </tr>
                  <?php
                  }
                } else {
                  ?>
                  <?php
                  $resultado = $servicosGpe->listarGpes();
                  while ($linha = mysqli_fetch_assoc($resultado)) {
                  ?>
                    <tr>
                      <td><?php echo $linha["gpe_nome"] ?></td>

                      <?php
                      if (($_SESSION["usuario_perfil"]) == "Administrador") {
                      ?>
                        <td>
                          <a href="alterar_gpe.php?id=<?php echo $linha["gpe_id"] ?>"><i class="material-icons">edit</i></a>
                          <a href="deletar_gpe.php?id=<?php echo $linha["gpe_id"] ?>"><i class="material-icons">delete</i></a>
                        </td>
                      <?php
                      }
                      ?>

                    </tr>
                <?php
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
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