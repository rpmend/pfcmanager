<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosArea.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

  <?php
  $servicosArea = new ServicosArea();
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
            <h3 class="light-blue-text text-darken-3 page-title">Áreas

              <?php
              // Botão adicionar Área (Apenas Administrador)
              if (($_SESSION["usuario_perfil"]) == "Administrador") {
              ?>
                <a title="Adicionar Área" href="cadastro_area.php" class="btn-floating btn-large waves-effect waves-light blue right" style="margin-right: 5%;">
                  <i class="material-icons">add</i>
                </a>
              <?php
              }
              ?>

            </h3>

            <!-- Campo de Filtragem -->
            <div class="input-field col s4 offset-s3">
              <input name="filtro" maxlength="45" type="text">
              <label for="filtro"></label>
            </div>

            <!-- Botão de Filtragem -->
            <div class="input-field col s4">
              <button class="btn waves-effect waves-light blue" type="submit">Pesquisar
                <i class="material-icons right ">search</i>
              </button>
            </div>
          </form>
        </div>
        <div class="divider"></div>
        </form>

        <!-- Tabela Áreas -->
        <div class="container" style="padding-left: 5%; padding-right: 5%;">
          <div class="table">
            <table class="striped">
              <thead>
                <tr>
                  <th>Área</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Resultado filtrado
                if (isset($_POST["filtro"])) {
                ?>
                  <?php
                  $resultado = $servicosArea->listarAreasPorNome($_POST["filtro"]);
                  while ($linha = mysqli_fetch_assoc($resultado)) {
                  ?>
                    <tr>
                      <td><?php echo $linha["area_nome"] ?></td>

                      <?php
                      if (($_SESSION["usuario_perfil"]) == "Administrador") {
                      ?>
                        <td>
                          <a href="alterar_area.php?id=<?php echo $linha["area_id"] ?>"><i class="material-icons">edit</i></a>
                          <a href="deletar_area.php?id=<?php echo $linha["area_id"] ?>"><i class="material-icons">delete</i></a>
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

          <?php
                  // Resultado sem filtro
                } else {
          ?>
            <?php
                  $resultado = $servicosArea->listarAreas();
                  while ($linha = mysqli_fetch_assoc($resultado)) {
            ?>
              <tr>
                <td><?php echo $linha["area_nome"] ?></td>
                <td>
                  <a href="alterar_area.php?id=<?php echo $linha["area_id"] ?>"><i class="material-icons">edit</i></a>
                  <a href="deletar_area.php?id=<?php echo $linha["area_id"] ?>"><i class="material-icons">delete</i></a>
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