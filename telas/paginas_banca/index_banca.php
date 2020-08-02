<?php require_once("../../banco/conexao.php"); ?>
<?php require_once("../../servicos/ServicosBanca.php"); ?>
<?php session_start(); ?>

<?php
if ($_SESSION["usuario_nome"]) {
?>

  <?php
  $servicosBanca = new ServicosBanca();
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
            <h3 class="light-blue-text text-darken-3 page-title">Bancas

              <?php
              // Botão adicionar Área (Apenas Administrador e GPE)
              if (($_SESSION["usuario_perfil"]) == "Administrador" || ($_SESSION["usuario_perfil"]) == "GPE") {
              ?>
                <a title="Adicionar Banca" href="cadastro_banca.php" class="btn-floating btn-large waves-effect waves-light blue right" style="margin-right: 5%;">
                  <i class="material-icons">add</i>
                </a>
              <?php
              }
              ?>

            </h3>
            <div class="input-field col s4 offset-s3">
              <input name="filtroOrientadorOuCliente" maxlength="45" type="text">
              <label for="filtroOrientadorOuCliente"></label>
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
        <!-- tabela bancas -->
        <div class="table">
          <table class="striped">
            <thead>
              <tr>
                <th>Local</th>
                <th>Data</th>
                <th>Projeto</th>
                <th>Coordenador</th>
                <th>Orientador</th>
                <th>GPE</th>
                <th>Convidado</th>
                <th>Convidado</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $resultado = $servicosBanca->listarBancas();
              while ($linha = mysqli_fetch_assoc($resultado)) {
              ?>
                <tr>
                  <td><?php echo $linha["banca_local"] ?></td>
                  <td><?php echo $linha["banca_data"] ?></td>
                  <td><?php echo $linha["projeto_nome"] ?></td>
                  <td><?php echo $linha["coordenador_nome"] ?></td>
                  <td><?php echo $linha["orientador_nome"] ?></td>
                  <td><?php echo $linha["gpe_nome"] ?></td>
                  <td><?php echo $linha["banca_convidado1"] ?></td>
                  <td><?php echo $linha["banca_convidado2"] ?></td>
                  <td>
                    <!-- <a href="alterar_banca.php?id=<?php echo $linha["banca_id"] ?>"><i class="material-icons">edit</i></a> -->
                    <a href="deletar_banca.php?id=<?php echo $linha["banca_id"] ?>"><i class="material-icons">delete</i></a>
                  </td>
                </tr>
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