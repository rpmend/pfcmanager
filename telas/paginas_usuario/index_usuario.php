<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosUsuario.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

  <?php
  $servicosUsuario = new ServicosUsuario();
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

          <!-- form de pesquisa -->
          <form method="POST">
            <h3 class="light-blue-text text-darken-3 page-title">Usuários<a title="Adicionar Projeto" href="cadastro_usuario.php" class="btn-floating btn-large waves-effect waves-light blue right" style="margin-right: 5%;"><i class="material-icons">add</i></a></h3>
            <div class="input-field col s4 offset-s3">
              <input name="usuario_nome" maxlength="45" type="text">
              <label for="usuario_nome"></label>
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
        <div class="container" style="padding-left: 5%; padding-right: 5%;">
          <div class="table">

            <!-- tabela usuarios -->
            <table class="striped">
              <thead>
                <tr>
                  <th>Usuario</th>
                  <th>Perfil</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (isset($_POST["usuario_nome"])) {
                ?>
                  <?php
                  $resultado = $servicosUsuario->listarUsuariosPorNome($_POST["usuario_nome"]);
                  while ($linha = mysqli_fetch_assoc($resultado)) {
                  ?>
                    <tr>
                      <td><?php echo $linha["usuario_nome"] ?></td>
                      <td><?php echo $linha["usuario_perfil"] ?></td>
                      <td>
                        <a href="alterar_usuario.php?id=<?php echo $linha["usuario_id"] ?>"><i class="material-icons">edit</i></a>
                        <a href="deletar_usuario.php?id=<?php echo $linha["usuario_id"] ?>"><i class="material-icons">delete</i></a>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
              </tbody>
            </table>
            <div class="center" style="margin: 20px;">
              <a href="index_usuario.php"><i class="fas fa-undo-alt fa-2x" title="Recarregar"></i></a>
            </div>
          <?php
                } else {
          ?>
            <?php
                  $resultado = $servicosUsuario->listarUsuarios();
                  while ($linha = mysqli_fetch_assoc($resultado)) {
            ?>
              <tr>
                <td><?php echo $linha["usuario_nome"] ?></td>
                <td><?php echo $linha["usuario_perfil"] ?></td>
                <td>
                  <a href="alterar_usuario.php?id=<?php echo $linha["usuario_id"] ?>"><i class="material-icons">edit</i></a>
                  <a href="deletar_usuario.php?id=<?php echo $linha["usuario_id"] ?>"><i class="material-icons">delete</i></a>
                </td>
              </tr>
            <?php
                  }
            ?>
            </tbody>
            </table>
          <?php
                }
          ?>

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