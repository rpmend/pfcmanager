<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosEquipe.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

  <?php
  $servicosEquipe = new ServicosEquipe();
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
          <form method="POST">
            <h3 class="light-blue-text text-darken-3 page-title">Equipes

              <?php
              // Botão adicionar Área (Apenas Administrador e GPE)
              if (($_SESSION["usuario_perfil"]) == "Administrador" || ($_SESSION["usuario_perfil"]) == "GPE") {
              ?>
                <a title="Adicionar Projeto" href="cadastro_equipe.php" class="btn-floating btn-large waves-effect waves-light blue right" style="margin-right: 5%;">
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
              <button class="btn waves-effect waves-light blue" type="submit">Pesquisar
                <i class="material-icons right ">search</i>
              </button>
            </div>
          </form>
        </div>
        <div class="divider"></div>
        </form>
        <!-- tabela equipes -->
        <div class="table">
          <table class="striped">
            <thead>
              <tr>
                <th>Turma</th>
                <th>Gestor</th>
                <th>Membro1</th>
                <th>Membro2</th>
                <th>Membro3</th>
                <th>Membro4</th>
                <th>Membro5</th>
                <th>Nota</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_POST["filtro"])) {
              ?>
                <?php
                $resultado = $servicosEquipe->pesquisarEquipe($_POST["filtro"]);
                while ($linha = mysqli_fetch_assoc($resultado)) {
                ?>
                  <tr>
                    <td><?php echo $linha["turma_codigo"] ?></td>
                    <td><?php echo $linha["equipe_gestor"] ?></td>
                    <td><?php echo $linha["equipe_membro1"] ?></td>
                    <td><?php echo $linha["equipe_membro2"] ?></td>
                    <td><?php echo $linha["equipe_membro3"] ?></td>
                    <td><?php echo $linha["equipe_membro4"] ?></td>
                    <td><?php echo $linha["equipe_membro5"] ?></td>
                    <td><?php echo $linha["equipe_nota"] ?></td>

                    <?php
                    if (($_SESSION["usuario_perfil"]) == "Administrador") {
                    ?>
                      <td>
                        <a href="alterar_equipe.php?id=<?php echo $linha["equipe_id"] ?>"><i class="material-icons">edit</i></a>
                        <a href="deletar_equipe.php?id=<?php echo $linha["equipe_id"] ?>"><i class="material-icons">delete</i></a>
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
                $resultado = $servicosEquipe->listarEquipes();
                while ($linha = mysqli_fetch_assoc($resultado)) {
                ?>
                  <tr>
                    <td><?php echo $linha["turma_codigo"] ?></td>
                    <td><?php echo $linha["equipe_gestor"] ?></td>
                    <td><?php echo $linha["equipe_membro1"] ?></td>
                    <td><?php echo $linha["equipe_membro2"] ?></td>
                    <td><?php echo $linha["equipe_membro3"] ?></td>
                    <td><?php echo $linha["equipe_membro4"] ?></td>
                    <td><?php echo $linha["equipe_membro5"] ?></td>
                    <td><?php echo $linha["equipe_nota"] ?></td>

                    <?php
                    if (($_SESSION["usuario_perfil"]) == "Administrador") {
                    ?>
                      <td>
                        <a href="alterar_equipe.php?id=<?php echo $linha["equipe_id"] ?>"><i class="material-icons">edit</i></a>
                        <a href="deletar_equipe.php?id=<?php echo $linha["equipe_id"] ?>"><i class="material-icons">delete</i></a>
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